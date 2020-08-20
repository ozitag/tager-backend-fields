<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use Doctrine\DBAL\Types\TextType;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class MapType extends StringType
{
    public function getType()
    {
        return FieldType::Map;
    }
}
