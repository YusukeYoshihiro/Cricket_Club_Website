<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

include('./config/db_connect.php');

// whenever it's loaded it shows empty value
$name = $email = $title = $msg ='';
// if submit button pressed all array variable updated
$errors = array('name' => '', 'email'=> '', 'title'=>'', 'msg'=>'');

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
    echo 'Please fill out this form!';
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
    echo '<p style="border: 2px solid var(--golden-color); width: 80%; text-align: center;">Thank you for your message. It has been sent successfully.
    <br> A representative from WVCC will contact you shortly.</p>';

}else{
    // error
    // echo 'Query error' . mysqli_error($conn);
    echo '<p style="text-align: center;">Please fill out this form!</p>';
}
}
// XSS(Cross Site Scripting)


?>
