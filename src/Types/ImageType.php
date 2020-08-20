<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class ImageType extends FileType
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
