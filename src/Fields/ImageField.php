<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use OZiTAG\Tager\Backend\Fields\Base\Field;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class ImageField extends Field
{
    public function __construct($label, $scenario = null)
    {
        parent::__construct($label, FieldType::Image);

        $this->setMetaParam('scenario', $scenario);
    }
}
