<?php

session_start();

if (empty($_SESSION['id_company'])) {
    header("Location: ../index.php");
    exit();
}

require_once("../db.php");

if (isset($_POST)) {

    $jobtitle = mysqli_real_escape_string($conn, $_POST['jobtitle']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $package = mysqli_real_escape_string($conn, $_POST['package']);
    $cgpa = mysqli_real_escape_string($conn, $_POST['cgpa']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
    $cdate = mysqli_real_escape_string($conn, $_POST['date']); 
    $stmt = $conn->prepare("INSERT INTO job_post(id_company, jobtitle, description, package, cgpa, role, qualification, drive_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("isssssss", $_SESSION['id_company'], $jobtitle, $description, $package, $cgpa, $role, $qualification, $cdate);

    if ($stmt->execute()) {
        $_SESSION['jobPostSuccess'] = true;
        include 'sendmail.php';
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();

    $conn->close();
} else {
    header("Location: create-job-post.php");
    exit();
}
