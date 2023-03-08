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

                          

                            <!-- need to echo here username para ma display if naka set nata start session sa admin header -->
                            <small><?php echo $_SESSION['username']; //admin header na set na ang session so pwede na nato gamiton drea?></small>
                        
                        </h1>
                
                        <ol class="breadcrumb">
                            <!-- <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li> -->
                        </ol>
                    </div>
                </div>
                <!-- /.row -->





       
                <!-- /.row -->
                
                <div class="row">
<div class="col-lg-3 col-md-6">
<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="row">
            <div class="col-xs-3">
                <i class="fa fa-file-text fa-5x"></i>
            </div>

            <div class="col-xs-9 text-right">
                        <?php

                        $query = " SELECT * FROM posts";
                        $select_post_query = mysqli_query($connection,$query);
                        $post_count = mysqli_num_rows($select_post_query);

                        echo " <div class='huge'>{$post_count}</div>";

                        ?>



           
                <div>Posts</div>
            </div>
        </div>
    </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                                <?php
                                $query = "SELECT * FROM comments";
                                $select_comment_query = mysqli_query($connection,$query);
                                $comment_count = mysqli_num_rows($select_comment_query );

                                echo " <div class='huge'>{$comment_count}</div>";
                                ?>



                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                            <?php
                            $query = "SELECT * FROM users";
                            $select_users_query = mysqli_query($connection,$query);
                            $users_count = mysqli_num_rows($select_users_query);
                            echo "<div class='huge'>{$users_count}</div>"

                            ?>

                   
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                                <?php
                                $query = "SELECT * FROM categories";
                                $select_category_query = mysqli_query($connection,$query);
                                $category_count = mysqli_num_rows($select_category_query);
                                echo "<div class='huge'>{$category_count}</div>";

                                ?>


                     
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->

<?php
$query = "SELECT * FROM posts WHERE post_status = 'published'";
$select_all_published_post = mysqli_query($connection,$query);
$post_published_count = mysqli_num_rows($select_all_published_post); 

$query = "SELECT * FROM posts WHERE post_status = 'draft'";
$select_all_draft_post = mysqli_query($connection,$query);
$post_draft_count = mysqli_num_rows($select_all_draft_post); 

$query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
$unapproved_comment_query = mysqli_query($connection,$query);
$unapproved_comment_count = mysqli_num_rows($unapproved_comment_query);

$query = "SELECT * FROM users WHERE user_role = 'subscriber' ";
$subscriber_query = mysqli_query($connection,$query);
$subscriber_count = mysqli_num_rows($subscriber_query);

$query = "SELECT * FROM users WHERE user_role = 'admin' ";
$admin_query = mysqli_query($connection,$query);
$admin_count = mysqli_num_rows($admin_query);
?>

<div class="row">

<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
          <?php   //note:kung how many total number of data naa sa array maosad ibutan sa number of forloop
           $element_text = ['All Posts','Active Posts','Draft Posts', 'Comments','Pending Comments', 'Users','Admin','Subscriber','Categories'];
           $element_count = [$post_count,$post_published_count,$post_draft_count,$comment_count,$unapproved_comment_count,$users_count,$admin_count,$subscriber_count,$category_count];
            
           for($i =0;$i < 8; $i++){  //mo 8 times display every data naka set sa forloop kay 8 data raman ang $element_text
           //1.)kani element text is ma destribute iya data sa posts refer:2   
            echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],"; //element_text print all value
//$i ang buhat ani is mo sulod siya sa $element_count and _text, use $i to iterate goes around of its value display using echo
           }
          ?>
        //   ex.['Posts', 1000],//2.)$element_text is naa array data mao naghimo tag for loop para ma display tanan data na
            //nasulod sa element text dre mismo 
        ]);

        var options = {
          chart: {
            title: ' ',
            subtitle: ' ',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
</div>


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            

            </div>
            <!-- /.container-fluid -->
        </div>        



        
        <!-- /#page-wrapper -->

        <?php include "includes/admin_footer.php" ?>
