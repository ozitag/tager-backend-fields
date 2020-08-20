<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use OZiTAG\Tager\Backend\Fields\Base\Type;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class TextType extends Type
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
