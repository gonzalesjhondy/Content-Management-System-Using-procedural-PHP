<?php include "includes/admin_header.php" ?>




    <div id="wrapper">

    <!-- Navigation -->

    <?php include "includes/admin_navigation.php" ?>






        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                            <h1 class="page-header">
                                WElcome to ADmin
                                <small>Author</small>
                            </h1>
                            <?php  

if(isset($_SESSION['username'])){ //need to pullout user_name
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = '{$username}' ";

$select_user_profile = mysqli_query($connection,$query);
 while($row = mysqli_fetch_array($select_user_profile)){
    $users_id       = $row['users_id'];
    $username       = $row['username'];
    $user_password  = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname  = $row['user_lastname'];
    $user_email     = $row['user_email'];
    $user_image     = $row['user_image'];
    $user_role      = $row['user_role'];


 }  //end of while loop




 if(isset($_POST['Edit_user'])){
  
    $user_firstname = $_POST['user_firstname'];
    $user_lastname  = $_POST['user_lastname'];
    $username       = $_POST['username'];
    $user_email     = $_POST['user_email'];
    $user_role      = $_POST['user_role'];
    $user_password  = $_POST['user_password'];



 $query = "UPDATE users SET ";
 $query .= "user_firstname  = '{$user_firstname}', ";
 $query .= "user_lastname   = '{$user_lastname}', ";
 $query .= "user_role       = '{$user_role}', ";
 $query .= "username        = '{$username}', ";
 $query .= "user_email      = '{$user_email}' ";
 $query .= "WHERE username  = '{$username}' ";

$edit_user_query = mysqli_query($connection, $query);
confirmQuery($edit_user_query);
 }//end of post
} //end of session
?>
                  

<form action="" method="post" enctype="multipart/form-data"><!-- enctype is encharge of sending form  lain lain data -->

<div class="form-group">
 <label for="title">Firstname</label>
 <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
</div>

<div class="form-group">
 <label for="post_author">Lastname</label>
 <input type="text" class="form-control" name="user_lastname" value="<?php echo  $user_lastname; ?>">
</div>



<div class="form-group">

  <select name="user_role" id="">
  <option value='subscriber'><?php echo $user_role ; ?></option>
<?php  

if($user_role ==  'admin'){
echo " <option value='Subscriber'>subscriber</option> ";

}else{

echo " <option value='admin'>admin</option> ";

}
?>


             
            
  </select>
</div>

<!-- <div class="form-group">
   <label for="user_image">User Image</label>
   <input type="file" class="form-control" name="image">
   <img width="100" src="../images/ alt="">
</div> -->

<div class="form-group">
 <label for="post_status">username</label>
 <input type="text" class="form-control" name="username" value="<?php echo $username ;  ?>">
</div>

<div class="form-group">
 <label for="post_tags">Email</label>
 <input type="text" class="form-control" name="user_email" value="<?php echo $user_email   ?>">
</div>

<div class="form-group">
 <label for="post_tags">Password</label>
 <input type="password" class="form-control" name="user_password" value="<?php echo $user_password  ?>">
</div>



<!-- 
<div class="form-group">
 <label for="post_image">Post Image</label>
 <input type="file" class="form-control" name="image">
</div> -->



<!-- <div class="form-group">
 <label for="post_content">Post Content</label>
 <textarea type="text" class="form-control" name="post_content" cols="30" rows ="10">

 </textarea>
</div> -->

 <div class="form-group">
     <input type="submit" class="btn btn-primary" type="submit" name="Edit_user" value="Update Profile">
 </div>
</form>


                        
                    </div>
              </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>        



        
        <!-- /#page-wrapper -->

        <?php include "includes/admin_footer.php" ?>
