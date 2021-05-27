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

function join_colors_to_black($collection): array
{
    return $collection->pluck('cor_raca')
        ->filter(function ($cor_raca) {
            return $cor_raca != 'Parda';
        })
        ->map(function ($cor_raca) {
            return $cor_raca == 'Preta' ? 'Negra' : $cor_raca;
        })->values()->toArray();
}

function stack_black_colors(array $datasets, bool $useAxis = true): array
{
    return array_map(function ($dataset) use ($useAxis) {
        if ($useAxis) {
            $dataset['xAxisID'] = 'sublabels';
        }

        if ($dataset['label'] == 'Preta' || $dataset['label'] == 'Parda') {
            $dataset['stack'] = 'Stack Negra';
        } else {
            $dataset['stack'] = 'Stack ' . $dataset['label'];
        }

        return $dataset;
    }, $datasets);
}

function in_array_all($needles, $haystack)
{
    return empty(array_diff($needles, $haystack));
}
