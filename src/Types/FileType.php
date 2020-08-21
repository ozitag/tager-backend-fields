<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Ozerich\FileStorage\Models\File;
use Ozerich\FileStorage\Repositories\FileRepository;
use OZiTAG\Tager\Backend\Fields\Base\Type;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class FileType extends Type
{
    private $fileRepository;

    public function __construct()
    {
        $this->fileRepository = App::make(FileRepository::class);
    }

    public function getType()
    {
        return FieldType::File;
    }

    public function setValue($value)
    {
        if (is_array($value)) {
            return parent::setValue($value[0]);
        }

        if ($value instanceof Collection) {
            return parent::setValue($value->first()->id);
        }

        return parent::setValue($value);
    }

    public function isFileType()
    {
        return true;
    }

    protected function file()
    {
        return $this->fileRepository->find($this->value);
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
