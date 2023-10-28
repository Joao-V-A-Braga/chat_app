<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ChatInvitationController;
use \App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Welcome
Route::get('/', function () {
    if (Auth::user())
        return http_redirect(\route('chats'));
    return view('welcome');
});

// Chat
Route::get('/chats', [ChatController::class, 'index'])->name('chats');

// Auth redirections
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/chats', [ChatController::class, 'index'])->name('chats');
});

// Images
Route::get('/image-profile/{user}', [ImageController::class, 'showImageProfile'])->name('image.show_profile');

// Invitations
Route::post('/chat-invitation/new/{user}', [ChatInvitationController::class, 'new'])->name('chat_invitation.new');
Route::post('/chat-invitation/accept/{chatInvitation}', [ChatInvitationController::class, 'acceptInvitation'])->name('chat_invitation.accept');
Route::post('/chat-invitation/refuse/{chatInvitation}', [ChatInvitationController::class, 'refuseInvitation'])->name('chat_invitation.refuse');

// Users
Route::get('/users-select2', [UserController::class, 'select2'])->name('user.select2');
