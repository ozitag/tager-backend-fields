<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use OZiTAG\Tager\Backend\Fields\Base\Field;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class TemplateField extends Field
{
    public function __construct($label, $params = [])
    {
        parent::__construct($label, FieldType::Template);

        $this->setMetaParam('params', $params);
    }
}
