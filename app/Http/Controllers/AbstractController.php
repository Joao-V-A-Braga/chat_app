<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AbstractController extends Controller
{
    public function denyIfTheUserIsNotTheSameAsTheAuthenticated(User $user)
    {
        if ($user->id !== auth()->user()->id)
            return throw new AccessDeniedHttpException("Você não possui permissão para acessar esse recurso.");
    }
}
