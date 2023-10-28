window.replyInvitation = function acceptInvitation(url) {
    const axiosConfig = {
        method: 'post',
        url
    };

    axios(axiosConfig)
        .then(function (response) {
            alert(response.data);
        })
        .catch(function (error) {
            alert('Ocorreu um erro a tentar responder o convite, por gentileza contacte o suporte.');
        });
}
