<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

include('./config/db_connect.php');

// whenever it's loaded it shows empty value
$name = $email ='';
// if submit button pressed all array variable updated
$errors = array('name' => '', 'email'=> '');

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
    echo 'Please fill out this form!' ;
}else{
// import ino ou database
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);

// create sql
$sql = "INSERT INTO newsletter(name, email) VALUES ('$name', '$email')";


// save to db and check
if(mysqli_query($conn, $sql)){
    // successful
    echo '<p style="border: 2px solid var(--golden-color);; margin: 0 auto; text-align: center;">Thank you!</p>';

}else{
    // error
    // echo 'Query error' . mysqli_error($conn);
    echo 'Please fill out this form!';
}
}
// XSS(Cross Site Scripting)


?>