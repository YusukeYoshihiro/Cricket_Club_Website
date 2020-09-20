<?php 
// connect to database again

include('./config/db_connect.php');

// whenever it's loaded it shows empty value
$name = $email = $title = $msg ='';
// if submit button pressed all array variable updated
$errors = array('name' => '', 'email'=> '', 'title'=>'', 'msg'=>'');

// global array variable
// ehenever the submit button is pressed, condition check
if(isset($_POST['submit']))
// echo htmlspecialchars($_POST['email']);
// echo htmlspecialchars($_POST['title']);
// echo htmlspecialchars($_POST['content']);

// check name
if(empty($_POST['name'])){
    $errors['name'] = 'Name is required <br>';
}else{
    $name = $_POST['name'];
}

// check email
if(empty($_POST['email'])){
   
    $errors['email']='An email is required <br>';
}else{
    $email = $_POST['email'];
    // builtin email validation
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        // echo 'email must be a vaild email address';
        $errors['email']='An email must be a valid address'; 
    }
}
// check title
if(empty($_POST['title'])){
    // echo 'An title is required <br>';
    $errors['title']='An title is required <br>';
}else{
    $title = $_POST['title'];
//    Regular Expression:Regex
    if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
        // echo 'Title must be letters and space only ';
        $errors['title']='Title must be letters and spaces only';
    }
}

// check content
if(empty($_POST['msg'])){
    // echo 'An content is required <br>';
    $errors['msg']='An content is required <br>';
}else{
    $msg = $_POST['msg'];
//    Regular Expression:Regex
    if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $msg)){
        // echo 'Content must be comma separated ';
        $errors['msg']='Content must be comma separated';
    }
}
if(array_filter($errors)){
    // echo 'error is the form';
}else{
// import ino ou database
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$title = mysqli_real_escape_string($conn, $_POST['title']);
$msg = mysqli_real_escape_string($conn, $_POST['msg']);

// create sql
$sql = "INSERT INTO users(name, email, title, msg) VALUES ('$name', '$email', '$title', '$msg')";


// save to db and check
if(mysqli_query($conn, $sql)){
    // successful
    header('Location:index.php');
}else{
    // error
    echo 'Query error' . mysqli_error($conn);
}
}
// XSS(Cross Site Scripting)
?>





<!DOCTYPE html>
<html lang="en">
<?php 
include ('./templates/header.php');
?>
<section class="container grey-text">
<h4 class="center">Add an element</h4>

<!-- form -->
<form action="add.php" class="white" method="POST">
<label> Your Name</label>
<input type="text" name="name">
<label> Your Email</label>
<input type="email" name="email">
<label> Title</label>
<input type="text" name="title">
<label> Content(Comma Separated)</label>
<input type="text" name="msg">
<div class="center">
<input type="submit"  class="btn brand z-depth-0" name="submit" value="submit"></div>
</form>
</section>
    <?php
    include ('./templates/footer.php') ?>
</body>
</html>