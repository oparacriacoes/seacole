<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ImportDumpSQL extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:sql {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa para o banco de dados um dump de um arquivo sql';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (App::environment('production')) {
            $this->error('Desculpe mas esse comando não pode ser execultado em produção');
            return 0;
        }

        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error('Arquivo não encontrado');
            return 0;
        }

        $sql = file_get_contents($filePath);

        try {
            DB::unprepared($sql);
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }
}
