<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Paciente;
use App\Traits\NeedsNotify;

class NotifyController extends Controller
{
  use NeedsNotify;

  public function notify()
  {
    $pacientes = Paciente::all();
    foreach($pacientes as $paciente){
      $this->avaliaCondicoes($paciente);
    }

    return null;
  }

  public function dismiss($notification_id, $paciente_id)
  {
    $notification = \DB::table('notifications')->where('id', $notification_id)->update(['read_at' => Carbon::now()]);

    return redirect('/admin/paciente/edit/'.$paciente_id);
  }
}
