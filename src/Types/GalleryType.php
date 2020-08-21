<?php

namespace OZiTAG\Tager\Backend\Fields\Types;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Ozerich\FileStorage\Models\File;
use Ozerich\FileStorage\Repositories\FileRepository;
use OZiTAG\Tager\Backend\Fields\Base\Type;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;

class GalleryType extends Type
{
    private $fileRepository;

    public function __construct()
    {
        $this->fileRepository = App::make(FileRepository::class);
    }

    public function getType()
    {
        return FieldType::Gallery;
    }

    public function isFileType()
    {
        return true;
    }

    /**
     * @return File[]
     */
    private function files()
    {
        if ($this->value instanceof Collection || is_array($this->value)) {
            $items = $this->value;
        } else {
            $items = $this->value ? explode(',', $this->value) : [];
        }

        if (empty($items)) {
            return [];
        }

        $result = [];

        foreach ($items as $item) {
            $model = $item instanceof File ? $item : $this->fileRepository->find($item);
            if ($model) {
                $result[] = $model;
            }
        }

        return $result;
    }

    public function getValue()
    {
        return $this->files();
    }

    public function getAdminJson()
    {
        $result = [];

        foreach ($this->files() as $file) {
            $result[] = $file->getUrl();
        }

        return $result;
    }

    public function getAdminFullJson()
    {
        $result = [];

        foreach ($this->files() as $file) {
            $result[] = $file->getShortJson();
        }

        return $result;
    }

    public function getPublicValue()
    {
        $result = [];

        foreach ($this->files() as $file) {
            $result[] = $file->getFullJson();
        }

        return $result;
    }

    public function getFileIds()
    {
        return $this->value;
    }

    public function getDatabaseValue()
    {
        if (!$this->value) {
            return null;
        }

        if (is_array($this->value)) {
            return implode(',', $this->value);
        }

        return $this->value;
    }
}
