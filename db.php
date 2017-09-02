<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname ="myform";
$name ="";
$surname="";
$id=0;
$edit_state =false;

$conn = mysqli_connect($servername, $username, $password,$dbname);
if (isset($_POST['submit'])) {
    $name =$_POST['name'];
    $surname=$_POST['surname'];
    $sql = "insert into student (name,surname) values ('$name','$surname')";
    if (mysqli_query($conn,$sql)) {
        $_SESSION['message'] = "Data saved";
    } else {
        echo "Data isn't saved";
    }
    header('location: index.php');
}

if (isset($_POST['update'])) {
    $name =$_POST['name'];
    $surname =$_POST['surname'];
    $id =$_POST['id'];
    mysqli_query($conn,"Update student SET name ='$name',surname='$surname' WHERE id=$id");
    $_SESSION['message']="Data updated";
    header('location: index.php');
}
if (isset($_GET['del'])) {
    $id=$_GET['del'];
    if ( mysqli_query($conn,"delete  from student WHERE id=$id"))  {
        $_SESSION['message']="Data deleted";
    }
  else {
        echo "Data isn't deleted";
  }

    header('location: index.php');
}



  ?>