<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use OZiTAG\Tager\Backend\Fields\Base\Field;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;
use OZiTAG\Tager\Backend\Fields\Enums\RepeaterView;
use OZiTAG\Tager\Backend\Fields\Utils\ConfigLoader;

class RepeaterField extends Field
{
    /** @var Field[] */
    private $fields = [];

    public function __construct($label, $fields, $view = RepeaterView::Table)
    {
        parent::__construct($label, FieldType::Repeater);

        $this->setMetaParam('view', $view);

        $this->fields = ConfigLoader::loadFieldsFromConfig($fields);
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
}
