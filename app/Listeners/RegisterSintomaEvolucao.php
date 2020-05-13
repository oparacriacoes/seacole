<?php

namespace App\Listeners;

use App\Events\SintomaEvolucao;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Log;

class RegisterSintomaEvolucao
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SintomaEvolucao  $event
     * @return void
     */
    public function handle(SintomaEvolucao $event)
    {
      $sintoma = $event->sintomas;
      $sintoma->save();
    }
}
