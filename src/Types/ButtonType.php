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

    public function setValue($value)
    {
        if (is_array($value)) {
            if (isset($value['label']) && isset($value['action'])) {
                $this->label = $value['label'];
                $this->action = $value['action'];
            } else if (count($value) == 2) {
                [$this->label, $this->action] = $value;
            }
        } else if (is_string($value)) {
            $value = json_decode($value, true);
            $this->setValue($value);
        }
    }

    public function getValue()
    {
        if (!$this->label && !$this->action) {
            return null;
        }

        return [
            'label' => $this->label,
            'action' => $this->action
        ];
    }
    
    public function getDatabaseValue()
    {
        if (!$this->label && !$this->action) {
            return null;
        }

        return json_encode([
            'label' => $this->label,
            'action' => $this->action
        ]);
    }

    public function getAdminJson()
    {
        if (!$this->label && !$this->action) {
            return null;
        }

        return $this->label . ' (' . $this->action ? $this->action : 'No action' . ')';
    }
}
