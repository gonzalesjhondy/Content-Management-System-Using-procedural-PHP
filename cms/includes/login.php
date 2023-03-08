<?php include "db.php"; ?>
<?php session_start(); //turn on session so that we can use it or prepare session?>

<?php
if(isset($_POST['login'])){

            $username = $_POST['username'];
            $password = $_POST['password'];
            
            //to prevent send different values and cannot delete data/to prvent send different parameter or hackers
            $username = mysqli_real_escape_string($connection, $username);//this will clean up data
            $password = mysqli_real_escape_string($connection, $password); 

            $query = "SELECT * FROM users WHERE username = '{$username}' ";
            $select_user_query = mysqli_query($connection, $query);
            if(!$select_user_query){
                die("Query failed" . mysqli_error($connection));
            }

            while($row = mysqli_fetch_array($select_user_query)){

                $db_user_id        = $row['users_id'];
                $db_username       = $row['username'];
                $db_user_password  = $row['user_password'];
                $db_user_firstname = $row['user_firstname'];
                $db_user_lastname  = $row['user_lastname'];
                $db_user_role      = $row['user_role'];
                $db_user_image     = $row['user_image'];
             

            }
            //   $password = crypt($password, $db_user_password);
            // if($username === $db_username && $password === $db_user_password){
            if(password_verify($password,$db_user_password)){ //exactly identical or dapat equal ni sila tanan
            // because of this display session data pwede na nati gamiton for entire admin since nag set tag session start sa admin header
                    $_SESSION['username'] = $db_username; //maka echo nata ani tanan
                    $_SESSION['firstname'] = $db_user_firstname;
                    $_SESSION['lastname'] = $db_user_lastname; //mag set tag mga session value dere para maka sulod nata sa admin
                    $_SESSION['user_role'] = $db_user_role; //kung naka activate ang session dre maka direct nata sa admin
                    $_SESSION['user_image'] = $db_user_image;
                    header("Location: ../admin");
                }        
            else{
              
                header("Location: ../index.php"); //if anything happens beside the two condition above redirect it in index.php homepage
                
             }
   

}//end of function




?>