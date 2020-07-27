<?php

namespace OZiTAG\Tager\Backend\Fields\Contracts;

interface IField
{
    public function setValue($value);

    public function getDatabaseValue();

    public function getPublicValue();

    public function getAdminJson();

    public function getAdminFullJson();

    public function getFileIds();
}
