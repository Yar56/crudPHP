<?php
session_start();

require "functions.php";

//получаем данные с формы
$email_form = $_POST['email'];
$password_form = $_POST['password'];

//var_dump(get_user_by_email($email_form));

if (!empty(get_user_by_email($email_form))) {
    set_flesh_message('danger', "<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.");
    redirect_to('/page_register.php');
}

add_user($email_form, $password_form);
set_flesh_message('success', "Регистрация успешна");
redirect_to('/index.php');
