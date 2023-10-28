<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ImageController extends AbstractController
{
    public function showImageProfile(User $user)
    {
        $path = app_path('../uploads/images/'.$user->profile_photo_path);

        if (!is_dir($path) and file_exists($path)) {
            return response()->file($path);
        }

        abort(404);
    }
}
