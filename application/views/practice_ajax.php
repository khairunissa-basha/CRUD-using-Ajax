
   
    <div class="container">
   
        <input type="hidden" id= "hidden_sort_by" name="hi" value="<?php echo $sort_by ?>">
        
        <div class="box-body">
            <table class="table">
                <thead>
                    <tr>
                   
                    <th>User Name <button type="button" id="sort_username_asc" class="sort <?php if(isset($sort_by) && !empty($sort_by) && $sort_by == 'sort_username_asc'){ echo 'active'; }?>" data-sortby="username" data-sortorder="asc" data-sort="sort_username_asc"><i class="bi bi-arrow-up"></i></button><button type="button" id="sort_username_desc" class="sort <?php if(isset($sort_by) && !empty($sort_by) && $sort_by == 'sort_username_desc'){ echo 'active'; }?>" data-sort="sort_username_desc"><i class="bi bi-arrow-down"></i></button></th>
                    <th>User Email <button type="button" id="sort_useremail_asc" class="sort <?php if(isset($sort_by) && !empty($sort_by) && $sort_by == 'sort_email_asc'){ echo 'active'; }?>"" data-sort= "sort_email_asc"><i class="bi bi-arrow-up"></i></button><button type="button" id="sort_useremail_desc" class="sort <?php if(isset($sort_by) && !empty($sort_by) && $sort_by == 'sort_email_desc'){ echo 'active'; }?>" data-sort = "sort_email_desc"><i class="bi bi-arrow-down"></i></button></th>
                    <th>Action</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <?php foreach($users as $user) { ?>
                        <tr>
                       
                    <td><?php echo $user->name ?></td>
                    <td><?php echo $user->email ?></td>
                    <td>
                                     <a href="#" id="del" value="<?php echo $user->id ?>">Delete</a>
                                     <a href="#" id="edit" value="<?php echo $user->id ?>">Edit</a>
                                </td>
                        </tr>
                   <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <ul class="pagination">
                <?php echo $pagelinks ?>
            </ul>
        </div>
    </div>