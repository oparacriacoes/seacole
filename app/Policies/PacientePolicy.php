<?php

namespace App\Policies;

use App\Enums\RolesEnum;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PacientePolicy
{
    use HandlesAuthorization;


    public function getRelationalId(User $user, Paciente $paciente)
    {
        if ($user->role == RolesEnum::AGENTE) {
            return $paciente->agente_id;
        } else if ($user->role == RolesEnum::MEDICO) {
            return $paciente->medico_id;
        } else if ($user->role == RolesEnum::PSICOLOGO) {
            return $paciente->psicologo_id;
        }

        return null;
    }
    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if ($user->is_admin) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->is_user_saude;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Paciente  $paciente
     * @return mixed
     */
    public function view(User $user, Paciente $paciente)
    {
        return $user->professional->id === $this->getRelationalId($user, $paciente);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->is_user_saude;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Paciente  $paciente
     * @return mixed
     */
    public function update(User $user, Paciente $paciente)
    {
        return $user->professional->id === $this->getRelationalId($user, $paciente);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Paciente  $paciente
     * @return mixed
     */
    public function delete(User $user, Paciente $paciente)
    {
        return $user->professional->id === $this->getRelationalId($user, $paciente);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Paciente  $paciente
     * @return mixed
     */
    public function restore(User $user, Paciente $paciente)
    {

    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Paciente  $paciente
     * @return mixed
     */
    public function forceDelete(User $user, Paciente $paciente)
    {

    }
}
