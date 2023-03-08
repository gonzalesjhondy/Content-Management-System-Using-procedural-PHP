<?php session_start(); //turn on session so that we can use it or prepare session?>

<?php

// because of this display session data pwede na nati gamiton for entire admin since nag set tag session start sa admin header
$_SESSION['username'] = null; //nothing is there
$_SESSION['firstname'] = null ;// cancel its session 
$_SESSION['lastname'] = null;// cancel its session 
$_SESSION['user_role'] =null ;// cancel its session 
//after cancelling session set a redirect page in index.php para ma logout na nato ang session
header("Location: ../index.php");

?>