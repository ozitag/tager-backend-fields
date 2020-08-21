<?php

namespace OZiTAG\Tager\Backend\Fields\Utils;

use OZiTAG\Tager\Backend\Fields\Base\Field;
use OZiTAG\Tager\Backend\Fields\FieldFactory;

class ConfigLoader
{
    /**
     * @param array $fieldsConfig
     * @return Field[]
     */
    public static function loadFieldsFromConfig($fieldsConfig)
    {
        $result = [];

        foreach ($fieldsConfig as $param => $field) {
            if ($field instanceof Field) {
                $result[$param] = $field;
            } else if (is_array($field)) {
                if (isset($field['type']) && isset($field['label'])) {

                    try {
                        $fieldModel = FieldFactory::create($field['type'], $field['label'], $field['meta'] ?? []);
                    } catch (\Exception $exception) {
                        continue;
                    }

                    if ($fieldModel) {
                        $result[$param] = $fieldModel;
                    }
                }
            }
        }

        return $result;
    }
}
