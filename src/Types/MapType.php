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

    public function getDatabaseValue()
    {
        if (is_array($this->value) && isset($this->value['latitude']) && isset($this->value['longitude'])) {
            return floatval($this->value['latitude']) . ';' . floatval($this->value['longitude']);
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

        $value = explode(';', $value);
        if (count($value) !== 2) {
            $this->setValue(null);
            return;
        }

        $latitude = $value[0];
        $longitude = $value[1];

        if (!is_numeric($latitude) || !is_numeric($longitude)) {
            $this->setValue(null);
            return;
        }

        $this->setValue([
            'latitude' => floatval($latitude),
            'longitude' => floatval($longitude)
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
