<?php

namespace App\View\Components;

use App\Models\ChatInvitation;
use App\Models\User;
use Illuminate\View\Component;
use Illuminate\View\View;

class NavigationMenu extends Component
{

    public function render()
    {
        /** @var User $user */
        $userId = auth()->user()->id;
        $chatInvitations = ChatInvitation::where('destiny', $userId)->where('active', true);

        return view('navigation-menu', ['invitations' => $chatInvitations->get()]);
    }
}
