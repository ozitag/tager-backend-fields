<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use Doctrine\DBAL\Types\TextType;
use OZiTAG\Tager\Backend\Fields\Base\Field;
use OZiTAG\Tager\Backend\Fields\Base\Type;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class RepeaterType extends Type
{
    /** @var Field[] */
    private $fields;

    /**
     * @param Field[]
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
    }

    public function getType()
    {
        return FieldType::Repeater;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function isArray()
    {
        return true;
    }

    public function getDatabaseValue()
    {
        return $this->value ? json_encode($this->value) : null;
    }

    public function loadValueFromDatabase($value)
    {
        if ($value) {
            $this->setValue(json_decode($value, true));
        }
    }

    public function setValue($value)
    {
        parent::setValue($value);
    }
}
