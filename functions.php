<?php


function get_user_by_email ($email)
{  // функция проверяет есть ли в бд  емаил который пришел в функцию с формы - возвр-ет массив

    require "confDB.php";

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(["email"=>$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user;


}


function add_user ($email, $password)
{    // добавляем пользователя в бд (емаил  и пароль) -  возвращает id пользователя
    require "confDB.php";

    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        [
            "email"=>$email,
            "password"=>password_hash($password,PASSWORD_DEFAULT )
        ]
    );
    return $pdo->lastInsertId();


}


function set_flesh_message ($name, $message)
{
    $_SESSION[$name] = $message;
}


function display_flesh_message ($name)
{
    if (isset($_SESSION[$name])) {
        echo "<div class=\"alert alert-{$name} text-dark\" role=\"alert\">{$_SESSION[$name]}</div>";
        unset($_SESSION[$name]);
    }
}


function redirect_to ($path){
    header('Location:' . $path);
}




function login ($email, $password) {
    require "confDB.php";
    $user = get_user_by_email($email);

    if (!empty($user)) {
        if (password_verify($password, $user['password'])){
            set_flesh_message('succes', 'Вы авторизовались');
            $_SESSION['login'] = $email;
            return true;
        }
    }
    set_flesh_message('danger', 'Неверный логин или пароль');
    return false;

}

