<?php
if (!isset($_GET['course_id'])) {
    header("Location: courses.php");
    exit;
}
$courseId = $_GET['course_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payment Failed</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background: #fff5f5;
            font-family: Arial, sans-serif;
        }
        .fail-box {
            max-width: 400px;
            background: #fff;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            margin: auto;
            margin-top: 10%;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }
        .circle {
            width: 100px;
            height: 100px;
            margin: auto;
            border-radius: 50%;
            background: #dc3545;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 50px;
            animation: shake 0.8s ease-in-out infinite alternate;
        }
        .progress {
            height: 8px;
            margin-top: 25px;
            border-radius: 20px;
            overflow: hidden;
        }
        .progress-bar {
            animation: load 3s linear forwards;
        }
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }
        @keyframes load {
            from {width: 0%;}
            to {width: 100%;}
        }
        @keyframes shake {
            0% { transform: rotate(-5deg); }
            100% { transform: rotate(5deg); }
        }
    </style>
</head>

<body>
    <div class="fail-box">
        <div class="circle">
            ✕
        </div>
        <h2 class="text-danger mt-3">Payment Failed!</h2>
        <p class="text-muted">Redirecting you back to coursedetails page...</p>
        <div class="progress">
            <div class="progress-bar bg-danger"></div>
        </div>
    </div>

    <script>
        $(function () {
            setTimeout(function () {
                window.location.href = "coursedetails.php?course_id=<?php echo $courseId; ?>";
            }, 3500);
        });
    </script>
</body>

</html>
