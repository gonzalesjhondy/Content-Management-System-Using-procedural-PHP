<?php include "includes/header.php"  ?>
<?php include "includes/db.php"  ?>
    <!-- Navigation -->
    <?php include "includes/navigation.php"  ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->



            <div class="col-md-8">

            <?php

            if(isset($_GET['p_id'])){ //get request coming from index.php
            
                $the_post_id     = $_GET['p_id']; 
                $the_post_author = $_GET['author'];

            }
            
      $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}' ";
      $select_all_posts = mysqli_query($connection,$query);
      while($row = mysqli_fetch_assoc($select_all_posts)){

         $post_title   = $row['post_title'];
         $post_author  = $row['post_author'];
         $post_date    = $row['post_date'];
         $post_image   = $row['post_image'];
         $post_content = substr($row['post_content'],0,100);//substring means 100 characters ma show  
                
            ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                   All Post by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;  ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <!-- <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

                <hr>

                <?php } ?>


                 <!-- Blog Comments -->
                  <?php
                  
                        if(isset($_POST['create_comment'])){
                           
                            $the_post_id = $_GET['p_id']; //use get request this Id will be able to save in comment
                            //kung ma insert ni insert ang $the_post_id sa values
                           
                        $comment_author  = $_POST['comment_author'];
                        $comment_email  = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];


                        if($comment_author ==''|| empty($comment_author) && $comment_email ==''|| empty($comment_email) &&
                        $comment_content ==''|| empty($comment_content)){
                        //    echo"<h1 class='p-3 mb-2 bg-danger text-white'>Empty Failed Please fill all fields!</h1>";
                        echo "<script>alert('Fields cannot be empty')</script>";
                        }else{

  $query = "INSERT INTO comments (comment_post_id,comment_author,comment_email,comment_content,
   comment_status,comment_date) ";
//kung mag insert na si comment table ma apil og save ang $the_post_id nga naa sa url para ma trace nato ang relation
//sa duha ka table nga comment and post table copy and paste $the_post_id nga naa sa values para ma save sa comment table
   $query .= "VALUES ($the_post_id,'{$comment_author}','{$comment_email}','{$comment_content}', 'unapproved', now())";

   $create_comment_query = mysqli_query($connection, $query);
  
   if(!$create_comment_query){
    die('query failed' . mysqli_error($connection));
   }

//note this will be increasing  of comment count if you add a comment it will add plus one to the posts table umder 
//the post_comment_count
   $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
   $query .= "WHERE post_id = $the_post_id "; 
   $update_comment_count = mysqli_query($connection, $query);
  if(!$update_comment_count){
    die("query failed " . mysqli_error($connection));
  }

            }
                    } //end og post request

                   ?>

         

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php  include "includes/sidebar.php" ?>
      

        </div>
        <!-- /.row -->

        <hr>

       <?php  include "includes/footer.php" ?>

