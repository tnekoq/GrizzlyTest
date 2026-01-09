<?php
session_start();
include "validation.php";
if (!empty($errorContainer)) {
    $_SESSION['errors'] = $errorContainer;
    $_SESSION['formData'] = $_POST;
    header("Location: /index.php");
    exit();
} else {
    require __DIR__ . "/../../db/connect.php";
    
    $formData = $_POST;
    
    $name = $formData['name'];
    $surname = $formData['surname'];
    $patronymic = $formData['patronymic'];
    $date = $formData['date'];
    $phone = $formData['phone'];
    $maritalStatus = $formData['maritalStatus'];
    $about = $formData['about'];

    $query = "INSERT INTO user(`name`,`surname`,`patronymic`,`date`,`phone`,`maritalStatus`,`about`) VALUES ('$name', '$surname', '$patronymic','$date','$phone','$maritalStatus','$about')";

    $result = mysqli_query($link, $query);

    if (!$result) {
        die("Ошибка БД: " . mysqli_error($link));
    }
    header("Location: /pages/success.php");
    exit();
}
