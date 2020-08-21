<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use OZiTAG\Tager\Backend\Fields\Base\Field;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;
use OZiTAG\Tager\Backend\Fields\Enums\RepeaterView;

class RepeaterField extends Field
{
    public function __construct($label, $fields, $view = RepeaterView::Table)
    {
        parent::__construct($label, FieldType::Url);
    }
}
