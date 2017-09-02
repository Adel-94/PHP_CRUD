<?php
include ('db.php');

if (isset($_GET['edit'])) {

    $id =$_GET['edit'];
    $edit_state=true;
    $sql_edit = "select * from student WHERE  id =$id";
    $updt=mysqli_query($conn,$sql_edit);
    if (count($updt ==1)) {
        $record = mysqli_fetch_array($updt);
        $name =$record['name'];
        $surname =$record['surname'];
    }
}

?>

<<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> My Form </title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<?php if(isset($_SESSION['message'])):  ?>
<div class="message">
    <?php
    echo $_SESSION['message'];
    unset($_SESSION['message']);
    ?>
    <?php endif  ?>

</div>
<?php
$sql_select ="select * from student";
$read = mysqli_query($conn,$sql_select);
?>

<table class="table">
    <thead>
    <tr>
        <th>Firstname</th>
        <th>Lastname</th>

    </tr>
    </thead>
    <tbody>
    <?php
    while ($row = mysqli_fetch_array($read)) { ?>

        <tr>
        <td> <?php echo $row['name']; ?>  </td>
        <td><?php echo $row['surname']; ?> </td>
       <td>
           <a href="index.php?edit=<?php echo $row['id']; ?>"> Edit</a>
       </td>
        <td>
            <a href="db.php?del=<?php echo $row['id']; ?>"> Delete</a>
        </td>
    </tr>
  <?php  }
    ?>


    </tbody>
</table>


<form action="db.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>" >
    <div class="form-group">
        <label>Name:</label>
        <input type="text" class="form-control"  name="name" value="<?php  echo $name; ?>">
    </div>
    <div class="form-group">
        <label>Surname:</label>
        <input type="text" class="form-control"  name="surname"value="<?php  echo $surname; ?>" >
    </div>
    <div class="form-group">
        <?php if ($edit_state == false): ?>
            <button type="submit" name="submit" class="btn btn-default">Submit</button>
        <?php else: ?>
        <button type="submit" name="update" class="btn btn-default">Update</button>
         <?php  endif ?>

    </div>

</form>

</body>
</html>