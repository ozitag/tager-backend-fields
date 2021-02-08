<?php

namespace OZiTAG\Tager\Backend\Fields;

use OZiTAG\Tager\Backend\Fields\Contracts\IType;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;
use OZiTAG\Tager\Backend\Fields\Exceptions\InvalidTypeException;
use OZiTAG\Tager\Backend\Fields\Types\ButtonType;
use OZiTAG\Tager\Backend\Fields\Types\ColorType;
use OZiTAG\Tager\Backend\Fields\Types\DateTimeType;
use OZiTAG\Tager\Backend\Fields\Types\DateType;
use OZiTAG\Tager\Backend\Fields\Types\FileType;
use OZiTAG\Tager\Backend\Fields\Types\GalleryType;
use OZiTAG\Tager\Backend\Fields\Types\GroupType;
use OZiTAG\Tager\Backend\Fields\Types\HtmlType;
use OZiTAG\Tager\Backend\Fields\Types\ImageType;
use OZiTAG\Tager\Backend\Fields\Types\MapType;
use OZiTAG\Tager\Backend\Fields\Types\MultiSelectType;
use OZiTAG\Tager\Backend\Fields\Types\NumberType;
use OZiTAG\Tager\Backend\Fields\Types\RepeaterType;
use OZiTAG\Tager\Backend\Fields\Types\SelectType;
use OZiTAG\Tager\Backend\Fields\Types\StringType;
use OZiTAG\Tager\Backend\Fields\Types\TemplateType;
use OZiTAG\Tager\Backend\Fields\Types\TextType;
use OZiTAG\Tager\Backend\Fields\Types\TrueFalseType;
use OZiTAG\Tager\Backend\Fields\Types\UrlType;

class TypeFactory
{
    /**
     * @param $fieldType
     * @return IType
     */
    public static function create($fieldType)
    {
        switch ($fieldType) {
            case FieldType::String:
                return new StringType();
            case FieldType::Text:
                return new TextType();
            case FieldType::Html:
                return new HtmlType();
            case FieldType::Number:
                return new NumberType();
            case FieldType::Url:
                return new UrlType();
            case FieldType::Color:
                return new ColorType();
            case FieldType::Date:
                return new DateType();
            case FieldType::DateTime:
                return new DateTimeType();
            case FieldType::TrueFalse:
                return new TrueFalseType();
            case FieldType::Select:
                return new SelectType();
            case FieldType::MultiSelect:
                return new MultiSelectType();
            case FieldType::Image:
                return new ImageType();
            case FieldType::Gallery:
                return new GalleryType();
            case FieldType::File:
                return new FileType();
            case FieldType::Map:
                return new MapType();
            case FieldType::Button:
                return new ButtonType();
            case FieldType::Template:
                return new TemplateType();
            case FieldType::Repeater:
                return new RepeaterType();
            case FieldType::GROUP:
                return new GroupType();
            default:
                throw new InvalidTypeException('Type "' . $fieldType . " can not be recognized");
        }
    }
}
