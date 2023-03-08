<?php

if(isset($_POST['CheckBoxArray'])){

  foreach($_POST['CheckBoxArray'] as $postValueId){
   $bulk_options = $_POST['bulk_options'];
       switch($bulk_options){
               case 'approve':
                $sql = "UPDATE comments SET comment_status ='{$bulk_options}' WHERE comment_id = '{$postValueId}' ";
                $update_approve_query = mysqli_query($connection,$sql);
                confirmQuery($update_approve_query);
                break;
                case 'unapproved':
                    $sql = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = '{$postValueId}' ";
                    $update_unapprove_query = mysqli_query($connection,$sql);
                    confirmQuery($update_unapprove_query);

                break;

                case 'delete':
                     $sql = "DELETE FROM comments WHERE comment_id = '{$postValueId}' ";
                     $delete_comment_query = mysqli_query($connection, $sql);
                     confirmQuery($delete_comment_query);
       }//end of case statement
  }//end of foreach
}//end of post request





?>



<form action="" method="post">


<table class="table table-bordered table-hover">

<div id="bulkoptionsContainer" class="col-xs-4">
    <select class="form-control" name="bulk_options" id="">
      <option value="">Select Option</option>
      <option value="approve">Approve</option>
      <option value="unapproved">Unapproved</option>
      <option value="delete">Delete</option>
    </select>
</div>

<div class="col-xs-4">
   <input type="submit" name="submit" class="btn btn-success" value="apply">

</div>


                                <thead>
                                    <tr>
                                    <th><input id="selectAllBoxes" class="checkbox" type="checkbox"></th>
                                        <th>Id</th>
                                        <th>Author</th>
                                        <th>Comment</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>In Responce to</th>
                                        <th>Date</th>
                                        <th>Approve</th>
                                        <th>UnApprove</th>
                                        <th>Delete</th>
                                    </tr>   
                                </thead>
                                    <tbody>
                                        <!-- <tr> -->

<?php

    $query = "SELECT * FROM comments";
    $select_comments = mysqli_query($connection,$query);

        while($row = mysqli_fetch_assoc($select_comments)){

            $comment_id      = $row['comment_id'];
            $comment_pos_id  = $row['comment_post_id']; // this Id are the id of post
            $comment_author  = $row['comment_author'];
            $comment_email   = $row['comment_email'];
            $comment_content = $row['comment_content'];
            $comment_status  = $row['comment_status'];
            $comment_date    = $row['comment_date'];
    

          echo "<tr>";
                ?>
                <td><input type="checkbox" class="checkBoxes" name="CheckBoxArray[]" value="<?php echo $comment_id  ?>"></td>

                <?php
                echo "<td>$comment_id </td>";
                echo "<td>$comment_author</td>";
                echo "<td>$comment_content</td>";

                // $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";

                // $select_category_id = mysqli_query($connection, $query);
                // while($row = mysqli_fetch_assoc($select_category_id)){
                
                //     $cat_id     = $row['cat_id'];
                //     $cat_title  = $row['cat_title'];

        

                // //display the cat_title in the database
                // echo "<td>$cat_title</td>";
                // }

                echo "<td>$comment_email</td>";
                echo "<td>$comment_status</td>";

$query = "SELECT * FROM posts WHERE post_id = $comment_pos_id"; //reason why we choose this kay id ni sa post nga naka save 
//sa comment table 
$select_post_id_query = mysqli_query($connection,$query);
if(!$select_post_id_query){
    die('query failed' . mysqli_error($connection));
}
while($row = mysqli_fetch_assoc($select_post_id_query)){
    $post_id =$row['post_id'];
    $post_title = $row['post_title'];

    echo"<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
}

                echo "<td>$comment_date</td>";
                echo "<td><a href='comments.php?approve=$comment_id'>approve</a></td>"; 
                echo "<td><a href='comments.php?unapprove=$comment_id' class='btn btn-warning'>Unapprove</a></td>"; 
                echo "<td><a href='comments.php?delete=$comment_id' class='btn btn-danger'>Delete</a></td>";
          echo "</tr>";

    }



?>             
             <!-- </tr> -->
                                </tbody>
                            </table>
                    </form><!--end of form -->
   <?php    
//approve get request
if(isset($_GET['approve'])){
    $the_comment_id = $_GET['approve'];
$query = "UPDATE comments SET comment_status ='approve' WHERE comment_id = $the_comment_id";

$approve_comment_query = mysqli_query($connection,$query);
confirmQuery($approve_comment_query);
header("Location: ./comments.php");
}

//unapprove get request
if(isset($_GET['unapprove'])){
      $the_comment_id = $_GET['unapprove'];
  $query = "UPDATE comments SET comment_status ='unapprove' WHERE comment_id = $the_comment_id ";
  
  $unapprove_comment_query = mysqli_query($connection,$query);
  confirmQuery($unapprove_comment_query);
  header("Location: ./comments.php");
}








   //for delete query posts
if(isset($_GET['delete'])){
$delete_id = $_GET['delete'];

$query = "DELETE FROM comments WHERE comment_id = $delete_id";
$delete_that_comment = mysqli_query($connection, $query);
if(!$delete_that_comment){
    die('query failed' . mysqli_error($connection));
}
header("Location: ./comments.php");


}
   ?>                        