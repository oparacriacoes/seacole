<?php

function human_boolean($value): bool
{
    if (is_null($value)) {
        return '';
    } elseif ($value === true) {
        return 'Sim';
    } elseif ($value === false) {
        return 'Não';
    }

    throw new Exception("Por favor insira apenas valores booleanos e null", 1);
}
