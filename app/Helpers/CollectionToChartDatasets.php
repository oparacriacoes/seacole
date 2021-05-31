<?php

namespace App\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CollectionToChartDatasets
{
    private string $fieldLabels;
    private string $fieldDatabasestLabels;
    private string $fieldValues;
    private Collection $collection;
    private array $pairValues = [];
    private array $datasets = [];

    public function __construct(string $fieldLabels, string $fieldDatabasestLabels, string $fieldValues, Collection $collection)
    {
        $this->fieldValues = $fieldValues;
        $this->fieldLabels = $fieldLabels;
        $this->fieldDatabasestLabels = $fieldDatabasestLabels;
        $this->collection = $collection;
        $this->pairValues = array_fill_keys($this->collection->groupBy($this->fieldLabels)->keys()->toArray(), 0);
    }

    public function getLabels(): array
    {
        return array_map(array($this, 'titleLabel'), array_keys($this->pairValues));
    }

    public function getDatasets(): array
    {
        $this->collection->groupBy($this->fieldDatabasestLabels)->each(function ($item, $key) {
            $pair_values = $item->pluck($this->fieldValues, $this->fieldLabels)->toArray();
            $merged_labels = array_merge($this->pairValues, $pair_values);

            $this->datasets[] = $this->dataset($key, array_values($merged_labels));
        });

        return $this->datasets;
    }

    private function dataset($label, $data): array
    {
        return [
            'label' => $this->titleLabel($label),
            'data' => $data
        ];
    }

    private function titleLabel(string $label): string
    {
        return  $label == '' ? 'Sem Informação' : Str::title($label);
    }
}
