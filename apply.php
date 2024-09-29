<?php

session_start();

if (empty($_SESSION['id_user'])) {
    header("Location: index.php");
    exit();
}

require_once("db.php");

if (isset($_GET['id'])) {

    $stmt = $conn->prepare("SELECT * FROM users WHERE id_user = ?");
    $stmt->bind_param("i", $_SESSION['id_user']);
    $stmt->execute();
    $result1 = $stmt->get_result();

    if ($result1->num_rows > 0) {
        $row1 = $result1->fetch_assoc();
        $sum = (int)$row1['ug'];
        $total = $sum;
        $course1 = $row1['qualification'];
    }

    $stmt->close();

    $stmt = $conn->prepare("SELECT cgpa, qualification FROM job_post WHERE id_jobpost = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $eligibility = $row['cgpa'];
        $course2 = $row['qualification'];
    }

    $stmt->close();

    if ($total >= $eligibility ) {
        $stmt = $conn->prepare("SELECT * FROM apply_job_post WHERE id_user = ? AND id_jobpost = ?");
        $stmt->bind_param("ii", $_SESSION['id_user'], $_GET['id']);
        $stmt->execute();
        $result1 = $stmt->get_result();

        if ($result1->num_rows == 0) {
            $stmt->close();
            $stmt = $conn->prepare("SELECT id_company FROM job_post WHERE id_jobpost = ?");
            $stmt->bind_param("i", $_GET['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $id_company = $row['id_company'];

            $stmt->close();
            $stmt = $conn->prepare("INSERT INTO apply_job_post (id_jobpost, id_company, id_user) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $_GET['id'], $id_company, $_SESSION['id_user']);
            if ($stmt->execute()) {
                $_SESSION['jobApplySuccess'] = true;
                $_SESSION['status1'] = "Congrats!";
                $_SESSION['status_code1'] = "success";
                header("Location: user/index.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            $_SESSION['status'] = "You have already applied for this Drive.";
            $_SESSION['status_code'] = "success";
            header("Location: view-job-post.php?id=" . $_GET['id']);
            exit();
        }
    } else {
        $_SESSION['status'] = "You are not eligible for this drive.";
        if ($total < $eligibility) {
            $_SESSION['status'] .= " Update your marks in your profile if you think you are eligible.";
        } else {
            $_SESSION['status'] .= " due to the course criteria.";
        }
        $_SESSION['status_code'] = "success";
        header("Location: view-job-post.php?id=" . $_GET['id']);
        exit();
    }

} else {
    header("Location: user/index.php");
}

?>
