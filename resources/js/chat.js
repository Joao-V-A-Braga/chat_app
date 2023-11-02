window.listenAcceptInvitations = ($user_id) => {
    Echo.private(`accept_chat.${$user_id}`).listen('.AcceptInvitation', userChat => {
        addChat(userChat.userChat, userChat.user, userChat.message)
    })
}

function addChat(userChat, user, message) {
    const chat = $(`
        <a
            class="d-flex align-items-center p-3 border-y" href="/chats?selected=${userChat.chat_id}"
            style=""
        >
            <img class="h-8 w-8 rounded-full object-cover" src="
                ${user.profile_photo_path ? ("/image-profile/" + user.id) : user.profile_photo_url}
            " alt="${user.name}"
            >

            <div class="ml-3 overflow-hide">
                <h3 title="Contato Nome Grande fasdasfd" class="overflow-hidden" style="height: 20px;">
                    ${user.name}
                </h3>
                <p
                    class="text-secondary text-break overflow-hidden" style="font-size: 0.8rem; height: 20px;"
                    title="Última menssagem exemplo dfasfdsafsda"
                >
                    ${message}
                </p>
            </div>
        </a>
    `)

    $('#chatList').prepend(chat);
}
