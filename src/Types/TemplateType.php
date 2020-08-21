<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use OZiTAG\Tager\Backend\Fields\Base\Type;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class TemplateType extends TextType
{
    public function getType()
    {
        return FieldType::Template;
    }
}
