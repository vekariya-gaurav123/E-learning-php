<?php
include('./dbConnection.php');
session_start();

// add this for paymentgatway config of strip
require('stripe-config.php');

if (!isset($_SESSION['stuLogEmail'])) {
    echo "<script> location.href = './index.php'; </script>";
} else {
    $stuEmail = $_SESSION['stuLogEmail'];
    $courseName = "";
    $coursePrice = "";
    if (!isset($_SESSION['order_id'])) {
        $_SESSION['order_id'] = "ORDS" . rand(10000, 99999999);
    }
    $orderId = $_SESSION['order_id'];

    if (isset($_POST['course_id'])) {
        $courseId = $_POST['course_id'];

        $sql = "SELECT course_name, course_price, course_img FROM course WHERE course_id = '$courseId'";

        $result = $conn->query($sql);

        if ($result && $row = $result->fetch_assoc()) {
            $courseName = $row['course_name'];
            $coursePrice = $row['course_price'];
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="GENERATOR" content="Evrsoft First Page">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Boostrap CSS -->


        <!--Google font -->
        <link href="https://fonts.googleapis.com/css2?family=Ubantu:wgt@700&display=swap" rel="stylesheet">

        <!--Custom CSS-->
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <title>Checkout</title>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 offset-sm-3" style="border:3px solid black; padding:15px; border-radius:10px;">
                    <h3 class="mb-3 text-center" style="border-bottom:2px solid black; padding-bottom:7px;">Welcome to Learning Payment Page</h3>
                    <form method="post" action="">
                        <input type="text" name="course_id" value="<?php echo $courseId; ?>" hidden>
                        <div class="form-group row">
                            <label for="ORDER_ID" class="col-sm-4
                        col-form-label text-center">ORDER ID</label>
                            <div class="col-sm-8">
                                <input id="ORDER_ID" class="form-control" name="ORDER_ID" value="<?php echo $orderId; ?>"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="CUST_ID" class="col-sm-4
                col-form-label text-center">Student Email</label>
                            <div class="col-sm-8">
                                <input id="CUST_ID" class="form-control" tabindex="2" maxlength="12" size="12"
                                    name="CUST_ID" autocomplete="off" value="<?php if (isset($stuEmail)) {
                                        echo $stuEmail;
                                    } ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="COURSE_NAME" class="col-sm-4 col-form-label text-center">Course Name</label>
                            <div class="col-sm-8">
                                <input id="COURSE_NAME" class="form-control" type="text" name="COURSE_NAME" value="<?php if (isset($courseName))
                                    echo $courseName; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="AMOUNT" class="col-sm-4
            col-form-label text-center">Amount</label>
                            <div class="col-sm-8">
                                <input title="AMOUNT" class="form-control" tabindex="10" type="text" name="AMOUNT" value="&#8377; <?php if (isset($coursePrice))
                                    echo $coursePrice; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 text-center" >
                                <img src="<?php echo str_replace('..', '.', $row['course_img']) ?>" alt="course" class="card-img-top" style="height:auto; width:70%; object-fit:cover; object-position:center; border-radius:10px;"
                                    alt="Course Image"
                                    style="max-width: 100%; height: auto; border:1px solid #ccc; border-radius:8px;">
                            </div>
                        </div>
                        <div class="text-center">
                            <input value="Check out" name="checkout" id="checkout-button" type="button" class="btn
                btn-dark">
                            <a href="./courses.php" class="btn
                btn-outline-dark">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            var stripe = Stripe("<?php echo $Publishablekey; ?>");

            document.getElementById("checkout-button").addEventListener("click", function () {
                fetch("create-checkout-session.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({
                        order_id: document.getElementById("ORDER_ID").value,
                        course_id: "<?php echo $courseId; ?>",
                        course_name: "<?php echo $courseName; ?>",
                        amount: "<?php echo $coursePrice; ?>",
                        stu_email: "<?php echo $stuEmail; ?>"
                    })
                })
                    .then(response => response.json())
                    .then(session => stripe.redirectToCheckout({ sessionId: session.id }))
                    .catch(error => console.error("Error:", error));
            });
        </script>
    </body>

    </html>
    <?php
} // closing else
?>