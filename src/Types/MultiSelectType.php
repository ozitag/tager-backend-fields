<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use Doctrine\DBAL\Types\TextType;
use Illuminate\Support\Facades\App;
use Ozerich\FileStorage\Storage;
use OZiTAG\Tager\Backend\Fields\Base\Type;
use OZiTAG\Tager\Backend\Fields\Contracts\IPublicValueFormatter;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class MultiSelectType extends Type
{
    public function getType()
    {
        return FieldType::MultiSelect;
    }

    public function getValue()
    {
        if (empty($this->value)) {
            return [];
        }

        return explode(',', $this->value);
    }

    public function getPublicValue()
    {
        $value = $this->getValue();

        if ($value && $this->publicValueFormatter) {
            $formatter = App::make($this->publicValueFormatter);
            if ($formatter && $formatter instanceof IPublicValueFormatter) {
                $result = [];
                foreach ($value as $ind => $item) {
                    $result[$ind] = $formatter->format($item);
                }
                return $result;
            }
        }

        return $this->getValue();
    }

    public function getDatabaseValue()
    {
        if (!$this->value) {
            return null;
        }

        if (!is_array($this->value)) {
            return null;
        }

        return implode(',', $this->value);
    }

    public function isArray()
    {
        return true;
    }
}
