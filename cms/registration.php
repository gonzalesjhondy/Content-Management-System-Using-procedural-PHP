<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
    <!-- Navigation -->
    <?php  include "includes/navigation.php"; ?>
    
 <?php
     
    if(isset($_POST['submit'])){

        $username = $_POST['username'];
        $email    = $_POST['email'];
        $password = $_POST['password'];

//validation
// if($username = '' || empty($username) || $email = '' || empty($email) || $password='' || empty($password)){
if(!empty($username) &&  !empty($email) && !empty($password)){


//escape some information coming from the form
$username = mysqli_real_escape_string($connection, $username);
$email    = mysqli_real_escape_string($connection, $email);
$password = mysqli_real_escape_string($connection, $password);
//for hashing password
$password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12) );

//for hashing password  
        // $query ="SELECT randSalt FROM users";
        // $select_randSalt_query = mysqli_query($connection, $query);

        // if(!$select_randSalt_query){

        //     die("Query failed" . mysqli_error($connection));
        // }

        // while($row = mysqli_fetch_array($select_randSalt_query)){
        //     $salt     = $row['randSalt'];

        //  }
        //  //to encrypt password 201
        //   $password = crypt($password, $salt);
         
        $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
        $query .= "VALUES('{$username}','{$email}','{$password}', 'subscriber' )";

        $register_query = mysqli_query($connection, $query);
        if(!$register_query){
            die("connection failed" . mysqli_error($connection));
        }

        $message = "<h5>Your Registration has been submitted";

}else{


    

      $message = "Fields cannot be empty";

        // echo "<script>alert('Please! fill up all fields')</script>";

     }//end of else statement validation

    }else{

        $message="";
    }//end of post request
?>



    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h5 class='text-center bg-success'><?php echo $message; ?></h5>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
