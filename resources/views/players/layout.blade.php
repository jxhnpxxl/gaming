<!DOCTYPE html>
<html>
    <head>
        <title>Games</title>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type='text/css'>
        <link src="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    </head>
    <style>
        .float-container {
            border: 3px solid #fff;
        }

        .float-child {
            width: 50%;
            float: left;
            padding: 5px;
        }  
    </style>
    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
    <script>
        $(document).ready(function() {

            /* When click New Player button */
            $('#new-player').click(function(data) {
                $('#btn-save').val("create-player");
                $('#player').trigger("reset");
                $('#playerCrudModal').html("Add New Player");
                $('#crud-modal').modal('show');
            });

            /* Edit player */
            $('body').on('click', '#edit-player', function() {
                var player_id = $(this).data('id');
                $.get('players/' + player_id + '/edit', function(data) {
                    $('#playerCrudModal').html("Edit player");
                    $('#btn-update').val("Update");
                    $('#btn-save').prop('disabled', false);
                    $('#crud-modal').modal('show');
                    $('#player_id').val(data.player_id);
                    $('#first_name').val(data.first_name);
                    $('#last_name').val(data.last_name);
                    $('#email').val(data.email);
                    $('#role').val(data.role);
                    $('#user_name').val(data.user_name);
                    $('#team_code').val(data.team_code);
                    
                })
            });

            /* Show player */
            $('body').on('click', '#show-player', function () {
                $('#playerCrudModal-show').html("Player Details");
                $('#crud-modal-show').modal('show');
            });
            

            /* Delete player */
            $('body').on('click', '#delete-player', function() {
                var player_id = $(this).data("id");
                var token = $("meta[name='csrf-token']").attr("content");
                confirm("Are You sure want to delete this Player?");

                $.ajax({
                    type: "DELETE",
                    url: "http://127.0.0.1:8000/players/" + player_id,
                    data: {
                        "id": player_id,
                        "_token": token,
                    },
                    success: function(data) {
                        $('#msg').html('Player entry deleted successfully');
                        $("#player_id_" + player_id).remove();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });
        });
        
    </script>
</html>