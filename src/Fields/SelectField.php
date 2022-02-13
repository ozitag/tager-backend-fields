<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use Illuminate\Support\Facades\App;
use OZiTAG\Tager\Backend\Fields\Base\Field;
use OZiTAG\Tager\Backend\Fields\Contracts\ISelectOptionsGenerator;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class SelectField extends Field
{
    protected bool $optionsLoaded = false;

    protected array $options = [];

    protected ?string $optionsGenerator;

    protected ?array $optionsGeneratorParams = [];

    public function getSelectType()
    {
        return FieldType::Select;
    }

    public function __construct(string $label, ?array $options = [], ?string $optionsGenerator = null, ?array $optionsGeneratorParams = [])
    {
        parent::__construct($label, $this->getSelectType());

        $this->optionsGenerator = $optionsGenerator;
        $this->optionsGeneratorParams = $optionsGeneratorParams;

        if ($options) {
            $this->options = $options;
        }

        $this->optionsLoaded = false;
    }

    public function getMeta()
    {
        if (!$this->optionsLoaded) {
            $this->loadOptions();
        }

        return parent::getMeta();
    }

    public function getMetaParamValue($param, $default = null)
    {
        if (!$this->optionsLoaded) {
            $this->loadOptions();
        }

        return parent::getMetaParamValue($param, $default);
    }

    protected function loadOptions()
    {
        if (!empty($this->optionsGenerator)) {
            $class = App::make($this->optionsGenerator, $this->optionsGeneratorParams);
            if ($class instanceof ISelectOptionsGenerator == false) {
                throw new \Exception('Options should be as key:value array or className that implements ISelectOptionsGenerator contract');
            }
            $options = $class->generate();
        } else {
            $options = $this->options;
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
        $this->optionsLoaded = true;
    }

    public function getTypeInstance()
    {
        $type = parent::getTypeInstance();
        $type->setOptions($this->getMetaParamValue('options', []));
        return $type;
    }
}
