<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use OZiTAG\Tager\Backend\Fields\Contracts\Field;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class TrueFalseField extends Field
{
    public function getType()
    {
        return FieldType::TrueFalse;
    }

    public function getValue()
    {
        return $this->value ? true : false;
    }

    public function getAdminJson()
    {
        return $this->value ? true : false;
    }

    public function getPublicValue()
    {
        return $this->value ? true : false;
    }

    public function getDatabaseValue()
    {
        return $this->value ? 1 : 0;
    }
}
