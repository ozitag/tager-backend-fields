<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class SelectType extends StringType
{
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
        return $this->getValue();
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
