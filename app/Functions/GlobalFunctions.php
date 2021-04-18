<?php

function human_boolean($value)
{
    if (is_null($value)) {
        return '';
    }

    if ($value === true) {
        return 'Sim';
    }

    return 'Não';
}
