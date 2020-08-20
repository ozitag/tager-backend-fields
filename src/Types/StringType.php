<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class StringType extends TextType
{
    public function getType()
    {
        return FieldType::String;
    }
}
