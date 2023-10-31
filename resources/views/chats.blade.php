<x-app-layout>

    <div class="py-12 h-100">
        <div class="h-100 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="d-flex h-100 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-app.chatsList :chats="$chats" :$selected/>
                <x-app.currentChat :chat="$selected"/>
            </div>
        </div>
    </div>
</x-app-layout>
