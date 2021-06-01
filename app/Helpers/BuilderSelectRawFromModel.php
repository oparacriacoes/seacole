<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BuilderSelectRawFromModel
{
    private Model $model;
    private array $mapFillableEnum;
    private array $mapSelectRaw;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->mapFillableEnum = [];
        $this->columns = [];
        $this->selectRaw = "";
        $this->mapSelectRaw = [];
    }

    public function mount(): void
    {
        foreach ($this->mountAttributesMap() as $fillable => $type) {
            if ($fillable == 'id' || Str::endsWith($fillable, '_id')) {
                continue;
            }

            switch ($type) {
                case 'boolean':
                    $this->mapSelectRaw[$fillable] = $this->booleanFillable($fillable);
                    break;
                case 'generic':
                case 'int':
                    $this->mapSelectRaw[$fillable] = $this->genericFillable($fillable);
                    break;
                case 'array':
                    $this->arrayFillable($fillable);
                    break;
            }
        }
    }

    public function loadEnums(string $fillable, array $enum)
    {
        $this->mapFillableEnum[$fillable] = $enum;
        return $this;
    }

    public function getHeadings(): array
    {
        return array_keys($this->mapSelectRaw);
    }

    public function getSelectRaws(): array
    {
        return array_values($this->mapSelectRaw);
    }

    public function getSelectRaw(): string
    {
        return implode(', ', array_values($this->mapSelectRaw));
    }

    private function mountAttributesMap(): array
    {
        return array_merge(
            array_combine(
                $this->model->getFillable(),
                array_fill(0, sizeof($this->model->getFillable()), 'generic')
            ),
            $this->model->getCasts()
        );
    }

    private function booleanFillable(string $fillable): string
    {
        $column = $this->model->getTable() . "." . $fillable;
        return "IF ($column=true, 'Sim', 'Não') as $fillable";
    }

    private function genericFillable(string $fillable): string
    {
        return $this->model->getTable() . "." . $fillable;
    }

    private function arrayFillable(string $fillable): void
    {
        if (!key_exists($fillable, $this->mapFillableEnum)) {
            $this->mapSelectRaw[$fillable] = $this->model->getTable() . "." . $fillable;
        }

        $column = $this->model->getTable() . "." . $fillable;

        foreach ($this->mapFillableEnum[$fillable] as $key => $value) {
            $as_column = (string)Str::of($value)->slug()->replace('-', '_');
            $this->mapSelectRaw[$as_column] = "IF ($column like '%\"$key\"%', 'Sim', 'Não') as $as_column";
        }
    }
}
