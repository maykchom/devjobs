<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vacante;
use Illuminate\Auth\Access\Response;

class VacantePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Validamos roles (autorizacion) para que puedan ver la pantalla dashboard solo los reclutadores
        return $user->rol === 2;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Vacante $vacante): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Validamos roles (autorizacion) para que solo los reclutadores puedan acceder a la pantalla de crear vacantes
        return $user->rol === 2;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vacante $vacante): bool
    {
        // Verificamos si el usuario actual es el dueño de la vacanque que se quiere actualizar
        return $user->id === $vacante->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Vacante $vacante): bool
    {
        //Evitar que un usuario que no haya creado la vacante borre la de otro
        return $user->id === $vacante->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Vacante $vacante): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Vacante $vacante): bool
    {
        //
    }

    public function yaPostulado(User $user, Vacante $vacante):bool
    {
        return $vacante->candidatos()->where('user_id', $user->id)->count() > 0;
    }
}
