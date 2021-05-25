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

function join_colors_to_black($collection)
{
    return $collection->pluck('cor_raca')
        ->filter(function ($cor_raca) {
            return $cor_raca != 'Parda';
        })
        ->map(function ($cor_raca) {
            return $cor_raca == 'Preta' ? 'Negra' : $cor_raca;
        })->values();
}

function stack_black_colors(array $datasets)
{
    return array_map(function ($dataset) {
        $dataset['xAxisID'] = 'xAxis1';
        if ($dataset['label'] == 'Preta' || $dataset['label'] == 'Parda') {
            $dataset['stack'] = 'Stack Negra';
        } else {
            $dataset['stack'] = 'Stack ' . $dataset['label'];
        }

        return $dataset;
    }, $datasets);
}