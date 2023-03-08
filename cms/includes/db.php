<?php 
$db['db_host'] = 'localhost:3307';
$db['db_user']='root';
$db['db_pass'] = ' ';
$db['db_name'] = 'cms2022' ;                                                                                                            

foreach($db as $key => $value){
    define(strtoupper($key), $value); //UpperCase
}


$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

// if($connection){
//     echo "successfully connected";
// }else{
//     echo "not connected";
// }

 

?>
