<?php 


$query = "SELECT * FROM posts";
$select_allpost = mysqli_query($connection,$query);
confirmQuery($select_allpost);
while($row = mysqli_fetch_array($select_allpost)){
 $post_id     = $row['post_id'];
 $post_status = $row['post_status'];
}

if(isset($_POST['create_post'])){

        $post_category_id = $_POST['post_category'];   
        $post_title = $_POST['title'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        //the image will move in temporary location sa image folder
        move_uploaded_file($post_image_temp, "../images/$post_image");


        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
  

        if($post_category_id ==''|| empty($post_category_id) && $post_title ==''|| empty($post_title) ){
            echo "<h2>Sorry field is empty</h2> ";
        }else{

            $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,
            post_tags,post_status) ";
            
            $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}',
            '{$post_tags}','{$post_status}' ) ";
            //insert data from the database
            $create_all_post = mysqli_query($connection,$query);
            confirmQuery($create_all_post);
            $the_post_id = mysqli_insert_id($connection);
            // echo "<p class='bg-success'>Post Added.<a href='posts.php?p_id={$the_post_id}'>View All Post</a></p>";
            echo "<p class='bg-success'>Post Added. <a href='../post.php?p_id={$the_post_id}'>View Post</a> or 
            <a href='posts.php'>View More Posts </a></p>";
} //end of post

}


?>



 <form action="" method="post" enctype="multipart/form-data"><!-- enctype is encharge of sending form  lain lain data -->

   <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title">
   </div>

 
<div class="form-group">
   
   <select name="post_category" id="post_category">
      <?php   
         $query = "SELECT * FROM categories";  
         $select_category_post = mysqli_query($connection,$query);
         confirmQuery($select_category_post);

         while($row = mysqli_fetch_assoc($select_category_post)){
          $cat_id    =  $row['cat_id'];
          $cat_title =  $row['cat_title'];
              //para ma kuha ang name attrebute need ibutang ang value='{$cat_id}' kay same ra sila value
          echo "<option value='{$cat_id}'>{$cat_title}</option>";
        
         }
 

     ?>
      
       
   </select>

</div>


   <div class="form-group">
    <label for="post_author">Post Author</label>
    <input type="text" class="form-control" name="post_author">
   </div>

   <div class="form-group">

   <?php
   $query = "SELECT * FROM posts";
   $select_allpost = mysqli_query($connection,$query);
   confirmQuery($select_allpost);
   while($row = mysqli_fetch_array($select_allpost)){
    $post_id     = $row['post_id'];
    $post_status = $row['post_status'];

   }
   ?>
    <select name="post_status" id="">
        
      <option value="<?php echo $post_status  ?>"><?php echo $post_status  ?></option>
      <?php
      if($post_status == 'published'){
        echo "<option value='draft'>Draft</option>";
      }else{
        echo "<option value='published'>Publish</option>";
      }
     
      ?>
    </select>
</div>

   <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" class="form-control" name="image">
   </div>

   <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags">
   </div>

   <div class="form-group" >
    <label for="summernote">Post Content</label>
    <textarea type="text" class="form-control"  id="summernote" name="post_content" cols="30" rows ="10"></textarea>
   </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
</form>