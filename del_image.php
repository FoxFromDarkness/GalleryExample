<?php
    include_once("db.php");

    if(!isset($_GET['id'])) {
        header("Location: index.php");
    } else {
        $id = $_GET['id'];
        $sql = "DELETE FROM images WHERE id=$id";
        mysqli_query($db, $sql);
        header("Location: index.php");
    }
?>