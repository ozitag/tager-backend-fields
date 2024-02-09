<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use Illuminate\Support\Facades\App;
use OZiTAG\Tager\Backend\Fields\Base\Field;
use OZiTAG\Tager\Backend\Fields\Contracts\ISelectOptionsGenerator;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class AjaxSelectField extends Field
{
    public function __construct(string $label, protected string $requestUrl)
    {
        parent::__construct($label, FieldType::AjaxSelect);
    }

    public function getMeta()
    {
        return [
            'requestUrl' => $this->requestUrl,
        ];
    }

    public function getTypeInstance()
    {
        $type = parent::getTypeInstance();
        return $type;
    }
}
