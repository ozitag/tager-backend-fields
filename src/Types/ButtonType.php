<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use OZiTAG\Tager\Backend\Fields\Base\Type;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class ButtonType extends Type
{
    private $label = null;

    private $action = null;

    public function getType()
    {
        return FieldType::Button;
    }

    public function getDatabaseValue()
    {
        if (is_array($this->value) && isset($this->value['label']) && isset($this->value['link'])) {
            return json_encode([
                'label' => $this->value['label'],
                'link' => $this->value['link'],
                'isNewTab' => isset($this->value['isNewTab']) ? (boolean)$this->value['isNewTab'] : false
            ]);
        } else {
            return null;
        }
    }

    public function loadValueFromDatabase($value)
    {
        if (!$value) {
            $this->setValue(null);
            return;
        }

        $value = json_decode($value, true);
        if ($value === null) {
            $this->setValue(null);
            return;
        }

        $this->setValue([
            'label' => $value['label'] ?? '',
            'link' => $value['link'] ?? '',
            'isNewTab' => isset($value['isNewTab']) ? boolval($value['isNewTab']) : false
        ]);
    }

    public function getPublicValue()
    {
        return $this->getAdminFullJson();
    }

    public function getAdminJson()
    {
        return $this->getAdminFullJson();
    }

    public function getAdminFullJson()
    {
        if (!$this->value) {
            return null;
        }

        return $this->value;
    }
}
