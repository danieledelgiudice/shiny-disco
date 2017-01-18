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