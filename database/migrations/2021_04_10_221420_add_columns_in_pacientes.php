<?php

use App\Paciente;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInPacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->string('name')->nullable()->after('id');
            $table->string('email')->nullable()->after('name');
            $table->softDeletes()->after('updated_at');
        });

        $this->updateTableAfter();
    }

    private function updateTableAfter()
    {
        $pacientes = Paciente::with('user')->get();

        foreach ($pacientes as $paciente) {
            $paciente->update([
                'name' => $paciente->user->name,
                'email' => $paciente->user->email,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->dropColumn(['name', 'email', 'deleted_at']);
        });
    }
}
