<?php 

if(isset($_GET['edit_user'])){
  $the_user_id = $_GET['edit_user'];

}



if(isset($_POST['Edit_user'])){
  
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
          //****001***//solution if ang user_image so mao ning solution niya kung empty walay sulud si user image mag set tag if(empty($post_image))niya set the query sa ubos
      //para mo display siya
          if(empty($user_image)){
            $query = "SELECT * FROM users WHERE users_id = {$the_user_id}";
            $select_users = mysqli_query($connection,$query);
            confirmQuery($select_users);
   
          while($row = mysqli_fetch_array($select_users)){

               $user_image = $row['user_image'];
               
          }
//this is for updating hashing password
          $query ="SELECT randSalt FROM users";
          $select_randSalt_query = mysqli_query($connection, $query);
  
          confirmQuery($select_randSalt_query);
  
          while($row = mysqli_fetch_array($select_randSalt_query)){
              $salt     = $row['randSalt'];
  
           }
              //  //to encrypt password 203
              $hashed_password = crypt($user_password, $salt);
             
            }
//end of updating hashing password

           $query = "UPDATE users SET ";
           $query .= "user_firstname = '{$user_firstname}', ";
           $query .= "user_lastname  = '{$user_lastname}', ";
           $query .= "username       =  '{$username}', ";
           $query .= "user_email     = '{$user_email}', ";
           $query .= "user_image     = '{$user_image}', "; //user_image kung i update mawala siya means update empty, soo sa babaw refer number (001)
           $query .=  "user_role     = '{$user_role}', ";
           $query .= "user_password   = '{$hashed_password}' ";
           $query .= "WHERE users_id   = '{$the_user_id}' ";
         $update_users = mysqli_query($connection,$query);
         confirmQuery($update_users);
         header('Location: ./users.php');

  } //end of post

}

$query = "SELECT * FROM users WHERE users_id = {$the_user_id}";
$select_user = mysqli_query($connection,$query);
confirmQuery($select_user);

while($row = mysqli_fetch_assoc($select_user)){
   
        $user_firstname = $row['user_firstname'];
        $user_lastname  = $row['user_lastname'];
        $username       = $row['username'];
        $user_email     = $row['user_email'];
        $user_image     = $row['user_image'];
        $user_role      = $row['user_role'];
        $user_password  = $row['user_password'];

}


?>



 <form action="" method="post" enctype="multipart/form-data"><!-- enctype is encharge of sending form  lain lain data -->

   <div class="form-group">
    <label for="title">Firstname</label>
    <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ?>">
   </div>

   <div class="form-group">
    <label for="post_author">Lastname</label>
    <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname ?>">
   </div>


   
   <div class="form-group">
   
     <select name="user_role" id="">
     <option value='<?php echo $user_role; ?>'><?php echo $user_role; ?></option>
<?php  

if($user_role ==  'admin'){
  echo " <option value='Subscriber'>subscriber</option> ";

}else{

  echo " <option value='admin'>admin</option> ";
 
}
?>


                
               
     </select>
   </div>
  
   <div class="form-group">
      <label for="user_image">User Image</label>
      <input type="file" class="form-control" name="image">
      <img width="100" src="../images/<?php echo $user_image ?>" alt="">
   </div>

   <div class="form-group">
    <label for="post_status">username</label>
    <input type="text" class="form-control" name="username" value="<?php echo $username  ?>">
   </div>

   <div class="form-group">
    <label for="post_tags">Email</label>
    <input type="text" class="form-control" name="user_email" value="<?php echo $user_email  ?>">
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
        <input type="submit" class="btn btn-primary" type="submit" name="Edit_user" value="Edit User">
    </div>
</form>
