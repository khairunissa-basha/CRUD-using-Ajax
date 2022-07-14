<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <title>Crud</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <h1 style="text-align:center">Codeigniter CRUD usin Ajax</h1>
                <hr style="background-color:black;color:black;height:4px">
            </div>

        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                    data-target="#crudModal">
                    ADD
                </button>

                <!-- Modal -->
                <div class="modal fade" id="crudModal" tabindex="-1" aria-labelledby="crudModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12 mt-3">
                                    <form action="" id="add_user" method="post">
                                        <div class="form-group">
                                            <label for="">Name:</label>
                                            <input type="text" name="name" id="name" class="form-control">

                                        </div>
                                        <div class="form-group">
                                            <label for="">E-mail Address</label>
                                            <input type="text" name="email" id="email" class="form-control">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="add">ADD</button>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mt-2">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>E-mail</th>
                                    <th>Action</th>
                                </tr>

                            </thead>
                            <tbody id="tbody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!-- first jquery ,then popper,then bootstrap.js-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
        integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
    $(document).ready(function() {
        $('.modal').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset();
        });
        fetch();
    });
    $(document).on('click', '#add', function(e) {
        e.preventDefault();

        var name = $('#name').val();
        var email = $('#email').val();

        $.ajax({
            url: "<?php echo base_url() ?>practice/insert",
            type: "post",
            dataType: "json",
            data: {
                name: name,
                email: email
            },
            success: function(data) {
                if (data.response == "success") {
                    toastr["success"](data.message)

                } else {
                    console.log(data.message);
                    for (var msg in data.message) {
                        toastr['error'](data.message[msg]);
                        //console.log(msg);
                    }
                }


            }
        })

    })

    function fetch() {
        $.ajax({
            url: "<?php echo base_url() ?>practice/fetch",
            type: "get",
            dataType: "json",
            success: function(data) {
                //console.log(data);

                var tbody = " ";
                for (var key in data) {
                    tbody += "<tr>";
                    tbody += "<td>" + data[key]['id'] + "</td>";
                    tbody += "<td>" + data[key]['name'] + "</td>";
                    tbody += "<td>" + data[key]['email'] + "</td>";
                    tbody += `<td>
								<a href = "#" id = "del" value = "${data[key]['id']}" > Delete </a>   
								<a href = "#" id = "edit" value = "${data[key]['id']}" > Edit </a> 
								</td>`;
                    tbody += "</tr>";
                }
                $("#tbody").html(tbody);
            }

















        })
    }
    </script>
</body>

</html>