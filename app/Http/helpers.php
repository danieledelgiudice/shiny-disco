<?php

function format_date($value) {
    if ($value instanceof \Carbon\Carbon)
        return $value->format('d/m/Y');
    else
        return '';
}

function date_diff_days($value) {
    \Carbon\Carbon::setLocale('it');
    
    if ($value->isToday()) return "oggi";
    if ($value->isYesterday()) return "ieri";
    if ($value->isTomorrow()) return "domani";
    
    $diffH = $value->diffForHumans();
    $s = format_date($value);
    return "$diffH ($s)";
}

function url_filiale($value, $f) {
    $id = $f->id;
    $pattern = '#/filiali/(\d+)/#i';
    $replacement = "/filiali/$id/";
    return preg_replace($pattern, $replacement, $value);
}

function format_money($value) {
    if ($value == null) return '';
    return number_format($value, 2, ',', '.') . ' €';
}

function format_field($queryFields, $model, $field) {
    $type = $queryFields[$field]['type'];
    $original_field = $field;
    
    if(strpos($field, '-') !== false) {
        list($rel, $field) = explode('-', $field);
        $model = $model->{$rel};
    }
    
    if($model->{$field} === null || $model->{$field} === '')
        return '';
    
    if ($type === 'string')
        return $model->{$field};
    else if ($type === 'date')
        return format_date($model->{$field});
    else if ($type === 'decimal')
        return format_money($model->{$field});
    else if ($type === 'enum') {
        return $queryFields[$original_field]['list'][$model->{$field}];
    }
    
    return '';
}