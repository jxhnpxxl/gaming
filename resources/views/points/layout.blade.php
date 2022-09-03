<!DOCTYPE html>
<html>
    <head>
        <title>Company 101</title>
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

            /* When click New employee button */
            $('#new-employee').click(function() {
                $('#btn-save').val("create-employee");
                $('#employee').trigger("reset");
                $('#employeeCrudModal').html("Add New Employee");
                $('#crud-modal').modal('show');
            });

            /* Edit employee */
            $('body').on('click', '#edit-employee', function() {
                var employee_id = $(this).data('id');
                $.get('employees/' + employee_id + '/edit', function(data) {
                    $('#employeeCrudModal').html("Edit Employee");
                    $('#btn-update').val("Update");
                    $('#btn-save').prop('disabled', false);
                    $('#crud-modal').modal('show');
                    $('#cust_id').val(data.id);
                    $('#first_name').val(data.first_name);
                    $('#last_name').val(data.last_name);
                    $('#email').val(data.email);
                    $('#phone_number').val(data.phone_number);
                    $('#post').val(data.post);
                })
            });

            /* Show employee */
            $('body').on('click', '#show-employee', function () {
                $('#employeeCrudModal-show').html("Employee Details");
                $('#crud-modal-show').modal('show');
            });
            

            /* Delete employee */
            $('body').on('click', '#delete-employee', function() {
                var employee_id = $(this).data("id");
                var token = $("meta[name='csrf-token']").attr("content");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "http://127.0.0.1:8000/employees/" + employee_id,
                    data: {
                        "id": employee_id,
                        "_token": token,
                    },
                    success: function(data) {
                        $('#msg').html('Employee entry deleted successfully');
                        $("#employee_id_" + employee_id).remove();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });
        });
        
    </script>
</html>