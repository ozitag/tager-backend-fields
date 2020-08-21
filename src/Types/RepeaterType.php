<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use Doctrine\DBAL\Types\TextType;
use OZiTAG\Tager\Backend\Fields\Base\Type;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class RepeaterType extends Type
{
    public function getType()
    {
        return FieldType::Repeater;
    }

    public function getValue()
    {
        return null;
    }
}
