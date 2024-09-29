<?php

session_start();

if (empty($_SESSION['id_user'])) {
    header("Location: index.php");
    exit();
}

require_once("../db.php");

if (isset($_GET)) {

    $sql = "SELECT ug FROM users WHERE id_user='$_SESSION[id_user]'";
    $result1 = $conn->query($sql);

    if ($result1->num_rows > 0) {
        $row1 = $result1->fetch_assoc();
        $ug_marks = $row1['ug'];
    }

    $sql = "SELECT cgpa FROM job_post WHERE id_jobpost='$_GET[id]'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $eligibility = $row['cgpa'];

        if ($ug_marks >= $eligibility) {
            header("Location: ../view-job-post.php?id=$_GET[id]");
            $_SESSION['status'] = "You are eligible for this drive, apply if you are interested.";
            $_SESSION['status_code'] = "success";
            exit();
        } else {
            header("Location: ../view-job-post.php?id=$_GET[id]");
            $_SESSION['status'] = "You are not eligible for this drive due to the overall percentage criteria. Update your marks in your profile if you think you are eligible.";
            $_SESSION['status_code'] = "success";
            exit();
        }
    }
}

?>
