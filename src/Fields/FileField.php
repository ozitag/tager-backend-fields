<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use OZiTAG\Tager\Backend\Fields\Base\Field;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class FileField extends Field
{
    public function __construct($label, $scenario)
    {
        parent::__construct($label, FieldType::File);

        $this->setMetaParam('scenario', $scenario);
    }
}
