window.sendMessage = function sendMessage(url) {
    const body = {
        text: document.getElementById('message-text').value,
        _token: document.querySelector('input[name="_token"]').value
    };

    const axiosConfig = {
        method: 'post',
        url,
        data: body
    };

    axios(axiosConfig)
        .then(function (response) {
            document.getElementById('message-text').value = ''
        })
        .catch(function (error) {
            alert('Ocorreu um erro a tentar enviar a menssagem, por gentileza contacte o suporte.');
        });
}

window.getMessages = function getMessages(url, currentUserId, currentChatId){
    axios(url)
        .then(function (response) {
            response?.data?.forEach(message => {

                addMessageIntoContainer(message, currentUserId)
            })
        })
        .catch(error => {
            console.log('Não foi possível buscar as menssagens')
        })

    Echo.private(`message_to_chat.${currentChatId}`).listen('.SendMessage', message => {
        message = message.message
        addMessageIntoContainer(message, currentUserId)
    })
}

function addMessageIntoContainer(message, currentUserId)
{
    //Cria o elemento baseado em quem enviou
    const messageElement =
        message.user_id == currentUserId ?
            getElementNodeSelfMessageByMessage(message) :
            getElementNodeOtherMessageByMessage(message)
    ;

    document.getElementById('messages-container').appendChild(messageElement)
}

function getElementNodeSelfMessageByMessage(message) {
    // Crie um novo elemento div
    const novoDiv = document.createElement('div');
    novoDiv.className = 'd-flex justify-content-end mx-4'; // Defina as classes

    // Crie um novo elemento de parágrafo (p)
    const novoParagrafo = document.createElement('p');
    novoParagrafo.className = 'rounded border border-gray-200 p-2 text-white'; // Defina as classes
    novoParagrafo.style.background = 'rgba(70, 27, 122, 0.53)';

    // Adicione o texto à mensagem deles
    novoParagrafo.textContent = message['text'];

    // Anexe o parágrafo ao div
    novoDiv.appendChild(novoParagrafo);

    return novoDiv;
}

function getElementNodeOtherMessageByMessage(message) {
    // Crie um novo elemento div
    const novoDiv = document.createElement('div');
    novoDiv.className = 'd-flex mx-4'; // Defina as classes

    // Crie um novo elemento de parágrafo (p)
    const novoParagrafo = document.createElement('p');
    novoParagrafo.className = 'bg-white rounded border border-gray-200 p-2'; // Defina as classes

    // Adicione o texto à mensagem deles
    novoParagrafo.textContent = message.text;

    // Anexe o parágrafo ao div
    novoDiv.appendChild(novoParagrafo);

    return novoDiv;
}
