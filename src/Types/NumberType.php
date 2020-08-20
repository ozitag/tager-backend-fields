<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class NumberType extends StringType
{
    public function getType()
    {
        return FieldType::Number;
    }

    public function getValue()
    {
        return floatval($this->value);
    }
    
    public function getDatabaseValue()
    {
        return floatval($this->value);
    }

    public function getPublicValue()
    {
        return floatval($this->value);
    }
}
