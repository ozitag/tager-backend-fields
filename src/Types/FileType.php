<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Ozerich\FileStorage\Models\File;
use Ozerich\FileStorage\Repositories\FileRepository;
use OZiTAG\Tager\Backend\Fields\Base\Type;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;
use OZiTAG\Tager\Backend\Files\Enums\TagerFileThumbnail;

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
            $imageId = count($value) > 1 ? $value[0] : null;

            if(is_string($imageId)){
                $model = $this->fileRepository->find($value);
                $imageId = $model ? $model->id : null;
            }

            parent::setValue($imageId);
        } else if ($value instanceof Collection) {
            $first = $value->first();
            if ($first) {
                parent::setValue($first->id);
            } else {
                parent::setValue(null);
            }
        } else if ($value instanceof File) {
            parent::setValue($value->id);
        } else if (is_string($value)) {
            $model = $this->fileRepository->find($value);
            parent::setValue($model ? $model->id : null);
        }
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

        return $file->getFullJson(null, false, true, [TagerFileThumbnail::AdminList, TagerFileThumbnail::AdminView]);
    }

    public function getFileIds()
    {
        return $this->value ? [$this->value] : [];
    }

    public function getDatabaseValue()
    {
        return $this->value;
    }
}
