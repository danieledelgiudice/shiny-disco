<?php

function format_date($value) {
    if ($value instanceof \Carbon\Carbon)
        return $value->format('d/m/Y');
    else
        return '';
}