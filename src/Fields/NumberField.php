<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class NumberField extends TextField
{
    public function getType()
    {
        return FieldType::Number;
    }
    
    public function getDatabaseValue()
    {
        return floatval($this->value);
    }
}
