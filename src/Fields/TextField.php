<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use OZiTAG\Tager\Backend\Fields\Contracts\Field;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class TextField extends Field
{
    public function getType()
    {
        return FieldType::Text;
    }

    public function getAdminJson()
    {
        return (string)$this->value;
    }

    public function getPublicValue()
    {
        return (string)$this->value;
    }
}
