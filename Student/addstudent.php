<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('../dbConnection.php');

// Check email availability
if (isset($_POST['checkemail']) && isset($_POST['stuemail'])) {
    $stuemail = $_POST['stuemail'];
    $sql = "SELECT stu_email FROM student WHERE stu_email = '$stuemail'";
    $result = $conn->query($sql);
    echo $result->num_rows; // return 0 or >0
    exit;
}

// Student signup
if (isset($_POST['stusignup']) && isset($_POST['stuname']) && isset($_POST['stuemail']) && isset($_POST['stupass'])) {
    $stuname = $_POST['stuname'];
    $stuemail = $_POST['stuemail'];
    $stupass = $_POST['stupass'];

    // Check again for existing email
    $sql = "SELECT stu_email FROM student WHERE stu_email = '$stuemail'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "Failed"; // already exists
    } else {
        $sql = "INSERT INTO student (stu_name, stu_email, stu_pass) 
                VALUES ('$stuname', '$stuemail', '$stupass')";
        if ($conn->query($sql) === TRUE) {
            // ✅ Auto-login after signup
            $_SESSION['is_login'] = true;
            $_SESSION['stuLogEmail'] = $stuemail;
            echo 1;
        } else {
            echo "Failed";
        }
    }
}

// Student login
if (isset($_POST['checkLogemail']) && isset($_POST['stuLogEmail']) && isset($_POST['stuLogPass'])) {
    $stuLogEmail = $_POST['stuLogEmail'];
    $stuLogPass = $_POST['stuLogPass'];

    $sql = "SELECT stu_email, stu_pass FROM student 
            WHERE stu_email = '$stuLogEmail' AND stu_pass = '$stuLogPass'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $_SESSION['is_login'] = true;
        $_SESSION['stuLogEmail'] = $stuLogEmail;
        echo 1;
    } else {
        echo 0;
    }
}
?>
