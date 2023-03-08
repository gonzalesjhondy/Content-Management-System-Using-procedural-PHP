<?php
if(isset($_POST['CheckBoxArray'])){
 
    foreach($_POST['CheckBoxArray'] as $postValueId){
    
        $bulk_option = $_POST['bulk_options'];
         switch($bulk_option){
           case 'admin':
            $sql = "UPDATE users SET user_role = '{$bulk_option}' WHERE users_id ='{$postValueId}' ";
            $update_admin_query = mysqli_query($connection, $sql);
            confirmQuery($update_admin_query);
           break;

          case 'subscriber':
            $sql = "UPDATE users SET user_role = '{$bulk_option}' WHERE users_id = '{$postValueId}' ";
            $update_subscriber_query = mysqli_query($connection,$sql);
            confirmQuery($update_subscriber_query);
          break;

          case 'delete':
            $sql = "DELETE FROM users WHERE users_id = '{$postValueId}' ";
            $delete_users_query = mysqli_query($connection,$sql);
            confirmQuery($delete_users_query);
            break;
         }//end of swetch statement
    }//end of foreach

} //end of post request




?>



<form action="" method="post">

<table class="table table-bordered table-hover">
   <div id="bulkoptionsContainer" class="col-xs-4">
     <select class="form-control" name= "bulk_options" id="">
            <option value="">Select Option</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
            <option value="delete">Delete</option>

     </select> 
   </div>

    <div class="col-xs-4">
      <input type="submit" name="submit" class="btn btn-success" value="Apply">
      <a href="" class="btn btn-primary">Add New</a>
     </div>


                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAllBoxes" class="checkbox"></th>
                                        <th>Id</th>
                                        <th>Username</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Email</th>
                                        <th>Role</th> 
                                        <th></th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>   
                                </thead>
                                    <tbody>
                                        <!-- <tr> -->

<?php

    $query = "SELECT * FROM users";
    $select_users = mysqli_query($connection,$query);

        while($row = mysqli_fetch_assoc($select_users)){

            $user_id        = $row['users_id'];
            $username       = $row['username'];
            $user_password  = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname  = $row['user_lastname'];
            $user_email     = $row['user_email'];
            $user_image     = $row['user_image'];
            $user_role      = $row['user_role'];
           

          echo "<tr>";
                ?>

              <td><input type="checkbox" class="checkBoxes" name="CheckBoxArray[]" value="<?php echo $user_id ?>"></td>
                <?php
                echo "<td>$user_id </td>";
                echo "<td>$username</td>";

                // $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";

                // $select_category_id = mysqli_query($connection, $query);
                // while($row = mysqli_fetch_assoc($select_category_id)){
                
                //     $cat_id     = $row['cat_id'];
                //     $cat_title  = $row['cat_title'];

                //display the cat_title in the database
                echo "<td>$user_firstname</td>";
                echo "<td>$user_lastname</td>";
                echo "<td>$user_email</td>";
                echo "<td>$user_role </td>";
                echo "<td><a href='users.php?change_to_admin={$user_id}'>admin</a></td>"; 
                echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>"; 
                //"source" is a get request, edit_posts is a use case makita na sila sa posts.php u can change the name
                //"edit posts as p_id"
                //go to posts.php and find edit_posts makita na nimo sa usecase
                echo "<td><a href='users.php?source=edit_user&edit_user=$user_id' class='btn btn-warning'>Edit</a></td>";//note:dili mo redirect sa edit user kung wala ampersand neck name "&edit_user"
                echo "<td><a href='users.php?delete={$user_id}' class='btn btn-danger'>Delete</a></td>"; //delete is a get request nag handle
                //posts.php?source=add_post
          echo "</tr>";//nana siya og post_id
 
    
        }



?>


                                     
                                    
                                        <!-- </tr> -->
             </tbody>
       </table>
 </form> <!---end of form -->
   <?php    
   //for delete query posts
   if(isset($_GET['delete'])){ //delete is a get request nag handle nana siya og post_id
    $the_users_id = $_GET['delete'];

  $query = "DELETE FROM users WHERE users_id = {$the_users_id} ";
  $delete_query = mysqli_query($connection,$query);

    if(!$delete_query){
        die("Query failed" . mysqli_error($connection));
    }
    header("Location: ./users.php");

//   $update_comment_count = mysqli_query($connection, $query);
//   if(!$update_comment_count){
//      die("query failed comment_count" . mysqli_error($connection));
//   }
    
   }



  if(isset($_GET['change_to_admin'])){

  $the_user_id = $_GET['change_to_admin'];
 
  $query = "UPDATE users SET user_role = 'admin' WHERE users_id = $the_user_id ";                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            

 $change_to_admin = mysqli_query($connection,$query);
 confirmQuery($change_to_admin);
 header("Location: users.php");

  }


if(isset($_GET['change_to_sub'])){
    $the_usrs_id = $_GET['change_to_sub'];

    $query = "UPDATE users SET user_role = 'subscriber' WHERE users_id = $the_usrs_id ";
    
    $change_subscriber = mysqli_query($connection,$query);
    confirmQuery($change_subscriber);
    header("Location: users.php");

}


 ?>