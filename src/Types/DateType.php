<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class DateType extends TextType
{
    public function getType()
    {
        return FieldType::Date;
    }
}
