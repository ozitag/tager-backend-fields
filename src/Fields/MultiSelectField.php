<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use Illuminate\Support\Facades\App;
use OZiTAG\Tager\Backend\Fields\Base\Field;
use OZiTAG\Tager\Backend\Fields\Contracts\ISelectOptionsGenerator;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;
use OZiTAG\Tager\Backend\Fields\TypeFactory;
use OZiTAG\Tager\Backend\Fields\Types\MultiSelectType;
use OZiTAG\Tager\Backend\Utils\Helpers\ArrayHelper;

class MultiSelectField extends Field
{
    public function __construct(string $label, $options = [])
    {
        parent::__construct($label, FieldType::MultiSelect);

        if (ArrayHelper::isAssoc($options) === false) {

            if (is_string($options)) {
                $class = App::make($options);
                if ($class instanceof ISelectOptionsGenerator == false) {
                    throw new \Exception('Options should be as key:value array or className that implements ISelectOptionsGenerator contract');
                }

                $options = $class->generate();
            } else {
                throw new \Exception('Options should be as key:value array or className that implements ISelectOptionsGenerator contract');
            }
        }

        foreach ($options as $param => $value) {
            if (!is_string($value)) {
                throw new \Exception('Value for option "' . $param . '" should be the string');
            }
        }

        $optionsFiltered = [];
        foreach ($options as $param => $value) {
            $optionsFiltered[] = [
                'value' => (string)$param,
                'label' => $value
            ];
        }

        $this->setMetaParam('options', $optionsFiltered);
    }

    public function getTypeInstance()
    {
        $type = parent::getTypeInstance();
        $type->setOptions($this->getMetaParamValue('options', []));
        return $type;
    }
}
