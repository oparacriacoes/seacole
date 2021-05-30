<?php

namespace App\Exports\FactoryQuery;

class BuilderQuery
{
    private $modules = [];
    private $columns = '
        p.id,
        p.name as nome
    ';
    private $middle = 'from pacientes p';
    private $footer = 'order by p.name;';

    public function loadModules(array $modules)
    {
        foreach ($modules as $module) {
            // VERIFICA SE A CLASSE QUE FOI PASSADA POSSUI UMA IMPLEMENTACAO DE ModuleQuery
            $this->modules[] = $module;
        }
    }

    private function addModule(ModuleQuery $module): void
    {

    }

    public function build(): string
    {
        return "select {$this->columns} {$this->middle} {$this->footer}";
    }
}
