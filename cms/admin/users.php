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
                   //use this get request
                  if(isset($_GET['source'])){ //get request 
                   
                    $source = $_GET['source']; //undifined variable ang post.php if dili nimo e butang ang source='' sa else statement
                }else{

                    $source ='';
                }
                    switch($source){
                         
                        case 'add_user';  
                        include "includes/add_user.php";

                        break;

                        case 'edit_user';//makita nimo siya sa include folder then viewAll_posts.php file note ang link niya para ma redirect ka sa file 
                         include "includes/Edit_user.php";
                        break;
                             
                        case '200';
                        echo 'nice 200';
                        break;

                        default: // if default siya no need nato suwat ang get request add this 
                            include "includes/viewAll_users.php";// add this './posts.php' sa admin_navigation.php
                         break;

                    }

             
                  

                  ?>


                        
                    </div>
              </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>        



        
        <!-- /#page-wrapper -->

        <?php include "includes/admin_footer.php" ?>
