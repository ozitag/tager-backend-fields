<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class UrlField extends TextField
{
    public function getType()
    {
        return FieldType::Url;
    }
}
