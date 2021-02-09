<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use OZiTAG\Tager\Backend\Fields\Base\Field;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;
use OZiTAG\Tager\Backend\Fields\Utils\ConfigLoader;

class GroupField extends Field
{
    protected array $fields;

    protected ?int $index = null;

    public function __construct(string $label, array $fields)
    {
        parent::__construct($label, FieldType::GROUP);

        $this->fields = ConfigLoader::loadFieldsFromConfig($fields);
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function setGroupIndex(int $index)
    {
        $this->index = $index;
    }

    public function getJson()
    {
        $result = [
            'name' => 'group' . ($this->index ?? ''),
            'type' => $this->getType(),
            'label' => $this->getLabel(),
            'meta' => new \stdClass(),
            'fields' => []
        ];

        foreach ($this->fields as $param => $field) {
            $result['fields'][] = $field->getJson();
        }

        return $result;
    }
}
