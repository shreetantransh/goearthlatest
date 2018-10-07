<?php

use App\Models\Attribute;

function attributeType()
{
    return [
        Attribute::TYPE_TEXT => 'Text',
        Attribute::TYPE_INTEGER => 'Number',
        Attribute::TYPE_DOUBLE => 'Decimal',
        Attribute::TYPE_DATE => 'Date',
        Attribute::TYPE_TEXTAREA => 'Textarea',
        Attribute::TYPE_DROPDOWN => 'Dropdown',
        Attribute::TYPE_CHECKBOX => 'Checkbox',
        Attribute::TYPE_RADIO => 'Radio',
        Attribute::TYPE_MULTISELECT => 'Multiselect',
        Attribute::TYPE_IMAGE => 'Image'
    ];
}

function validationType($index)
{

    $type[Attribute::TYPE_TEXT] = 'string';
    $type[Attribute::TYPE_INTEGER] = 'numeric';
    $type[Attribute::TYPE_DOUBLE] = 'numeric';
    $type[Attribute::TYPE_DATE] = 'date_format:d/m/Y';
    $type[Attribute::TYPE_TEXTAREA] = '';
    $type[Attribute::TYPE_DROPDOWN] = '';
    $type[Attribute::TYPE_CHECKBOX] = 'array';
    $type[Attribute::TYPE_RADIO] = '';
    $type[Attribute::TYPE_MULTISELECT] = 'array';
    $type[Attribute::TYPE_IMAGE] = '\'mimes:jpeg,jpg,png\'';

    return isset($type[$index]) ? $type[$index] : '';
}

function camelToText($input)
{
    preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
    $ret = $matches[0];
    foreach ($ret as &$match) {
        $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
    }
    return implode('_', $ret);
}


