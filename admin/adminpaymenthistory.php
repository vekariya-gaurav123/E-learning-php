<?php
// use for page title and extra CSS/JS dynamic for specific page 
$page_title = "Admin Payment History";
// $extra_css = ["../css/payment.css"];  
//$extra_js = ["./js/feedbacksliding.js"];  

include('./admininclude/header.php');
include_once('../dbConnection.php'); // Add this line here by jeel  

if (isset($_SESSION['is_admin_login'])) {
    $adminEmail = $_SESSION['adminLogEmail'];
} else {
    echo "<script> location.href='../index.php';</script>";
    exit;
}
?>

<div class="col-sm-10 offset-md-2 my-4">
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header text-white text-center"
            style="background: linear-gradient(135deg, #28a745, #218838); border-radius: 10px 10px 0 0;">
            <h4 class="mb-0"><i class="fas fa-credit-card me-2"></i>Payment History</h4>
        </div>
        <div class="card-body">

            <!-- Search Bar -->
            <div class="row justify-content-center">
                <div class="col-md-6 d-flex flex-row">
                    <label for="courseSearch" class="form-label fw-bold mt-2 mr-2">
                        <i class='fas fa-search me-2 text-success'></i>
                    </label>
                    <input type="text" id="courseSearch" class="form-control" style="border-radius: 18px;"
                        placeholder="Search Student Email...">
                </div>
            </div>

            <!-- Search Results -->
            <div class="mt-4" id="searchResults"></div>

            <!-- Print Button -->
            <div class="text-center mt-4">
                <button class="btn btn-success print-btn px-4" style="display:none; border-radius: 25px;"
                    onclick="window.print()">
                    <i class="fas fa-print me-2"></i> Print Table
                </button>
            </div>

        </div>
    </div>
</div>

</div> <!-- div row close from header -->
</div> <!-- div container-fluid close from header -->

<script>
$(document).ready(function () {

    // Function to fetch and display results
    function fetchResults(query = "") {
        $.ajax({
            url: "adminorderlistsearch.php",
            method: "POST",
            data: { query: query },
            success: function (data) {
                $("#searchResults").html(data);
                // Show print button only if results exist
                if ($("#searchResults table tbody tr").length > 0) {
                    $(".print-btn").show();
                } else {
                    $(".print-btn").hide();
                }
            }
        });
    }

    // Load all transactions on page load
    fetchResults();

    // Fetch when typing in search box
    $("#courseSearch").keyup(function () {
        let query = $(this).val();
        fetchResults(query);
    });
});
</script>

<!-- start footer, sturegister, stulogin, adminlogin section -->
<?php include('./admininclude/footer.php'); ?>
<!-- end footer, sturegister, stulogin, adminlogin section -->