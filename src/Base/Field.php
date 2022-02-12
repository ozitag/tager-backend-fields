<?php

namespace OZiTAG\Tager\Backend\Fields\Base;

use OZiTAG\Tager\Backend\Fields\TypeFactory;

abstract class Field
{
    private $type;

    private $label;

    protected $publicValueFormatter;

    protected ?int $maximumItemsCount = null;

    protected ?string $placeholder = null;

    private $name = null;

    protected $meta = [];

    public function __construct($label, $type)
    {
        $this->label = $label;
        $this->type = $type;
    }

    protected function setPlaceholder(?string $placeholder)
    {
        $this->placeholder = $placeholder;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    protected function setMetaParam(string $param, $value)
    {
        $this->meta[$param] = $value;
        return $this;
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

    public function getName()
    {
        return $this->name;
    }

    public function getJson()
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'label' => $this->label,
            'placeholder' => $this->placeholder,
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
        $type = TypeFactory::create($this->type);

        if ($this->publicValueFormatter) {
            $type->setPublicValueFormatter($this->publicValueFormatter);
        }

        return $type;
    }

    public function setPublicValueFormatter($formatter)
    {
        $this->publicValueFormatter = $formatter;

        return $this;
    }

    public function setMaximumItemsCount($maximumItemsCount = null)
    {
        $this->meta['maximumItemsCount'] = $maximumItemsCount;

        return $this;
    }
}
