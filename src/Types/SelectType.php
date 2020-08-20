<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class SelectType extends StringType
{
    public function getType()
    {
        return FieldType::Select;
    }
}
