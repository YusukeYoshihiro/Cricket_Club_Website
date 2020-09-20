<?php 
include('./config/db_connect.php');

// Delete content
if(isset($_POST['delete'])){
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql = "DELETE FROM users WhERE id =$id_to_delete";

    if(mysqli_query($conn, $sql)){
        // success
        header('Location:index.php');
    }else{
        // failure
        echo 'query error:' . mysqli_error($conn);
    }
}



// Check GET request id param
if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // make sql
    $sql = "SELECT * FROM users WHERE id= $id";

    // get query result
    $result = mysqli_query($conn, $sql);


    // fetch result in array format

$user = mysqli_fetch_assoc($result);

mysqli_free_result($result);
mysqli_close($conn);

// print_r($user);
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include ('./templates/header.php');?>
<div class="ciontainer center">

<?php if($user): ?>

    <h4><?php echo htmlspecialchars($user['name']);?></h4>
<p>Created by: <?php echo htmlspecialchars($user['email']); ?></p>
<p><?php echo date($user['created_at']); ?></p>
<h5>Message:</h5>
<p><?php echo htmlspecialchars($user['msg']) ?></p>

<!-- DELETE FORM -->
<form action="details.php" method="POST">
    <input type="hidden" name="id_to_delete" value="<?php echo $user['id'] ?>">
<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0"> 


</form>




<?php else: ?>
    <h5>No such user exists</h5>
<?php endif; ?>
</div>
<?php include ('./templates/footer.php');?>
</html>