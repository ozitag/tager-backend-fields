<?php

namespace OZiTAG\Tager\Backend\Fields\Contracts;

interface IType
{
    public function setValue($value);

    public function getValue();

    public function getDatabaseValue();

    public function getPublicValue();

    public function getAdminJson();

    public function getAdminFullJson();

    public function getFileIds();

    public function isFileType();

    public function isArray();
}
