<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BuilderSelectRawFromModel
{

    private Model $model;
    private array $mapFillableEnum;
    private string $selectRaw;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->mapFillableEnum = [];
        $this->selectRaw = "";
    }

    public function loadEnums(string $fillable, array $enum)
    {
        $this->mapFillableEnum[$fillable] = $enum;
        return $this;
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

    public function getSelect(): string
    {
        if ($this->selectRaw != "") {
            return $this->selectRaw;
        }

        $selectsRaw = [];

        foreach ($this->mountAttributesMap() as $fillable => $type) {
            if ($fillable == 'id') {
                continue;
            }

            switch ($type) {
                case 'boolean':
                    $selectsRaw[] = $this->booleanFillable($fillable);
                    break;
                case 'generic':
                case 'int':
                    $selectsRaw[] = $this->genericFillable($fillable);
                    break;
                case 'array':
                    $selectsRaw[] = $this->arrayFillable($fillable);
                    break;
            }
        }

        return implode(', ', $selectsRaw);
    }

    public function getTable(): string
    {
        return $this->model->getTable();
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

    private function arrayFillable(string $fillable): string
    {
        if (!key_exists($fillable, $this->mapFillableEnum)) {
            return $this->model->getTable() . "." . $fillable;
        }

        $cases = [];
        $column = $this->model->getTable() . "." . $fillable;

        foreach ($this->mapFillableEnum[$fillable] as $key => $value) {
            $as_column = (string)Str::of($value)->slug()->replace('-', '_');
            $cases[] = "IF ($column like '%\"$key\"%', 'Sim', 'Não') as $as_column";
        }

        return implode(', ', $cases);
    }
}
