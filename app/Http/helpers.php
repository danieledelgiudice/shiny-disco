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
    if ($f instanceof \App\Filiale)
        $id = $f->id;
    else
        $id = $f;
    $pattern = '#/filiali/(\d+)/#i';
    $replacement = "/filiali/$id/";
    return preg_replace($pattern, $replacement, $value);
}

function format_money($value) {
    if ($value === null) return '';
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
    else if ($type === 'date_eq')
        return format_date($model->{$field});
    else if ($type === 'decimal')
        return format_money($model->{$field});
    else if ($type === 'enum') {
        $index = $model->{$field};
        $enum = $queryFields[$original_field]['list'];
        return isset($enum[$index]) ? $enum[$index] : '';
    }
    
    return '';
}

function appartenenza_fatture($appartenenza) {
    switch($appartenenza) {
        case 1:
            return 'Ely\'s';
        case 2:
            return 'Elisir';
        case 3:
            return 'Ely\'s Elisir Group';
        default:
            return '';
    }
}

function formatta_testo($s) {
    $s = e($s);
    $s = preg_replace('#\*(.*?)\*#', '<b>$1</b>', $s);   // bold
    $s = preg_replace('#_(.*?)_#', '<del>$1</del>', $s); // strikethrough
    return $s;
}