<?php

session_start();

if (empty($_SESSION['id_jobpost'])) {
    header("Location: index.php");
    exit();
}

require_once("../db.php");

if (isset($_POST['submit'])) {


    $companyname = mysqli_real_escape_string($conn, $_POST['companyname']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $CTC = mysqli_real_escape_string($conn, $_POST['CTC']);
    $qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
    $Eligibility = mysqli_real_escape_string($conn, $_POST['Eligibility']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);


    $sql = "UPDATE job_post SET jobtitle='$companyname', role='$role', package='$CTC', qualification='$qualification', cgpa='$Eligibility',  description='$description' where id_jobpost='$_SESSION[id_jobpost] '";

    if ($conn->query($sql) === TRUE) {
        header("Location: active-jobs.php");
        exit();
    } else {
        echo "Error ";
        $conn->close();
    }
} else {
    header("Location: active-jobs.php");
    exit();

}
