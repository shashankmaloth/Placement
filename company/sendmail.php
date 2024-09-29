<?php


session_start();

if (empty($_SESSION['id_company'])) {
    header("Location: ../index.php");
    exit();
}
require_once("../db.php");

$sql = "select * from users";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {


        $sub = "New Drive has been posted.";
        $msg = "Go to your profile on placement portal to check your eligibility and apply for the drive.";
        $str = $row['email'];
        $rec = "$str";
        mail($rec, $sub, $msg);
    }
}
