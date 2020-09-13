<?php

namespace OZiTAG\Tager\Backend\Fields\Base;

use OZiTAG\Tager\Backend\Fields\TypeFactory;

abstract class Field
{
    private $type;

    private $label;

    protected $meta = [];

    public function __construct($label, $type)
    {
        $this->label = $label;
        $this->type = $type;
    }

    protected function setMetaParam($param, $value)
    {
        $this->meta[$param] = $value;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getMeta()
    {
        return $this->meta;
    }

    public function getJson()
    {
        return [
            'type' => $this->getType(),
            'label' => $this->getLabel(),
            'meta' => empty($this->getMeta()) ? new \stdClass() : $this->getMeta()
        ];
    }

    public function getMetaParamValue($param, $default = null)
    {
        return isset($this->meta[$param]) ? $this->meta[$param] : $default;
    }

    /**
     * @return Type
     */
    public function getTypeInstance()
    {
        return TypeFactory::create($this->type);
    }
}
