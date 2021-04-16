<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use OZiTAG\Tager\Backend\Fields\Base\Field;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class TrueFalseField extends Field
{
    public function __construct(string $label)
    {
        parent::__construct($label, FieldType::TrueFalse);
    }
}
