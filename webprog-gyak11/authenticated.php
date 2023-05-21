Authenticated as:

<?php
include 'util.php';

session_start();
print_r($_SESSION['user']);
$user = $_SESSION['user'];
?>

<?php
if (in_array('user', $user['roles'])) :
?>
<button>User button</button>
<?php
endif;
?>

<?php
if (in_array('admin', $user['roles'])) :
    ?>
    <button>Admin button</button>
<?php
endif;
?>

<form action="" method="post">
    <input name="logout" hidden />
    <button type="submit">Logout</button>
</form>
<?php
if (isset($_POST["logout"])) {
    unset($_SESSION["user"]);
    redirect('login.php');
}

