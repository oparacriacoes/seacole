<?php

function human_boolean($value): ?string
{
    if (is_null($value)) {
        return '';
    } elseif ($value === true) {
        return 'Sim';
    } elseif ($value === false) {
        return 'Não';
    }

    throw new Exception("Por favor insira apenas valores booleanos ou null", 1);
}
