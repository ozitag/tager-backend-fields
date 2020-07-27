<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class ImageField extends FileField
{
    public function getType()
    {
        return FieldType::Image;
    }
}
