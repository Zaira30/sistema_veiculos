<?php

use Carbon\Carbon;

function remove_mask_telefone($text)
{
    $text = str_replace(['(',')','-'],'',  $text);
    $text = str_replace(' ','', $text);

    return $text;
}

function remove_mask_cep($text)
{
    $text = str_replace(['.','-'],'',  $text);

    return $text;
}

function remove_mask_cpf($text)
{
    $text = str_replace(['.','.','-'],'',  $text);

    return $text;
}

function remove_mask_cnpj($text)
{
    $text = str_replace(['.','.','/','-'],'',  $text);

    return $text;
}



function simple_date_format($date)
{
    $date = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');

    return $date;
}