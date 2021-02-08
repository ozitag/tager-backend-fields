<?php

namespace OZiTAG\Tager\Backend\Fields\Enums;

use OZiTAG\Tager\Backend\Core\Enums\Enum;

class FieldType extends Enum
{
    const String = 'STRING';
    const Text = 'TEXT';
    const Html = 'HTML';
    const Number = 'NUMBER';
    const Url = 'URL';
    const Color = 'COLOR';
    const Date = 'DATE';
    const DateTime = 'DATETIME';
    const TrueFalse = 'TRUE_FALSE';
    const Select = 'SELECT';
    const MultiSelect = 'MULTISELECT';
    const Image = 'IMAGE';
    const Gallery = 'GALLERY';
    const File = 'FILE';
    const Map = 'MAP';
    const Button = 'BUTTON';
    const Template = 'TEMPLATE';

    const Repeater = 'REPEATER';
    const GROUP = 'GROUP';
}
