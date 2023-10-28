<div class="bg-white border-l border-gray-200 w-100 container-full-main d-flex flex-column p-0">
    @if($chat)
        <div class="d-flex align-items-center justify-content-between w-100 border-b px-3" style="height: 85px;">
            <div class="d-flex align-items-center">
                {{-- Foto do chat/contato atual --}}
                <img class="h-8 w-8 rounded-full object-cover" src="
                @if ($chat->user()->first()->profile_photo_path)
                    {{ route('image.show_profile', ['user' => $chat->user()->first()]) }}
                @else
                    {{ $chat->user()->first()->profile_photo_url }}
                @endif
                " alt="{{ $chat->user()->first()->name }}"
                >

                <div class="ml-3">
                    <h3>{{$chat->user()->first()->name}}</h3>
                    <p class="text-secondary" style="font-size: 0.8rem">Visto por último há um dia</p>
                </div>
            </div>
            <a href="#">
                Galeria
            </a>
        </div>
        <div class="d-flex flex-column h-100 rounded-1" style="background: rgba(185,185,185,0.3)">
            <div class="h-100 pt-3">
                <div class="d-flex mx-4">
                    <p class="bg-white rounded border border-gray-200 p-2">
                        Mensagem deles
                    </p>
                </div>

                <div class="d-flex justify-content-end mx-4">
                    <p class="rounded border border-gray-200 p-2 text-white" style="background: rgba(70,27,122,0.53)">
                        Mensagem minha
                    </p>
                </div>
            </div>

            <input class="rounded border-gray-200 mx-5 mb-3" style="height: 60px" placeholder="Escreva uma mensagem">
        </div>
    @else
        <div class="d-flex flex-column justify-content-center align-items-center h-100 text-center  text-muted">
            Você não ainda não possui nenhum chat :( <br>
            Envie convites para interagir com outras pessoas!!
            <button class="btn text-white openInvitationModal mt-3" style="background: rgb(104 117 245)">
                Convidar <i class="fa-solid fa-user-plus"></i>
            </button>
        </div>
    @endif
</div>
