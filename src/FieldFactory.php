<?php

namespace OZiTAG\Tager\Backend\Fields;

use OZiTAG\Tager\Backend\Fields\Contracts\IField;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;
use OZiTAG\Tager\Backend\Fields\Fields\ColorField;
use OZiTAG\Tager\Backend\Fields\Fields\DateField;
use OZiTAG\Tager\Backend\Fields\Fields\DateTimeField;
use OZiTAG\Tager\Backend\Fields\Fields\FileField;
use OZiTAG\Tager\Backend\Fields\Fields\GalleryField;
use OZiTAG\Tager\Backend\Fields\Fields\HtmlField;
use OZiTAG\Tager\Backend\Fields\Fields\ImageField;
use OZiTAG\Tager\Backend\Fields\Fields\MapField;
use OZiTAG\Tager\Backend\Fields\Fields\MultiSelectField;
use OZiTAG\Tager\Backend\Fields\Fields\NumberField;
use OZiTAG\Tager\Backend\Fields\Fields\SelectField;
use OZiTAG\Tager\Backend\Fields\Fields\StringField;
use OZiTAG\Tager\Backend\Fields\Fields\TextField;
use OZiTAG\Tager\Backend\Fields\Fields\TrueFalseField;
use OZiTAG\Tager\Backend\Fields\Fields\UrlField;

class FieldFactory
{
    /**
     * @param $fieldType
     * @return IField
     */
    public static function create($fieldType)
    {
        switch ($fieldType) {
            case FieldType::String:
                return new StringField();
            case FieldType::Text:
                return new TextField();
            case FieldType::Html:
                return new HtmlField();
            case FieldType::Number:
                return new NumberField();
            case FieldType::Url:
                return new UrlField();
            case FieldType::Color:
                return new ColorField();
            case FieldType::Date:
                return new DateField();
            case FieldType::DateTime:
                return new DateTimeField();
            case FieldType::TrueFalse:
                return new TrueFalseField();
            case FieldType::Select:
                return new SelectField();
            case FieldType::MultiSelect:
                return new MultiSelectField();
            case FieldType::Image:
                return new ImageField();
            case FieldType::Gallery:
                return new GalleryField();
            case FieldType::File:
                return new FileField();
            case FieldType::Map:
                return new MapField();
        }
    }
}
