<?php

namespace OZiTAG\Tager\Backend\Fields\Structures;

use OZiTAG\Tager\Backend\Fields\Base\Field;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class MultiSelectField extends Field
{
    public function __construct($label)
    {
        parent::__construct($label, FieldType::MultiSelect);
    }
}
