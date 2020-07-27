<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use Ozerich\FileStorage\Models\File;
use Ozerich\FileStorage\Repositories\FileRepository;
use OZiTAG\Tager\Backend\Fields\Contracts\Field;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class FileField extends Field
{
    public function getType()
    {
        return FieldType::File;
    }

    protected function file()
    {
        $repository = new FileRepository(new File());
        return $repository->find($this->value);
    }

    public function getValue()
    {
        return $this->file();
    }

    public function getAdminJson()
    {
        return $this->getAdminFullJson();
    }

    public function getAdminFullJson()
    {
        $file = $this->file();
        if (!$file) {
            return null;
        }

        return $file->getShortJson();
    }

    public function getPublicValue()
    {
        $file = $this->file();
        if (!$file) {
            return null;
        }

        return $file->getFullJson();
    }

    public function getFileIds()
    {
        return $this->value ? [$this->value] : [];
    }
}
