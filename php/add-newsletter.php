<?php 
// connect to database again

include('./config/db_connect.php');

// whenever it's loaded it shows empty value
$name = $email ='';
// if submit button pressed all array variable updated
$errors = array('name' => '', 'email'=> '');

// global array variable
// ehenever the submit button is pressed, condition check
// if(isset($_POST['submit']))
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


if(array_filter($errors)){
    // echo 'error is the form';
}else{
// import ino ou database
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);

// create sql
$sql = "INSERT INTO newsletter(name, email) VALUES ('$name', '$email')";


// save to db and check
if(mysqli_query($conn, $sql)){
    // successful
    header('Location:index-newsletter.php');
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
include ('./templates/header-newsletter.php');
?>
<section class="container grey-text">
<h4 class="center">Add newsletter user</h4>

<!-- form -->
<form action="add-newsletter.php" class="white" method="POST">
<label> Your Name</label>
<input type="text" name="name">
<label> Your Email</label>
<input type="email" name="email">
<div class="center">
<input type="submit"  class="btn brand z-depth-0" name="submit" value="submit"></div>
</form>
</section>
    <?php
    include ('./templates/footer.php') ?>
</body>
</html>