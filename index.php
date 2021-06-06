<?php 
require "db.php";
?>

<?php if(isset($_SESSION['logged_user']) ) : ?>
    Авторизован!<br>
    Привет, <?php echo $_SESSION['logged_user']->login; ?>
    <hr>
    <a href="/logout.php">Выйти</a>
<?php else: ?>
<a href="/signup.php">Регистрация</a><br>
<a href="/login.php">Авторизация</a>
<?php endif; ?>