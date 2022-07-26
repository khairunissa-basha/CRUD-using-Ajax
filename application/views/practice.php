<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet"  href="assets/css/styles.css"> 
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'> 
    

    <title>Crud</title>
    <style>
        .active{
            color:blue;
        }
        #sort_username_asc{
            background: none!important;
            border:none;
            padding:0.05rem;
        }
        #sort_username_desc{
            background: none!important;
            border:none;
             padding:0.05rem;
        }
        #sort_useremail_asc{
            background: none!important;
            border:none;
            padding:0.05rem;
        }
        #sort_useremail_desc{
            background: none!important;
            border:none;
             padding:0.05rem;
        }
        </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <h1 style="text-align:center">Codeigniter CRUD using Ajax</h1>
                <hr style="background-color:black;color:black;height:4px">
            </div>

        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#crudModal">
                    ADD
                </button>

                <!-- Insert Modal -->
                <div class="modal fade" id="crudModal" tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
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

                 <!-- Edit Modal -->
                 <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12 mt-3">
                                    <form action="" id="update_form" method="post">
                                        <input type="hidden" id="edit_modal_id">
                                        <div class="form-group">
                                            <label for="">Name:</label>
                                            <input type="text"  name="edit_name" id="edit_name" class="form-control">

                                        </div>
                                        <div class="form-group">
                                            <label for="">E-mail Address</label>
                                            <input type="hidden" name="original_email" id="original_email">
                                            <input type="text" name="edit_email" id="edit_email" class="form-control">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="update">UPDATE</button>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>

            <div class="row">
                <div class="col-md-8">
                    <input type="text" name="search_key" id="search_key" class="form-control" placeholder="Please enter what you want to search">
                </div>
                <div class="col-md-4">
                    <button type="button" name="search" id="search_btn" class="btn btn-warning">Search</button>
                    <button type="button" name="reset" id="reset_btn" class="btn btn-info">Reset</button>
                </div>
            </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div id="ajax-content">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!-- first jquery ,then popper,then bootstrap.js-->
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        
        $(document).ready(function() {
            // first time load
            fetch(page_url=false);

           
            $('.modal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });


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
                        toastr["success"](data.message);
                        $("#crudModal").modal('hide');
                        fetch();
                      
} else {
                        console.log(data.message);
                        for (var msg in data.message) {
                            toastr['error'](data.message[msg]);
                          

                        }
                    }


                }
            });

        });


        //on search
         $(document).on('click','#search_btn',function(e){
            fetch(page_url = false);
            event.preventDefault();
         })

         //on clicking reset
         $(document).on('click','#reset_btn',function(e){
            $('#search_key').val('');
            fetch(page_url=false);
            e.preventDefault();
         })

         //on clicking page links
         $(document).on('click','.pagination li a',function(){
            var page_url = $(this).attr('href');
            var sort_by= $('#hidden_sort_by').val();
          
            
            fetch(page_url,sort_by);
            return false;
        })

        //Adding class active to the clicked sort  button
        $(document).on('click','.sort',function(){
            
            var sort_by = $(this).attr('data-sort');
          
            var hidden_sort_by = $('#hidden_sort_by').val();
           
           if(sort_by == 'sort_username_asc'){
                 $('#sort_username_asc').addClass('active');
           }else{
            $('#sort_username_asc').removeClass('active');
           }
           if(sort_by == 'sort_username_desc'){
                 $('#sort_username_desc').addClass('active');
           }else{
            $('#sort_username_desc').removeClass('active');
           }
           if(sort_by == 'sort_email_asc'){
                 $('#sort_useremail_asc').addClass('active');
           }else{
            $('#sort_useremail_asc').removeClass('active');
           }
           if(sort_by == 'sort_email_desc'){
                 $('#sort_useremail_desc').addClass('active');
           }else{
            $('#sort_useremail_desc').removeClass('active');
           }
            
        
           fetch(false,sort_by);
        
       
    })

        //listing function with filter,pagination and sorting
        function fetch(page_url=false,sort_by=null) {
           
            var search_key = $('#search_key').val();

            var base_url = "<?php echo site_url('practice/fetch')?>";
            if(page_url == false){
             page_url = base_url;
            }

            var data ={search_key : search_key};
            if(sort_by!=null){
                data['sort_by']=sort_by;
            }

            console.log('data....',data);
           
            $.ajax({
                url: page_url,
                type: "post",
                data : data,
                    success: function(response) {
                    
                    console.log(response);
                    $("#ajax-content").html(response);
                }
            });
        }


        //function fro edit event
        $(document).on("click", "#edit", function(e) {
            e.preventDefault();
            var edit_id = $(this).attr("value");
            if (edit_id == '') {
                alert('id is required');
            } else {
                $.ajax({
                    url: '<?php echo base_url(); ?>practice/edit/'+edit_id,
                    type: "get",
                    dataType: "json",
                    success: function(data) {
                         if (data.response === "success") {
                           $('#editModal').modal('show');
                           $("#edit_modal_id").val(data.post.id);
                           $("#edit_name").val(data.post.name);
                           $("#edit_email").val(data.post.email);
                           $("#original_email").val(data.post.email);
                          
                         } 
                        else {
                            toastr["error"](data.message);
                            console.log(edit_id);
                        }
                    }
                });
            }
        });

        //function for update event

        $(document).on("click", "#update", function(e){
            e.preventDefault();
           
            var edit_id = $("#edit_modal_id").val();
            var edit_name = $("#edit_name").val();
            var edit_email = $("#edit_email").val();
            var original_email = $("#original_email").val();

                $.ajax({
                url:"<?php echo base_url();?>practice/update",
                type:"post",
                dataType:"json",
                data:{
                    edit_id : edit_id,
                    edit_name : edit_name,
                    edit_email : edit_email,
                    original_email : original_email
                },
                success : function(data){
                    
                    if(data.response == "success"){
                        toastr["success"](data.message);
                        $("#editModal").modal('hide');
                        fetch();
                   }else{
                    console.log(data.message);
                    for(var msg in data.message){
                        toastr['error'](data.message[msg]);
                    }
                    
                   }
                    
                }
            });
            //}
            
        });

        // Function for delete event
        $(document).on("click",'#del', function(e){
            e.preventDefault();

            var del_id = $(this).attr("value");

            if(del_id == ''){
                alert('Id is required');
            }else{
                const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success ml-2',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Do you really want to delete this',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {

    if (result.value) {
    $.ajax({
                    url:"<?php echo base_url();?>practice/delete",
                    type:"post",
                    dataType:"json",
                    data: {
                        del_id : del_id
                    },
                    success : function(data){
                        if(data.response == "success"){
                        swalWithBootstrapButtons.fire(
      'Deleted!',
      'User has been deleted.',
      'success'
                        )
                         fetch();
                         } 
                
                    }
                });
                
  }
  else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your user data is safe :)',
      'error'
    )
  }
  
});
                
            }
        });
        
    </script>
</body>

</html>