<?php


session_start();

if (empty($_SESSION['id_admin'])) {
    header("Location: index.php");
    exit();
}
require_once("../db.php");

$sql = "select * from users  ";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        $sub = "New Notice has been posted.";
        $msg = "The TPO has posted a new notice on the placement portal. Go to your profile on placement portal to check the notice.";
        $str = $row['email'];
        $rec = "$str";
        mail($rec, $sub, $msg);
    }
}
