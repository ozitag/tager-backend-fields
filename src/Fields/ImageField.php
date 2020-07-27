<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class ImageField extends FileField
{
    public function getType()
    {
        return FieldType::Image;
    }

    public function getAdminJson()
    {
        $file = $this->file();
        if (!$file) {
            return null;
        }

        return $file->getUrl();
    }
}
