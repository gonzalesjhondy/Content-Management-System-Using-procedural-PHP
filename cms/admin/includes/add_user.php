<?php 
if(isset($_POST['create_user'])){
  
        $user_firstname = $_POST['user_firstname'];
        $user_lastname  = $_POST['user_lastname'];
        $username       = $_POST['username'];
        $user_email     = $_POST['user_email'];
        $user_image     = $_FILES['image']['name'];
        $user_image_tmp = $_FILES['image']['tmp_name'];
        
        move_uploaded_file($user_image_tmp, "../images/$user_image");

        $user_role      = $_POST['user_role'];
        $user_password  = $_POST['user_password'];

        // $post_image = $_FILES['image']['name'];
        // $post_image_temp = $_FILES['image']['tmp_name'];
        // //the image will move in temporary location sa image folder
        // move_uploaded_file($post_image_temp, "../images/$post_image");


        
        // $post_content = $_POST['post_content'];
        // $post_date = date('d-m-y');
  

        if($user_firstname ==''|| empty($user_firstname) &&  $username    ==''|| empty($username) 
        && $user_password ==''|| empty($user_password) && $user_email ==''|| empty($user_email)){
            echo "<h2>Sorry field is empty</h2> ";
        }else{

          $password = password_hash($user_password, PASSWORD_BCRYPT, array('cost'=>12));

            $query = "INSERT INTO users(user_firstname,user_lastname,user_role,username,user_email,user_image,user_password) ";
            
            $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_image}',
            '{$password}') ";
            //insert data from the database
            $create_all_users = mysqli_query($connection,$query);
            confirmQuery($create_all_users);
    
          echo "User Created: ". " ". "<a href='users.php'>View Users</a> ";


  } //end of post

}


?>



 <form action="" method="post" enctype="multipart/form-data"><!-- enctype is encharge of sending form  lain lain data -->

   <div class="form-group">
    <label for="title">Firstname</label>
    <input type="text" class="form-control" name="user_firstname">
   </div>

   <div class="form-group">
    <label for="post_author">Lastname</label>
    <input type="text" class="form-control" name="user_lastname">
   </div>


   
   <div class="form-group">
   
     <select name="user_role" id="">
        <option value='subscriber'>Select Option</option>
                <option value='admin'>Admin</option>
                <option value='subscriber'>Subscriber</option>
     </select>
   </div>
  
   <div class="form-group">
      <label for="user_image">User Image</label>
      <input type="file" class="form-control" name="image">
   </div>

   <div class="form-group">
    <label for="post_status">username</label>
    <input type="text" class="form-control" name="username">
   </div>

   <div class="form-group">
    <label for="post_tags">Email</label>
    <input type="text" class="form-control" name="user_email">
   </div>

   <div class="form-group">
    <label for="post_tags">Password</label>
    <input type="text" class="form-control" name="user_password">
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
        <input type="submit" class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>
</form>
