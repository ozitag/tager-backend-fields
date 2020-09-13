<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use OZiTAG\Tager\Backend\Fields\Base\Field;
use OZiTAG\Tager\Backend\Fields\Base\Type;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;
use OZiTAG\Tager\Backend\Fields\Enums\RepeaterView;
use OZiTAG\Tager\Backend\Fields\TypeFactory;
use OZiTAG\Tager\Backend\Fields\Utils\ConfigLoader;

class RepeaterField extends Field
{
    /** @var Field[] */
    private $fields = [];

    public function __construct($label, $fields = [], $view = RepeaterView::Table)
    {
        parent::__construct($label, FieldType::Repeater);

        $this->setViewMode($view);

        if (!empty($fields)) {
            $this->setFields($fields);
        }
    }

    public function setViewMode($viewMode)
    {
        if (RepeaterView::hasValue($viewMode)) {
            $this->setMetaParam('view', $viewMode);
        }
    }

    public function setFields($configFields)
    {
        $this->fields = ConfigLoader::loadFieldsFromConfig($configFields);
    }

    /**
     * @return Field[]
     */
    public function getFields()
    {
        return $this->fields;
    }

    public function getJson()
    {
        $result = parent::getJson();

        $result['fields'] = [];
        foreach ($this->fields as $param => $field) {
            $result['fields'][] = array_merge(['name' => $param], $field->getJson());
        }

        return $result;
    }

    /**
     * @return Type
     */
    public function getTypeInstance()
    {
        $type = TypeFactory::create(FieldType::Repeater);
        $type->setFields($this->getFields());
        return $type;
    }
}
