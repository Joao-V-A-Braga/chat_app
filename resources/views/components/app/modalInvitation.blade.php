<div class="modal" id="sendInvitationModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Selecione um usuário</h5>
                <button type="button" class="closeInvitationModal" data-bs-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <select class="form-control" id="selectOptions" style="width: 100%">
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary closeInvitationModal" data-bs-dismiss="modal" aria-label="Close">Fechar</button>
                <button type="button" class="btn btn-outline-primary" id="selectOptionButton">Convidar para um chat</button>
            </div>
        </div>
    </div>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    function formatOption(option) {
        console.log(option)
        if (!option.id) {
            return option.text; // Mostrar a opção padrão (texto de placeholder)
        }

        var $option = $(
            `<div class="d-flex align-items-center">
                <img class="h-8 w-8 rounded-full object-cover"
                     src=${option.profile_photo_path ? "/image-profile/" + option.id : option.profile_photo_url}>
                <span class="ml-3"> ${option.name} </span>
            </div>`
        );

        return $option;
    }

    $(document).ready(function() {
        $('#selectOptions').select2({
            placeholder: "Busque por um usuário",
            dropdownParent: $('#sendInvitationModal'),
            ajax: {
                url: '/users-select2',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        term: params.term || '',
                        page: params.page || 1
                    }
                },
                cache: true
            },
            templateResult: formatOption
        })

        $(".openInvitationModal").click(function() {
            $("#sendInvitationModal").modal('show');
        });

        $("#selectOptionButton").click(function() {
            var selectedOption = $("#selectOptions").val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: "POST",
                url: "/chat-invitation/new/"+selectedOption,
                data: {
                    _token: csrfToken,
                },
                success: function(msg) {
                    alert(msg);
                }
            });
            $("#sendInvitationModal").modal('hide');
        });
    });
</script>
