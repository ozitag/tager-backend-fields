<?php

namespace OZiTAG\Tager\Backend\Fields\Contracts;

use Ozerich\FileStorage\Storage;

abstract class Field implements IField
{
    protected $value = null;

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getDatabaseValue()
    {
        return $this->value;
    }

    public function getPublicValue()
    {
        return $this->value;
    }

    public function getAdminJson()
    {
        return $this->value;
    }

    public function getAdminFullJson()
    {
        return $this->value;
    }

    public function getFileIds()
    {
        return [];
    }

    public function hasFiles()
    {
        return !empty($this->getFileIds());
    }

    public function applyFileScenario($scenario)
    {
        $fileStorage = new Storage();

        foreach($this->getFileIds() as $fileId){
            $fileStorage->setFileScenario($fileId, $scenario);
        }
    }
}
