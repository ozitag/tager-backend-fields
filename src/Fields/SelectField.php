<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use Illuminate\Support\Facades\App;
use OZiTAG\Tager\Backend\Fields\Base\Field;
use OZiTAG\Tager\Backend\Fields\Contracts\ISelectOptionsGenerator;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;
use OZiTAG\Tager\Backend\Utils\Helpers\ArrayHelper;

class SelectField extends Field
{
    public function __construct(string $label, ?array $options = [], ?string $optionsGenerator = null, ?array $optionsGeneratorParams = [])
    {
        parent::__construct($label, FieldType::Select);

        if (!empty($optionsGenerator)) {
            $class = App::make($optionsGenerator, $optionsGeneratorParams);
            if ($class instanceof ISelectOptionsGenerator == false) {
                throw new \Exception('Options should be as key:value array or className that implements ISelectOptionsGenerator contract');
            }
            $options = $class->generate();
        }

        $optionsFiltered = [];
        if (is_array($options) && !empty($options)) {
            foreach ($options as $param => $value) {
                if (!is_string($value)) {
                    throw new \Exception('Value for option "' . $param . '" should be the string');
                }
            }

            foreach ($options as $param => $value) {
                $optionsFiltered[] = [
                    'value' => (string)$param,
                    'label' => $value
                ];
            }
        }

        $this->setMetaParam('options', $optionsFiltered);

        return $this;
    }

    public function getTypeInstance()
    {
        $type = parent::getTypeInstance();
        $type->setOptions($this->getMetaParamValue('options', []));
        return $type;
    }
}
