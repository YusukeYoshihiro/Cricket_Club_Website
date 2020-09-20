<?php 
// Connect to database
// MySQLi or PDO
include('./config/db_connect.php');

// write query for all data
$sql ='SELECT id, name, email, title, msg FROM users ORDER BY created_at';

// make query and get result
$result = mysqli_query($conn, $sql);

// fetch the resulting rows as an array
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result from memory
mysqli_free_result($result);

// close connection
mysqli_close($conn);

// print_r($users);

// separate data by comma
// print_r(explode(',', $users[0]['content']));

?>
<!DOCTYPE html>
<html lang="en">
<?php include('./templates/header.php') ?>

<h4 class="grey-text">Thank your for subscription</h4>

<?php include('./templates/footer.php') ?>

</body>

</html>