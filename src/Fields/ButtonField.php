<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use OZiTAG\Tager\Backend\Fields\Base\Field;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class ButtonField extends Field
{
    public function __construct($label)
    {
        parent::__construct($label, FieldType::Repeater);
    }
}