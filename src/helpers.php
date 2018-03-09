<?php

function clean_string_upper(string $string): string
{
    return strtoupper(trim($string));
}

function clean_string_lower(string $string): string
{
    return strtolower(trim($string));
}
