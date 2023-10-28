<div class="bg-white border-l border-gray-200 d-flex flex-column p-0" style="width: 300px;">
    <div class="d-flex align-items-center justify-content-between w-100 border-b px-3" style="height: 85px;">
        Chats
        <a href="#" class="openInvitationModal">
            <i class="fa-solid fa-user-plus" style="color: rgb(104 117 245)"></i>
        </a>
        <x-app.modalInvitation></x-app.modalInvitation>
    </div>
    <div class="h-100">
        @if($chats->first())
            @foreach($chats as $chat)
                <a class="d-flex align-items-center p-3 border-y" href="#">
                    {{-- Foto do chat/contato atual --}}
                    <img class="h-8 w-8 rounded-full object-cover" src="
                    @if ($chat->user()->first()->profile_photo_path)
                        {{ route('image.show_profile', ['user' => $chat->user()->first()]) }}
                    @else
                        {{ $chat->user()->first()->profile_photo_url }}
                    @endif
                    " alt="{{ $chat->user()->first()->name }}"
                    >

                    <div class="ml-3 overflow-hide">
                        <h3 title="Contato Nome Grande fasdasfd" class="overflow-hidden" style="height: 20px;">
                            {{ $chat->user()->first()->name }}
                        </h3>
                        <p
                            class="text-secondary text-break overflow-hidden" style="font-size: 0.8rem; height: 20px;"
                            title="Última menssagem exemplo dfasfdsafsda"
                        >
                            Última menssagem exemplo dfasfdsafsda
                        </p>
                    </div>
                </a>
            @endforeach
        @else

        @endif
    </div>
</div>
