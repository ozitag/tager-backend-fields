<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class DateTimeType extends StringType
{
    public function getType()
    {
        return FieldType::DateTime;
    }
}
