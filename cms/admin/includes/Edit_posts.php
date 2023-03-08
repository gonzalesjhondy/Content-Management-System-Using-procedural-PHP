<?php
  if(isset($_GET['p_id'])){ //get request coming from ViewAll_Post.php

     $the_post_id = $_GET['p_id'];



 }//end of get request

$query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
$select_posts_by_id = mysqli_query($connection,$query);

while($row = mysqli_fetch_assoc($select_posts_by_id)) {
    $post_id            = $row['post_id'];
    $post_author        = $row['post_author'];
    $post_title         = $row['post_title'];
    $post_category_id   = $row['post_category_id'];
    $post_status        = $row['post_status'];
    $post_image         = $row['post_image'];
    $post_tags          = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date          = $row['post_date'];
    $post_content       = $row['post_content'];
}

if(isset($_POST['update_post'])){

     $post_title       = $_POST['title'];
     $post_category_id = $_POST['post_category'];
     $post_author      = $_POST['post_author'];
     $post_status      = $_POST['post_status'];
     $post_image       = $_FILES['image']['name'];
     $post_image_temp  = $_FILES['image']['tmp_name'];
     $post_tags         = $_POST['post_tags'];
     $post_content     = $_POST['post_content'];

      move_uploaded_file($post_image_temp, "../images/$post_image");
      //image from post super global kana sa ubos not desplaying if mag update
      //soution: so mao ning solution niya kung empty walay sulud si post image mag set tag if(empty($post_image))niya set the query sa ubos
      //para mo display siya
      if(empty($post_image)){
        
        $query = "SELECT * FROM posts WHERE post_id = {$the_post_id} ";
        $select_image = mysqli_query($connection, $query);

        while($row = mysqli_fetch_array($select_image)){

          $post_image = $row['post_image'];
        }
      }//end of function

      $query = "UPDATE posts SET ";
      $query .="post_title       = '{$post_title}', ";
      $query .="post_category_id = '{$post_category_id}', ";
      $query .="post_date        =   now(), ";
      $query .="post_author      = '{$post_author}', ";
      $query .="post_status      = '{$post_status}', ";
      $query .="post_tags        = '{$post_tags}', ";
      $query .="post_content     = '{$post_content}', ";
      $query .="post_image       = '{$post_image}' ";
      $query .="WHERE post_id = {$the_post_id} ";

      $post_update_query = mysqli_query($connection,$query); 
      confirmQuery($post_update_query);

      echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$the_post_id}'>View Post</a> or 
      <a href='posts.php'>Edit More Posts </a></p>";
      
}    
 
?>
 
 
 
 
 <form action="" method="post" enctype="multipart/form-data"><!-- enctype is encharge of sending form  lain lain data -->

<div class="form-group">
 <label for="title">Post Title</label>
 <input value="<?php echo $post_title  ?>" type="text" class="form-control" name="title">
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
 <input value="<?php echo $post_author  ?>" type="text" class="form-control" name="post_author">
</div>
<div class="form-group">
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
<!-- <div class="form-group">
 <label for="post_status">Post Status</label>
 <input value="<?php // echo $post_status  ?>" type="text" class="form-control" name="post_status">
</div> -->


<div class="form-group">
<label for="post_image">Post Image</label>
    <input type="file" class="form-control" name="image">
  <img width="100" src="../images/<?php echo $post_image ?>" alt="">
</div>

<div class="form-group">
 <label for="post_tags">Post Tags</label>
 <input value="<?php echo $post_tags  ?>" type="text" class="form-control" name="post_tags">
</div>

<div class="form-group">
 <label for="post_content">Post Content</label>
 <textarea value="" type="text" class="form-control" name="post_content" cols="30" rows ="10"><?php echo $post_content?></textarea>

 <div class="form-group">
     <input type="submit" class="btn btn-primary" type="submit" name="update_post" value="Update Post">
 </div>
</form>