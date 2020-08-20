<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class ColorType extends TextType
{
    public function getType()
    {
        return FieldType::Color;
    }
}
