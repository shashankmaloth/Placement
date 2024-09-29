<?php

session_start();

if (empty($_SESSION['id_jobpost'])) {
    header("Location: ../index.php");
    exit();
}

require_once("../db.php");

if (isset($_POST['submit'])) {

    $companyname = trim(mysqli_real_escape_string($conn, $_POST['companyname']));
    $role = trim(mysqli_real_escape_string($conn, $_POST['role']));
    $CTC = trim(mysqli_real_escape_string($conn, $_POST['CTC']));
    $qualification = trim(mysqli_real_escape_string($conn, $_POST['qualification']));
    $Eligibility = trim(mysqli_real_escape_string($conn, $_POST['Eligibility']));
    $description = trim(mysqli_real_escape_string($conn, $_POST['description']));
    $drive_date = trim(mysqli_real_escape_string($conn, $_POST['drive_date']));

    $sql = "UPDATE job_post SET jobtitle=?, role=?, package=?, qualification=?, cgpa=?, description=?, drive_date=? WHERE id_jobpost=?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssssi", $companyname, $role, $CTC, $qualification, $Eligibility, $description, $drive_date, $_SESSION['id_jobpost']);
        
        if ($stmt->execute()) {
            header("Location: my-job-post.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
    header("Location: updatedrive.php");
    exit();
}
?>
