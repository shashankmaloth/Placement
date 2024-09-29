<?php
session_start();

require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lname']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $contactno = mysqli_real_escape_string($conn, $_POST['contactno']);
    $stream = mysqli_real_escape_string($conn, $_POST['stream']);
    $passingyear = mysqli_real_escape_string($conn, $_POST['passingyear']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $aboutme = mysqli_real_escape_string($conn, $_POST['aboutme']);
    $skills = mysqli_real_escape_string($conn, $_POST['skills']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $password = base64_encode(strrev(md5($password)));

    $sql_check_email = "SELECT email FROM users WHERE email='$email'";
    $result_check_email = $conn->query($sql_check_email);

    if ($result_check_email->num_rows == 0) {
        $uploadOk = true;
        $folder_dir = "uploads/resume/";
        $base = basename($_FILES['resume']['name']);
        $resumeFileType = pathinfo($base, PATHINFO_EXTENSION);
        $file = uniqid() . "." . $resumeFileType;
        $filename = $folder_dir . $file;

        if (file_exists($_FILES['resume']['tmp_name'])) {
            if ($resumeFileType == "pdf" && $_FILES['resume']['size'] < 500000) { 
                move_uploaded_file($_FILES["resume"]["tmp_name"], $filename); 
            } else {
                $_SESSION['uploadError'] = "Wrong Format or Size. Only PDF files under 500KB allowed.";
                $uploadOk = false;
            }
        } else {
            $_SESSION['uploadError'] = "Something Went Wrong. File Not Uploaded. Try Again.";
            $uploadOk = false;
        }

        if ($uploadOk === false) {
            header("Location: register-candidates.php");
            exit();
        }

        $hash = md5(uniqid());

        $sql_insert = "INSERT INTO users (firstname, lastname, email, password, address, city, state, contactno, stream, passingyear, dob, age, resume, hash, aboutme, skills)
                       VALUES ('$firstname', '$lastname', '$email', '$password', '$address', '$city', '$state', '$contactno', '$stream', '$passingyear', '$dob', '$age', '$file', '$hash', '$aboutme', '$skills')";

        if ($conn->query($sql_insert) === TRUE) {
            $_SESSION['registerCompleted'] = true;
            header("Location: login-candidates.php");
            exit();
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    } else {
        $_SESSION['registerError'] = true;
        header("Location: register-candidates.php");
        exit();
    }

    $conn->close();

} else {
    header("Location: register-candidates.php");
    exit();
}
?>
