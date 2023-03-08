<?php  
if(isset($_POST['checkBoxArray'])){

    foreach($_POST['checkBoxArray'] as $postValueId){//getting id to the <tableData>

                $bulk_options = $_POST['bulk_options']; 
                switch($bulk_options){
                    case 'published':   
                        
                        $query = "UPDATE posts SET post_status ='{$bulk_options}' WHERE post_id= '{$postValueId}' ";
                        $update_published_status = mysqli_query($connection,$query);
                        confirmQuery($update_published_status);
    
                        break;
                    
                    case 'draft':

                        $query = "UPDATE posts SET post_status ='{$bulk_options}'  WHERE post_id= '{$postValueId}' ";
                        $update_draft_status = mysqli_query($connection,$query);
                        confirmQuery($update_draft_status);
                        
                        break;
                        
                    case 'delete':

                        $query = "DELETE FROM posts WHERE post_id = '{$postValueId}' ";
                        $update_delete_status = mysqli_query($connection,$query);
                        confirmQuery($update_delete_status);

                        break;



                        case 'clone':

                       $query = "SELECT * FROM posts WHERE post_id ='{$postValueId}' ";
                       $select_post_query = mysqli_query($connection, $query);

                       while($row = mysqli_fetch_assoc($select_post_query)){
                        $post_id =     $row['post_id'];
                        $post_author = $row['post_author'];
                        $post_title  = $row['post_title'];
                        $post_category_id = $row['post_category_id'];
                        $post_status = $row['post_status']; 
                        $post_image  = $row['post_image'];
                        $post_tags   = $row['post_tags']; 
                        $post_date   = $row['post_date'];   
                        $post_content = $row['post_content'];
                       }
                       $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,
                       post_tags,post_status) ";
                       
                       $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}',
                       '{$post_tags}','{$post_status}' ) ";
                       $copy_query = mysqli_query($connection, $query);
                       confirmQuery($copy_query);

                            break;

                        case 'reset':
                            $query = "UPDATE posts SET post_views_counts = 0 WHERE post_id=" . mysqli_real_escape_string($connection,$postValueId) .  " ";
                            $reset_query = mysqli_query($connection,$query);
                            confirmQuery($reset_query);
                            break;
                }

          


       }

} //end of post request


?>


<form action="" method="post">

<table class="table table-bordered table-hover">

    <div id="bulkoptionsContainer" class="col-xs-4">
        <select class="form-control" name="bulk_options" id="">
            
            <option value="">Select Option</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>
            <option value="reset">Reset Count Views</option>

        </select>
    </div>

    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>

    </div>
                                <thead>
                                    <tr>
                                        <th><input id="selectAllBoxes" class="checkbox" type="checkbox"></th>
                                        <th>Id</th>
                                        <th>Author</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Tags</th>
                                        <th>Comments</th>
                                        <th>Date</th>
                                        <th>views count</th>
                                        <th>View Post</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>   
                                </thead>
                                    <tbody>
                                        <!-- <tr> -->

<?php
//set order post_id to descending to be the top newest id on the table
    $query = "SELECT * FROM posts ORDER BY post_id DESC";
    $select_Posts = mysqli_query($connection,$query);

        while($row = mysqli_fetch_assoc($select_Posts)){

            $post_id =     $row['post_id'];
            $post_author = $row['post_author'];
            $post_title  = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image  = $row['post_image'];
            $post_tags   = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date   = $row['post_date'];
            $post_views  = $row['post_views_counts'];

          echo "<tr>";
          ?>
             <td><input class='checkBoxes' type='checkbox' name="checkBoxArray[]" value="<?php echo $post_id ?>"></td>
             <?php
                echo "<td>$post_id</td>";
                echo "<td>$post_author</td>";
                echo "<td>$post_title</td>";

                $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";

                $select_category_id = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_category_id)){
                
                    $cat_id     = $row['cat_id'];
                    $cat_title  = $row['cat_title'];

        

                //display the cat_title in the database
                echo "<td>$cat_title</td>";
                }

                echo "<td>$post_status</td>";
                echo "<td><img src='../images/$post_image' alt='image' style='width: 100px; length: 100px;'></td>";
                echo "<td>$post_tags</td>";
                echo "<td>$post_comment_count</td>";
                echo "<td>$post_date</td>";
                echo "<td><a href='posts.php?reset={$post_id}'>$post_views</a></td>";
                echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>"; 
                //"source" is a get request, edit_posts is a use case makita na sila sa posts.php u can change the name
                //"edit posts as p_id"
                //go to posts.php and find edit_posts makita na nimo sa usecase
                echo "<td><a href='posts.php?source=edit_posts&p_id={$post_id}' class='btn btn-warning'>Edit</a></td>"; 
                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this post!') \" href='posts.php?delete={$post_id}' class='btn btn-danger'>Delete</a></td>"; //delete is a get request nag handle 
          echo "</tr>";//nana siya og post_id

    }



?>


                                     
                                    
                                        <!-- </tr> -->
                                </tbody>
                            </table>
                            </form> <!--  end of form -->
   <?php    
   //for delete query posts
   if(isset($_GET['delete'])){ //delete is a get request nag handle nana siya og post_id
    $the_post_id = $_GET['delete'];

    $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
    $delete_query = mysqli_query($connection,$query);
    if(!$delete_query){
        die("Query failed" . mysqli_error($connection));
    }
    header("Location: ./posts.php");
    
   }


   if(isset($_GET['reset'])){

     $reset_post_id = $_GET['reset'];
     $query = "UPDATE posts SET post_views_counts = 0 WHERE post_id =" . mysqli_real_escape_string($connection,$reset_post_id) ." ";
     $reset_query = mysqli_query($connection,$query);
     confirmQuery($reset_query);
     header("Location: posts.php");
   }

   ?>                        