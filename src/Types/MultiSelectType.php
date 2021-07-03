<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use Doctrine\DBAL\Types\TextType;
use Illuminate\Support\Facades\App;
use OZiTAG\Tager\Backend\Fields\Contracts\IPublicValueFormatter;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class MultiSelectType extends StringType
{
    public function getType()
    {
        return FieldType::MultiSelect;
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

    public function isArray()
    {
        return true;
    }
}
