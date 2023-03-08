<?php
function users_online(){

if(isset($_GET['onlineusers'])) {

global $connection;
if(!$connection){

    session_start();
    include("../includes/db.php"); //lecture 226 user online wihtout refreshing

    //this function here is gonna have an id of any users that will login in admin area
    $session = session_id();//and gonna catch an id of the session
    $time = time();
    $time_out_in_sec = 05;
    $time_out = $time - $time_out_in_sec;
    //make a query
    $query = "SELECT * FROM users_online WHERE session = '$session'";
    $send_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($send_query); 
    //count is equal to null they gonna insert the users_online table time and session
            if($count == NULL){
            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
            
            }else{

                $users_online_query = mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");

            // mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session' ");
            }

            $user_online_query =  mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");  
            return $count_user = mysqli_num_rows($user_online_query);



}//connection

 } //get request isset

}

users_online(); // call the function para makita

function confirmQuery($result){
    global $connection;// everytime using function use global para ang variable kay available or makita
  if(!$result){ //passing parameter anywhere
     die("Query Failed ." . mysqli_error($connection));
  }

}

function insert_categories(){
//mo error undifined variable gyud ang kani insert_categories kung walay global
    global $connection; // everytime using function use global para ang variable kay available or makita

    if(isset($_POST['submit'])) {
                                        
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)){
            echo "<h2 class='bg bg-warning'>This field should not be empty!</h2>";
        }else {

                    $query = "INSERT INTO categories(cat_title) ";
                    $query .= "VALUE('{$cat_title}') ";
                    
                    $create_category_query = mysqli_query($connection, $query);
                    
                    if(!$create_category_query){
                        die( 'Query failed' . mysqli_error($connection));
              }
            
        }
    }


}//End sa function

function findAllCategories(){
//mo error undifined variable gyud ang kani FindAllCategories kung walay global
global $connection;  // everytime using function use global para ang variable kay available or makita

        $query = "SELECT * FROM categories";
        $select_all_category = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_all_category)){
        $cat_title = $row['cat_title'];
        $cat_id    = $row['cat_id'];

        echo "</tr>";

        echo "<td>{$cat_id}</td>";
        echo"<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}' class='btn btn-danger'>DELETE</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}' class='btn btn-primary'>UPDATE</a></td>";//edit is nagdala og id as a get request
        echo "</tr>";
        } 

}

function deleteCategories(){
    //mo error undifined variable gyud ang kani deleteCategories kung walay global
global $connection;  // everytime using function use global para ang variable kay available or makita
    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection,$query);
        header("Location: categories.php"); //ma delete siya dayon kung click nato ka isa. pero
        //kung wala na siya nga header click nimo ka duha para ma delete siya.
        }

}

function redirect($Location){
    return header(header:"Location:" . $Location);
    
}


?>