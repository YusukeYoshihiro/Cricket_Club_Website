<?php 
// Connect to database
// MySQLi or PDO
include('./config/db_connect.php');

// write query for all data
$sql ='SELECT id, name, email FROM newsletter ORDER BY created_at';

// make query and get result
$result = mysqli_query($conn, $sql);

// fetch the resulting rows as an array
$newsletter = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
<?php include('./templates/header-newsletter.php') ?>

<h4 class="center grey-text">Newsletter User</h4>
<div class="container">
<div class="row">
    <!-- start of for each -->
<?php foreach ($newsletter as $newsletters): ?>

<div class="col s6 md3">
<div class="card z-depth-0">
<div class="card-content center">
<h6><?php  echo htmlspecialchars($newsletters['name']);?></h6>

<!-- separate by comma -->
<!-- start of for each -->
<ul><?php foreach(explode(',', $newsletters['email']) as $con): ?>
<li><?php echo htmlspecialchars($con); ?></li>
<!-- end of foreach -->
<?php endforeach; ?>
</ul>


</div>
<div class="card-action right-align">

<!-- Adding hyperlink -->
<a class="brand-text" href="details-newsletter.php?id=<?php echo $newsletters['id'] ?>">more info</a></div>

</div>
</div>

<?php endforeach; ?> <!-- end of foreach -->

<!-- <?php if(count($newsletters) >= 3): ?> -->
<!-- <p>There are two or more contents.</p> -->
<?php  else:  ?>
<!-- <p>There are less than two contents</p> -->
<?php endif;?>

</div>
</div>

<?php include('./templates/footer.php') ?>

</body>

</html>