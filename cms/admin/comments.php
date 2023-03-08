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
//use a get request source dili ni siya id naghimo ratag get resource aron tanan ato gihimo nga mga file
//ma include ang html nga na bilin dre like if maghimo sila of file no need na sila include/header or footer
                  if(isset($_GET['source'])){ 
                   
                    $source = $_GET['source']; //undifined variable ang post.php if dili nimo e butang ang source='' sa else statement
                }else{

                    $source ='';
                }
                    switch($source){ // use case
     //sa add post navigation naa link didto mao nis siya gibutang => posts.php?source=add_post                    
                        case 'add_post'; 
    //kani nga add_comment.php is file ni nga gihimo didto sa folder includes
                        include "includes/add_comment.php"; 

                        break;

                        case 'edit_posts';
                         include "includes/Edit_comment.php";//
                        break;
                             
                        case '200';
                        echo 'nice 200';
                        break;

                        default:// if default siya no need nato suwat ang get request add this 
                            include "includes/viewAll_comment.php";// add this './comments.php' sa admin_navigation.php
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
