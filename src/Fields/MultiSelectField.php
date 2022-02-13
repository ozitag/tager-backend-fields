<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class MultiSelectField extends SelectField
{
    public function getSelectType()
    {
        return FieldType::MultiSelect;
    }
}
