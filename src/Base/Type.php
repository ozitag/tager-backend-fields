<?php

namespace OZiTAG\Tager\Backend\Fields\Base;

use Ozerich\FileStorage\Storage;
use OZiTAG\Tager\Backend\Fields\Contracts\IType;

abstract class Type implements IType
{
    protected $value = null;

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function loadValueFromDatabase($value)
    {
        $this->setValue($value);
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getDatabaseValue()
    {
        return $this->getValue();
    }

    public function getPublicValue()
    {
        return $this->getValue();
    }

    public function getAdminJson()
    {
        return $this->getValue();
    }

    public function getAdminFullJson()
    {
        return $this->getValue();
    }

    public function getFileIds()
    {
        return [];
    }

    public function isFileType()
    {
        return false;
    }

    public function hasFiles()
    {
        return !empty($this->getFileIds());
    }

    public function applyFileScenario($scenario)
    {
        $fileStorage = new Storage();

        foreach ($this->getFileIds() as $fileId) {
            $fileStorage->setFileScenario($fileId, $scenario);
        }
    }

    public function isArray()
    {
        return false;
    }
}
