<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use OZiTAG\Tager\Backend\Fields\Base\Field;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class TextField extends Field
{
    public function __construct(string $label, ?string $placeholder = null)
    {
        parent::__construct($label, FieldType::Text);

        $this->setPlaceholder($placeholder);
    }
}
