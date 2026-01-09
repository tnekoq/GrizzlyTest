<?php

function clear($str)
{
    $str = trim($str);
    $str = strip_tags($str);
    $str = stripslashes($str);
    return $str;
}

$errorContainer = [];

$name = isset($_POST['name']) ? clear($_POST['name']) : '';
$surname = isset($_POST['surname']) ? clear($_POST['surname']) : '';
$patronymic = isset($_POST['patronymic']) ? clear($_POST['patronymic']) : '';
$date = isset($_POST['date']) ? clear($_POST['date']) : '';
$email = isset($_POST['email']) ? clear($_POST['email']) : '';
$phoneCode = isset($_POST['phoneCode']) ? clear($_POST['phoneCode']) : '';
$phoneNumber = isset($_POST['phone']) ? clear($_POST['phone']) : '';
$phone = ($phoneNumber !== '') ? $phoneCode . $phoneNumber : '';
$maritalStatus = isset($_POST['maritalStatus']) ? clear($_POST['maritalStatus']) : '';
$about = isset($_POST['about']) ? clear($_POST['about']) : '';

$regexpName = '/^[а-яёА-ЯЁa-zA-Z]{2,}$/u';
$regexpPhoneBY = '/^[0-9]{7}$/';
$regexpPhoneRU = '/^[0-9]{10}$/';
$regexpEmail = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

if (isset($_POST['name']) && !preg_match($regexpName, $name)) {
    $errorContainer['name'] = "Должно быть минимум 2 буквы.";
}
if (isset($_POST['surname']) && !preg_match($regexpName, $surname)) {
    $errorContainer['surname'] = "Должно быть минимум 2 буквы.";
}
if (isset($_POST['patronymic']) && $patronymic !== '' && !preg_match($regexpName, $patronymic)) {
    $errorContainer['patronymic'] = "Должно быть минимум 2 буквы.";
}

if (isset($_POST['date']) && !empty($date)) {
    $dateObj = new DateTime($date);
    $now = new DateTime();
    if ($dateObj > $now) {
        $errorContainer['date'] = "В будущее нельзя, давно фильм \"Эффект бабочки\" не пересматривали?";
    }
}
if (!empty($phoneNumber)) {
    if ($phoneCode === "+375" && !preg_match($regexpPhoneBY, $phoneNumber)) {
        $errorContainer['phone'] = "Нужно ровно 7 цифр";
    }
    if ($phoneCode === "+7" && !preg_match($regexpPhoneRU, $phoneNumber)) {
        $errorContainer['phone'] = "Нужно ровно 10 цифр";
    }
}

if (isset($_POST['email']) && !empty($email)) {
    if (!preg_match($regexpEmail, $email)) {
        $errorContainer['email'] = "Неверный формат почты";
    }
}

if ((isset($_POST['phone']) || isset($_POST['email'])) && empty($phoneNumber) && empty($email)) {
    $errorContainer['phoneNotEmail'] = "Заполните Телефон или Email";
}