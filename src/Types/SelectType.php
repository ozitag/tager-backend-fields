<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use Illuminate\Support\Facades\App;
use OZiTAG\Tager\Backend\Fields\Contracts\IPublicValueFormatter;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class SelectType extends StringType
{
    protected array $options = [];

    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    public function getType()
    {
        return FieldType::Select;
    }

    public function getValue()
    {
        if (empty($this->value)) {
            return null;
        }

        return $this->value;
    }

    public function getPublicValue()
    {
        $value = $this->getValue();

        if ($value && $this->publicValueFormatter) {
            $formatter = App::make($this->publicValueFormatter);
            if ($formatter && $formatter instanceof IPublicValueFormatter) {
                return $formatter->format($value);
            }
        }

        return $this->getValue();
    }

    public function getLabelValue(){
        $valueItem = $this->getValue();

        foreach($this->options as $option){
            if($option['value'] === $valueItem){
                return $option['label'];
            }
        }

        return $valueItem;
    }

    public function getAdminJson()
    {
        return $this->getValue();
    }

    public function getAdminFullJson()
    {
        return $this->getValue();
    }
}
