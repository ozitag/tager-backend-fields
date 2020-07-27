<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class DateField extends TextField
{
    public function getType()
    {
        return FieldType::Date;
    }
}
