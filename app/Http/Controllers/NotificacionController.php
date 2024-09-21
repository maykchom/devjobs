<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //Obtener las notificaicones no leidas del usuario logueado
        $notificaciones =auth()->user()->unreadNotifications;

        //Marcar como leida las notificaciones (limpiar notificaciones)
        auth()->user()->unreadNotifications->markAsRead();

        return view('notificaciones.index',[
            'notificaciones'=>$notificaciones
        ]);
    }
}
