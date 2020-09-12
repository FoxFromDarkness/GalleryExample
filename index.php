<?php
  include_once("db.php");

  if (isset($_POST['upload'])) {
  	$image = $_FILES['image']['name'];
  	$target = "images/".basename($image);
  	$sql = "INSERT INTO images (image) VALUES ('$image')";

  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  }
  $result = mysqli_query($db, "SELECT * FROM images");
  $result2 = mysqli_query($db, "SELECT * FROM images");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Gallery</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Box Slider</h1>
    <div class="container">
        <div class="slider-wrapper">
            <div class="inner-wrapper">
                <?php
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<div class="slide"><img src="images/'.$row['image'].'"></div>';
                }?>
            </div>
        </div>
        <div class="button prev"></div>
        <div class="button next"></div>
    </div>
    <h1>Box Formularz</h1>
    <div id="content">
        <form method="POST" action="index.php" enctype="multipart/form-data">
            <input type="hidden" name="size" value="1000000">
            <div class="upload">
                <input type="file" name="image">
                <button type="submit" name="upload">Dodaj obraz</button>
            </div>
            <h1>Box Lista slide'ów</h1>
            <?php
            while ($row = mysqli_fetch_array($result2)) {
              echo "<div id='img_div'>";
              echo "<img src='images/".$row['image']."'>";
              echo $id = $row['id'];
              echo "<p>".$row['image']."</p>";
              echo "<a href='del_image.php?id=$id'>Delete</a>";
              echo "</div>";
            }?>
        </form>
    </div>
</body>
</html>

