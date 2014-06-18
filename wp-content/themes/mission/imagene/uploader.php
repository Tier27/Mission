<html>
<body>  
<?php $pagename='uploader'; ?>
<?php require_once("functions.php"); ?>
<div class="big-container">
<?php include("links.php"); ?>
<div id="container">
  <div class="pageheader">
    <h4>image uploader</h4>
    <p>Choose a file from your computer and press submit to upload an image to use.  Lorem ipsum dolor sit amet, consectetuer adipiscing elit, 
      sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
  </div>



<div id="upload-resource">
  <form action ="" method="post" enctype="multipart/form-data">
      <div id="upload-resource-top">
        <button type="button" class="browse-button" onclick="document.getElementById('upload-field').click();"><p> Choose File </p></button>  
          <textarea name="post-resource-input" placeholder="No file chosen"></textarea>
        </div>
        <div id="upload-resource-bottom">
          <div id="upload-wrap">
             <input type="file" name="file" id="upload-field">
          </div>
        </div>
        <input type="submit" name="submit" id="submit" value="Submit">
    </form>
 </div>

<!--<form action="" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Submit">
</form> -->

</body>
</html>
<?php
require_once("functions.php"); 
if (isset($_FILES) && !empty($_FILES)) {
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 4000000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . ($itsname=$_FILES["file"]["name"]) . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists("uploads/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      $deposit=mysql_query("insert into images set name='$itsname'") or die(mysql_error().'didnt work');
      $query=mysql_query("select id from images where name='$itsname'") or die(mysql_error());
      $image=mysql_fetch_array($query);
      $id=$image['id'];
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "uploads/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "uploads/" . $_FILES["file"]["name"];
      }
    }
  }
else
  {
  echo "Invalid file";
  }
}
else { }
?>
</div>
</div>
