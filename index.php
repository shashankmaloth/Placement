<?php
session_start();
require_once("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    
    <?php include 'php/head.php'; ?>

    <style>
        #index-body {
            background: rgba(76, 175, 80, 0.3);
            background-image: url('assets/img/hero-carousel/2.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh; 
            margin: 0; 
            padding: 0; 
            display: flex;
            flex-direction: column;
            align-items: center; 
            justify-content: flex-start; 
        }

        #hero-animated {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%; 
            margin-top: 20px; 
        }

        #abc{
            height: 100%;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.6);
        }
    </style>

</head>
<body>
    <?php include 'php/header.php'; ?>
    <div id="index-body">
        <div id="abc">
            <section id="hero-animated" class="hero-animated">
                <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative" >
                <h2>Welcome to <span>GCET Placement Cell</span></h2>
                <div class="d-flex" style="background-color: #f57e20;">
                    <a href="login.php" class="btn-get-started scrollto">Login</a>
                </div>
            </div>
        </section>
        </div>
    </div>

    <!-- <?php include 'php/footer.php'; ?> -->
</body>
</html>
