<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateQuery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:query {table} {column} {old} {new}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        DB::listen(function($query) {
            $p1 = json_encode($query->bindings[0]);
            $p3 = json_encode($query->bindings[2]);
            
            $column = $this->argument('column');
            $table = $this->argument('table');
    
            $updateQuery = "UPDATE $table SET
$column = REPLACE( $column, {$p1}, '{$query->bindings[1]}')
WHERE $column like '%{$p3}%';";

            $updateQuery = str_replace("\n", ' ', $updateQuery);

            $file = storage_path() . "/app/scripts/updates.sql";
            $fp = fopen($file, 'a');
            fwrite($fp, $updateQuery.PHP_EOL);
            fwrite($fp, '-- ---------------------------------------------------'.PHP_EOL);
            // fwrite($fp, '-- ###################################################');

            $this->info($updateQuery);
        });

        $current_value = $this->argument('old');
        $replace_value = $this->argument('new');

        $encoded_replace = str_replace('"', '', json_encode($current_value));
        $encoded_search = addslashes(str_replace('"', '', json_encode($current_value)));

        $query = "update insumos_oferecidos set
        precisa_tipo_ajuda = replace(precisa_tipo_ajuda, ?, ?)
        where precisa_tipo_ajuda like ? and id = 0;";

        DB::select($query, [$encoded_replace, $replace_value, $encoded_search]);

        return 0;
    }
}
