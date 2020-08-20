<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use OZiTAG\Tager\Backend\Fields\Base\Type;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class TrueFalseType extends Type
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
