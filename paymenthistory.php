<?php
// use for page title and extra CSS/JS dynamic for specific page 
$page_title = "Payment History";
// $extra_css = ["../css/payment.css"];  
//$extra_js = ["./js/feedbacksliding.js"];  

include('./mainInclude/header.php');
include_once('./dbConnection.php'); // Add this line here by jeel  
?>
<div class="container my-4">
    <h2 class="text-center">Payment History</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <input type="text" id="courseSearch" class="form-control" style="border-radius: 18px;"
                placeholder="search course name...">
        </div>
    </div>

    <div class="mt-4" id="searchResults"></div>

    <div class="text-center mb-3">
        <button class="btn btn-success print-btn" style="display:none;" onclick="window.print()">Print Table</button>
    </div>
</div>

<script>
$(document).ready(function () {

    // Function to fetch and display results
    function fetchResults(query = "") {
        $.ajax({
            url: "orderlistsearch.php",
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
<?php include('./mainInclude/footer.php'); ?>
<!-- end footer, sturegister, stulogin, adminlogin section -->