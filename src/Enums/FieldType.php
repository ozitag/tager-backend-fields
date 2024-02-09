<?php

namespace OZiTAG\Tager\Backend\Fields\Enums;

enum FieldType:string
{
    case String = 'STRING';
    case Text = 'TEXT';
    case Html = 'HTML';
    case Number = 'NUMBER';
    case Url = 'URL';
    case Color = 'COLOR';
    case Date = 'DATE';
    case DateTime = 'DATETIME';
    case TrueFalse = 'TRUE_FALSE';
    case Select = 'SELECT';
    case AjaxSelect = 'AJAX_SELECT';
    case MultiSelect = 'MULTI_SELECT';
    case Image = 'IMAGE';
    case Gallery = 'GALLERY';
    case File = 'FILE';
    case Map = 'MAP';
    case Button = 'BUTTON';
    case Template = 'TEMPLATE';

    case Repeater = 'REPEATER';
    case GROUP = 'GROUP';
}
