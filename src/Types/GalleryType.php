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

    private $hasCaptions = false;

    public function __construct()
    {
        $this->fileRepository = App::make(FileRepository::class);
    }

    public function setHasCaptions($hasCaptions)
    {
        $this->hasCaptions = (bool)$hasCaptions;
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
        if ($this->value instanceof Collection) {
            $items = $this->value;
        } else {
            $items = $this->getFileIds();
        }

        if (empty($items)) {
            return [];
        }

        $result = [];

        foreach ($items as $item) {
            $model = $item instanceof File ? $item : $this->fileRepository->find($item);
            if ($model) {
                $result[$model->id] = $model;
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

        if ($this->hasCaptions == false) {
            foreach ($this->files() as $file) {
                $result[] = $file->getShortJson();
            }
        } else {
            $files = $this->files();
            foreach ($this->value as $valueItem) {
                $result[] = [
                    'file' => $files[$valueItem['id']] ? $files[$valueItem['id']]->getShortJson() : null,
                    'caption' => $valueItem['caption'],
                ];
            }
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
        if ($this->hasCaptions) {
            return $this->value ? array_map(function ($item) {
                return $item['id'];
            }, $this->value) : [];
        }

        return $this->value;
    }

    public function setValue($value)
    {
        if (!$value) return;

        $result = [];

        if ($value instanceof Collection) {
            foreach ($value as $item) {
                if ($this->hasCaptions) {
                    $result[] = [
                        'id' => $item->id,
                        'caption' => null
                    ];
                } else {
                    $result[] = $item->id;
                }
            }
        } else if (is_array($value)) {
            if ($this->hasCaptions) {
                foreach ($value as $valueItem) {
                    if (is_numeric($valueItem)) {
                        $result[] = [
                            'id' => $valueItem,
                            'caption' => "",
                        ];
                    } else {
                        if (!isset($valueItem['id'])) continue;
                        $result[] = [
                            'id' => $valueItem['id'],
                            'caption' => $valueItem['caption'] ?? ''
                        ];
                    }
                }
            } else {
                foreach ($value as $valueItem) {
                    if (is_numeric($valueItem)) {
                        $result[] = $valueItem;
                    } else {
                        if (!isset($valueItem['id'])) continue;
                        $result[] = $valueItem['id'];
                    }
                }
            }
        }

        parent::setValue($result);
    }

    public function getDatabaseValue()
    {
        if (!$this->value) {
            return null;
        }

        if (!is_array($this->value)) {
            return null;
        }

        $result = [];

        foreach ($this->value as $item) {
            $caption = $item['caption'] ?? '';
            $id = is_array($item) ? ($item['id'] ?? null) : $item;
            if (!$id) continue;

            if ($this->hasCaptions) {
                $result[] = [
                    'id' => $id,
                    'caption' => $caption
                ];
            } else {
                $result[] = $id;
            }
        }

        return $this->hasCaptions ? json_encode($result) : implode(',', $result);
    }

    public function loadValueFromDatabase($value)
    {
        $result = [];

        $data = json_decode($value, true);
        if ($data) {
            foreach ($data as $item) {
                if (isset($item['id'])) {
                    if ($this->hasCaptions) {
                        $result[] = [
                            'id' => (int)$item['id'],
                            'caption' => $item['caption'] ?? ''
                        ];
                    } else {
                        $result[] = (int)$item['id'];
                    }
                }
            }
        } else {
            $data = explode(',', $value);
            foreach ($data as $item) {
                if ($this->hasCaptions) {
                    $result[] = [
                        'id' => (int)$item,
                        'caption' => ''
                    ];
                } else {
                    $result[] = (int)$item;
                }
            }
        }

        parent::setValue($result);
    }

    public function isArray()
    {
        return true;
    }
}