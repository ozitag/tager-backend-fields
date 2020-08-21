<?php

namespace OZiTAG\Tager\Backend\Fields;

use OZiTAG\Tager\Backend\Fields\Base\Field;
use OZiTAG\Tager\Backend\Fields\Contracts\IField;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;
use OZiTAG\Tager\Backend\Fields\Exceptions\InvalidTypeException;
use OZiTAG\Tager\Backend\Fields\Fields\ButtonField;
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
use OZiTAG\Tager\Backend\Fields\Fields\RepeaterField;
use OZiTAG\Tager\Backend\Fields\Fields\SelectField;
use OZiTAG\Tager\Backend\Fields\Fields\StringField;
use OZiTAG\Tager\Backend\Fields\Fields\TemplateField;
use OZiTAG\Tager\Backend\Fields\Fields\TextField;
use OZiTAG\Tager\Backend\Fields\Fields\TrueFalseField;
use OZiTAG\Tager\Backend\Fields\Fields\UrlField;
use OZiTAG\Tager\Backend\Fields\Types\ButtonType;
use OZiTAG\Tager\Backend\Fields\Types\ColorType;
use OZiTAG\Tager\Backend\Fields\Types\DateTimeType;
use OZiTAG\Tager\Backend\Fields\Types\DateType;
use OZiTAG\Tager\Backend\Fields\Types\FileType;
use OZiTAG\Tager\Backend\Fields\Types\GalleryType;
use OZiTAG\Tager\Backend\Fields\Types\HtmlType;
use OZiTAG\Tager\Backend\Fields\Types\ImageType;
use OZiTAG\Tager\Backend\Fields\Types\MapType;
use OZiTAG\Tager\Backend\Fields\Types\MultiSelectType;
use OZiTAG\Tager\Backend\Fields\Types\NumberType;
use OZiTAG\Tager\Backend\Fields\Types\SelectType;
use OZiTAG\Tager\Backend\Fields\Types\StringType;
use OZiTAG\Tager\Backend\Fields\Types\TemplateType;
use OZiTAG\Tager\Backend\Fields\Types\TextType;
use OZiTAG\Tager\Backend\Fields\Types\TrueFalseType;
use OZiTAG\Tager\Backend\Fields\Types\UrlType;

class FieldFactory
{
    /**
     * @param string $type
     * @param string $label
     * @param string $meta
     * @return Field
     */
    public static function create($type, $label, $meta = [])
    {
        switch ($type) {
            case FieldType::String:
                return new StringField($label);
            case FieldType::Text:
                return new TextField($label);
            case FieldType::Html:
                return new HtmlField($label);
            case FieldType::Number:
                return new NumberField($label);
            case FieldType::Url:
                return new UrlField($label);
            case FieldType::Color:
                return new ColorField($label);
            case FieldType::Date:
                return new DateField($label);
            case FieldType::DateTime:
                return new DateTimeField($label);
            case FieldType::TrueFalse:
                return new TrueFalseField($label);
            case FieldType::Select:
                return new SelectField($label);
            case FieldType::MultiSelect:
                return new MultiSelectField($label);
            case FieldType::Image:
                return new ImageField($label, $meta['scenario'] ?? null);
            case FieldType::Gallery:
                return new GalleryField($label, $meta['scenario'] ?? null);
            case FieldType::File:
                return new FileField($label, $meta['scenario'] ?? null);
            case FieldType::Map:
                return new MapField($label);
            case FieldType::Button:
                return new ButtonField($label);
            case FieldType::Template:
                return new TemplateField($label);
            case FieldType::Repeater:
                return new RepeaterField($label);
            default:
                throw new InvalidTypeException('Type "' . $fieldType . " can not be recognized");
        }
    }
}
