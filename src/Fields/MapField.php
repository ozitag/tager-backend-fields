<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class MapField extends TextField
{
    public function getType()
    {
        return FieldType::Map;
    }
}
