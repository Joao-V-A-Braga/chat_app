window.replyInvitation = function replyInvitation(url, e) {

    const axiosConfig = {
        method: 'post',
        url
    };

    axios(axiosConfig)
        .then(response => {
            e.parentNode.remove()
            const count = $("#invitationsList").children().length
            if (count > 0)
                $("#qttInvitations").text(`${count}`)
            else
                $("#qttInvitations").addClass('hidden')
        })
}

window.listenSendInvitations = ($user_id) => {
    Echo.private(`send_invitation_to.${$user_id}`).listen('.SendInvitation', invitation => {
        addInvitation(invitation)
    })
}

function addInvitation(invitationObj) {
    let sender = invitationObj.sender
    let invitation = invitationObj.invitation;

    // Crie um novo elemento div com a classe desejada
    var newElement = $('<div>').addClass('d-flex dropdown-item-text align-items-center');

    // Crie a imagem com os atributos src e alt definidos
    var imgElement = $('<img>')
        .addClass('h-8 w-8 rounded-full object-cover')
        .attr('src', sender.profile_photo_path ? ("/image-profile/" + sender.id) : sender.profile_photo_url)
        .attr('alt', sender.name); // Defina o atributo alt como sender.name

    // Crie o parágrafo com o texto desejado
    var pElement = $('<p>')
        .addClass('ml-2 lh-sm')
        .css('font-size', '0.8em')
        .html('<strong>' + sender.name + '</strong> te convidou para conversar.');

    // Crie os links "Aceitar" e "Rejeitar" com os atributos onclick
    var acceptLink = $('<a>')
        .attr('title', 'Aceitar')
        .addClass('ml-2 h6 btn btn-outline-success')
        .click(function() {
            replyInvitation('http://localhost:8080/chat-invitation/accept/' + invitation.id, this);
        })
        .append($('<i>').addClass('fa-solid fa-check'));

    var refuseLink = $('<a>')
        .attr('title', 'Rejeitar')
        .addClass('mx-2 h6 btn btn-outline-danger')
        .click(function() {
            replyInvitation('http://localhost:8080/chat-invitation/refuse/' + invitation.id, this);
        })
        .append($('<i>').addClass('fa-solid fa-x'));

    // Adicione os elementos criados ao novo elemento div
    newElement.append(imgElement, pElement, acceptLink, refuseLink);

    // Encontre o elemento pai com o ID "invitationsList" e adicione o novo elemento a ele
    $('#invitationsList').append(newElement);

    $('#qttInvitations').html($('#invitationsList').children().length)
    $('#qttInvitations').removeClass("hidden");
}
