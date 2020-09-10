<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use Doctrine\DBAL\Types\TextType;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class MultiSelectType extends StringType
{
    public function getType()
    {
        return FieldType::MultiSelect;
    }

    public function isArray()
    {
        return true;
    }
}
