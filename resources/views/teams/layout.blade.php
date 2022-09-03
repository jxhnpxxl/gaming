<!DOCTYPE html>
<html>
    <head>
        <title>Game</title>
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

            /* When click New Team button */
            $('#new-team').click(function() {
                $('#btn-save').val("create-team");
                $('#team').trigger("reset");
                $('#teamCrudModal').html("Add New Team");
                $('#crud-modal').modal('show');
            });

            /* Edit team */
            $('body').on('click', '#edit-team', function() {
                var team_code = $(this).data("id");
                $.get('teams/' + team_code + '/edit', function(data) {
                console.log(data);
                    $('#teamCrudModal').html("Edit team");
                    $('#btn-update').val("Update");
                    $('#btn-save').prop('disabled', false);
                    $('#crud-modal').modal('show');
                    $('#team_code').val(data.team_code);
                    $('#team_name').val(data.team_name);
                    $('#organization').val(data.organization);
                })
            });

            /* Show team */
            $('body').on('click', '#show-team', function () {
                $('#teamCrudModal-show').html("Team Details");
                $('#crud-modal-show').modal('show');
            });

            /* Delete team */
            $('body').on('click', '#delete-team', function() {
                var team_code = $(this).data("id");
                var token = $("meta[name='csrf-token']").attr("content");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "http://127.0.0.1:8000/teams/" + team_code,
                    data: {
                        "id": team_code,
                        "_token": token,
                    },
                    success: function(data) {
                        $('#msg').html('Team entry deleted successfully');
                        $("#team_code_" + team_code).remove();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });
        });
        
    </script>
</html>