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
    protected array $options = [];

    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    public function getType()
    {
        return FieldType::MultiSelect;
    }

    public function getValue()
    {
        if (empty($this->value)) {
            return [];
        }

        if(is_array($this->value)){
            return $this->value;
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

    public function getLabelValue(){
        $value = $this->getValue();

        $result = [];
        foreach($value as $valueItem){
           $found = null;
           foreach($this->options as $option){
               if($option['value'] === $valueItem){
                   $found = $option['label'];
               }
           }

           $result[] = $found ?? $valueItem;
        }

        return implode(', ', $result);
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

    public function getAdminFullJson()
    {
        $value = $this->getValue();

        $result = [];

        foreach ($value as $valueItem) {
            foreach ($this->options as $option) {
                if ($option['value'] == $valueItem) {
                    $result[] = $option['value'];
                }
            }
        }

        return $result;
    }

    public function isArray()
    {
        return true;
    }
}
