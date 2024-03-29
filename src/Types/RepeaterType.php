<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use Doctrine\DBAL\Types\TextType;
use Illuminate\Support\Facades\App;
use OZiTAG\Tager\Backend\Fields\Base\Field;
use OZiTAG\Tager\Backend\Fields\Base\Type;
use OZiTAG\Tager\Backend\Fields\Contracts\IPublicValueFormatter;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;
use OZiTAG\Tager\Backend\Fields\Fields\RepeaterField;
use OZiTAG\Tager\Backend\Fields\TypeFactory;

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

    public function getAdminFullJson()
    {
        $value = $this->getValue();
        if (!$value) {
            return [];
        }

        $fields = $this->fields;
        $result = [];

        foreach ($value as $valueRow) {
            $resultRow = [];

            foreach ($fields as $field) {

                $fieldValue = null;
                foreach ($valueRow as $valueItem) {
                    if ($valueItem['name'] == $field->getName()) {
                        $fieldValue = $valueItem['value'];
                        break;
                    }
                }

                $type = $field->getTypeInstance();
                if ($field instanceof RepeaterField && $type instanceof RepeaterType) {
                    $type->setFields($field->getFields());
                }
                $type->setValue($fieldValue);

                $resultRow[] = ['name' => $field->getName(), 'value' => $type->getAdminFullJson()];
            }

            $result[] = $resultRow;
        }

        return $result;
    }

    public function getPublicValue()
    {
        $value = $this->getValue();
        if (!$value) {
            return [];
        }

        $fields = $this->fields;

        $result = [];

        foreach ($value as $valueRow) {
            $resultRow = [];

            foreach ($fields as $field) {

                $fieldValue = null;
                foreach ($valueRow as $valueItem) {
                    if ($valueItem['name'] == $field->getName()) {
                        $fieldValue = $valueItem['value'];
                        break;
                    }
                }

                $type = $field->getTypeInstance();
                if ($field instanceof RepeaterField && $type instanceof RepeaterType) {
                    $type->setFields($field->getFields());
                }
                $type->setValue($fieldValue);

                $resultRow[$field->getName()] = $type->getPublicValue();
            }

            $result[] = $resultRow;
        }

        if ($result && $this->publicValueFormatter) {
            $formatter = App::make($this->publicValueFormatter);
            if ($formatter && $formatter instanceof IPublicValueFormatter) {
                return $formatter->format($result);
            }
        }

        return $result;
    }

    public function setValue($value)
    {
        parent::setValue($value);
    }
}
