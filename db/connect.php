<?php
mysqli_report(MYSQLI_REPORT_OFF);
$your_hostname = "";
$your_user_name = "";
$your_password = "";
$your_db = "";

$link = mysqli_connect("$your_hostname", "$your_user_name", "$your_password", "$your_db");
if (!$link) {
    exit();
}
mysqli_set_charset($link, "utf8mb4");
