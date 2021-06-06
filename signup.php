<?php 
require "db.php";

$data = $_POST;
if(isset($data['do_signup']) ){
    // здесь регистрируем

    $errors = array();
    if(trim($data['login']) == ''){
        $errors[] = 'Введите Логин!';
    }

    if(trim($data['email']) == ''){
        $errors[] = 'Введите Email!';
    }

    if($data['password'] == ''){
        $errors[] = 'Введите пароль!';
    }

    if($data['password_2'] != $data['password']){
        $errors[] = 'Повторный пароль введен не верно!';
    }

    //Проверка на повторных пользователей
    if( R::count('users', "login = ?", array($data['login'])) > 0 ){
        $errors[] = 'Пользователь с таким логином уже существует';
    }

    if( R::count('users', "email = ?", array($data['email'])) > 0 ){
        $errors[] = 'Такой Email уже занят';
    }


    if( empty($errors) )
    {
        $user = R::dispense('users');
        $user->login = $data['login'];
        $user->email = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        R::store($user);
        echo '<div style="color: green;">Вы успешно зарегистрированы!</div><hr>';
    } else 
    {
        echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
    }



}

?>



<form action="/signup.php" method="POST">
    <p>
        <p>Ваш логин</p>
        <input type="text" name="login" value="<?php echo @$data['login']; ?>">
    </p>

    <p>
        <p>Ваш Email</p>
        <input type="email" name="email" value="<?php echo @$data['email']; ?>">
    </p>

    <p>
    <p><strong>Ваш пароль</strong></p>
        <input type="password" name="password" value="<?php echo @$data['password']; ?>">
    </p>

    <p>
        <p><strong>Введите ваш пароль еще раз</strong>:</p>
        <input type="password" name="password_2" value="<?php echo @$data['password_2']; ?>">
    </p>

    <p>
        <button type="submit" name="do_signup">Зарегистрироваться</button>
    </p>

</form>