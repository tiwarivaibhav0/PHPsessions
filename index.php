<?php session_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            #submit{
                background-color:#0033cc;
                color:white;
                width:100px;
                height:40px;
            }
            img{
                height:200px;
                width:200px;
                margin-right:40px;
            }
            #gallery{
                display:inline-block;
                margin-bottom:25px;
            }
            
        </style>
    </head>
<body>
<h1>Image Gallery</h1>
<h4>This page displays the list of uploaded images</h4>

<form action="index.php" method="post" enctype="multipart/form-data">
  
  <input type="file" name="fileUpload" id="fileUpload">
  <br><br><br><br>
  <input type="submit" value="Upload More" name="submit" id="submit">
  <br><br><br><br>
</form>
 
<?php

if(isset($_POST["submit"])) {
  
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
$upload = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   
  $check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
  if($check !== false) {   
    
    $upload = 1;
  } else {
    
    $upload = 0;
  }
}


if ($_FILES["fileUpload"]["size"] > 300000) {
  
  $upload= 0;
}


if($imageFileType !="png" && $imageFileType!="jpg" && $imageFileType!="jpeg" && $imageFileType!="webp") {
  
  $upload = 0;
}


if ($upload== 0) {


} else {
  if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
     $_SESSION[$target_file]=$target_file;
     
    
  } else {
    
  }
}

?>
<?php
if($_SESSION) 
  foreach($_SESSION as $key => $val) { ?>
  <div id="gallery"> 
      <span><?php echo "<img src='/PHPsessions/$val'> "; ?></span>
  </div>
 
     


<?php }  
?>

 
</body>
</html>

