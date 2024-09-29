<?php
session_start();

if (empty($_SESSION['id_user'])) {
    header("Location: ../index.php");
    exit();
}

require_once("../db.php");

if (isset($_POST)) {

    $firstname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lname']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $contactno = mysqli_real_escape_string($conn, $_POST['contactno']);
    $stream = mysqli_real_escape_string($conn, $_POST['stream']);
    $skills = mysqli_real_escape_string($conn, $_POST['skills']);
    $aboutme = mysqli_real_escape_string($conn, $_POST['aboutme']);
    $Hsc = mysqli_real_escape_string($conn, $_POST['hsc']);
    $Ssc = mysqli_real_escape_string($conn, $_POST['ssc']);
    $UG = mysqli_real_escape_string($conn, $_POST['ug']);

    $uploadOk = true;
    $file = ''; 

    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        $folder_dir = "../uploads/resume/";
        $base = basename($_FILES['resume']['name']);
        $resumeFileType = pathinfo($base, PATHINFO_EXTENSION);
        $file = uniqid() . "." . $resumeFileType;
        $filename = $folder_dir . $file;

        if ($resumeFileType == "pdf") {
            if ($_FILES['resume']['size'] < 500000) { 
                move_uploaded_file($_FILES["resume"]["tmp_name"], $filename);
            } else {
                $_SESSION['uploadError'] = "Wrong Size. Max Size Allowed : 5MB";
                header("Location: edit-profile.php");
                exit();
            }
        } else {
            $_SESSION['uploadError'] = "Wrong Format. Only PDF Allowed";
            header("Location: edit-profile.php");
            exit();
        }
    } else {
        $uploadOk = false;
    }

    $sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', address='$address', city='$city', state='$state', contactno='$contactno', stream='$stream', skills='$skills', aboutme='$aboutme', Hsc='$Hsc', Ssc='$Ssc', UG='$UG'";

    if ($uploadOk) {
        $sql .= ", resume='$file'";
    }

    $sql .= " WHERE id_user='$_SESSION[id_user]'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['name'] = $firstname . ' ' . $lastname;
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    header("Location: edit-profile.php");
    exit();
}
?>
