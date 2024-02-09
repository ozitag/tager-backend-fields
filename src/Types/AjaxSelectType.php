<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use Illuminate\Support\Facades\App;
use OZiTAG\Tager\Backend\Fields\Contracts\IPublicValueFormatter;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;
use OZiTAG\Tager\Backend\Utils\Helpers\StringHelper;

class AjaxSelectType extends StringType
{
    public function getType()
    {
        return FieldType::Select;
    }

    public function getLabelValue(){
        $value = $this->getValue();

        return $value['label'] ?? null;
    }

    public function getDatabaseValue()
    {
        return $this->value && is_array($this->value) ? json_encode($this->value) : null;
    }

    public function getAdminJson()
    {
        return $this->getValue();
    }

    public function getAdminFullJson()
    {
        return $this->getValue();
    }

    public function loadValueFromDatabase($value)
    {
        if(StringHelper::isJson($value)) {
            $jsonDecoded = @json_decode($value, true);

            if ($jsonDecoded === null && json_last_error() !== JSON_ERROR_NONE) {
                $value = ['value' => $value, 'label' => $value];
            } else {
                $value = $jsonDecoded;
            }
        } else{
            $value = ['value' => $value, 'label' => $value];
        }

        $this->setValue($value);
    }
}
