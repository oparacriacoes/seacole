<?php

namespace App\Exports\FactoryQuery;

interface ModuleQuery
{

    public function columns(): string;
    public function relation(): string;
}
