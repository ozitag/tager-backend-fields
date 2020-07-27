<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

abstract class Field
{
    abstract function validate();

    abstract function getValue();

    abstract function getAdminJson();

    abstract function getPublicJson();

    abstract function getDatabaseValue();

    protected $value;
}
