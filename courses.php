<!-- when do any update here update search_course.php also -->
<?php
// use for page title and extra CSS/JS dynamic for spacific page
$page_title = "Courses";
// $extra_css = ["../css/payment.css"];
$extra_js = ["./js/clearsearchfilter.js"];

include('./mainInclude/header.php');
include('./dbConnection.php');  // Add this line here by jeel
?>

<!-- start searchbar -->
<div class="container mt-2 mb-3">
  <div class="row">
    <div class="col-md-6 offset-md-3 mt-4">
      <div class="position-relative" style="margin-left:65px;">
        <input type="text" id="search" class="form-control pr-5" placeholder="Search courses..."
          style="border-radius: 18px;"
          value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <span id="clear-search"
          style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer; display : none; color: #888; font-size: 18px;">
          <i class="fa-regular fa-circle-xmark"></i>
        </span>
      </div>
    </div>
  </div>
</div>
<!-- end searchbar -->

<!-- start most all courses section -->
<div class="container-fluid">
  <div class="row">

    <!-- Filter Column -->
    <div class="p-0">
      <div class="bg-light p-1 pl-3 border-end position-fixed"
        style="top:70px; bottom:0; width:225px; overflow-y:auto; height:calc(100vh - 70px);">
        <h5>Filters</h5>

        <!-- Category (checkbox) auto add -->
        <p class="fw-bold mt-3 mb-1">Category</p>
        <?php
        $sql = "SELECT DISTINCT course_category 
                FROM course 
                ORDER BY course_id DESC 
                LIMIT 5"; // fetch only last 5
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $cat = htmlspecialchars($row['course_category']);
            echo '<label style="display:block; margin-bottom:0px; font-weight:normal;">
            <input type="checkbox" name="category[]" value="' . $cat . '" style="margin-right:6px; vertical-align:middle;">
            ' . $cat . '
          </label>';
          }
        }
        ?>

        <!-- Price (radio) -->
        <p class="fw-bold mt-3 mb-1">Price</p>
        <div><input type="radio" name="price" value="" checked> All Prices</div>
        <div><input type="radio" name="price" value="0-1000"> Less than ₹1000</div>
        <div><input type="radio" name="price" value="1001-2000"> ₹1001 - ₹2000</div>
        <div><input type="radio" name="price" value="2001+"> ₹2001 and above</div>

        <!-- Duration (radio) -->
        <p class="fw-bold mt-3 mb-1">Duration</p>
        <div><input type="radio" name="duration" value="" checked> All Durations</div>
        <div><input type="radio" name="duration" value="0-3"> Less than 3 hours</div>
        <div><input type="radio" name="duration" value="4-8"> 4 - 8 hours</div>
        <div><input type="radio" name="duration" value="8+"> More than 8 hours</div>

        <div class="d-flex mt-3">
          <button id="clear-filters" type="button" class="btn btn-sm btn-outline-dark flex-fill mr-2">Clear</button>
          <button id="apply-filters" type="button" class="btn btn-sm btn-dark flex-fill">Apply</button>
        </div>
      </div>
    </div>

    <!-- Your Original Card Section -->

    <div class="col-sm-10 pl-2 mr-0 d-flex justify-content-center" style="margin-left:225px;">
      <div class="row" id="course-list" style="max-width:1200px; width:100%;">
        <?php
        $sql = "SELECT * FROM course ORDER BY course_id DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $course_id = $row['course_id'];
            echo '
              <div class="col-sm-4 mb-4">
                <a href="coursedetails.php?course_id=' . $course_id . '" class="btn" style="text-align: left; padding:0px;">
                  <div class="card course-card">
                    <div style="height:200px;">
                      <img src="' . str_replace('..', '.', $row['course_img']) . '" class="card-img-top" alt="course" style="height:200px; width:100%; object-fit:cover; object-position:center;">
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">' . $row['course_name'] . '</h5>
                      <p class="card-text">Duration :- ' . $row['course_duration'] . ' Hours</p>
                      <p class="card-title">Category :- ' . $row['course_category'] . '</p>
                    </div>
                  <div class="card-footer">
                    <p class="card-text d-inline">Price:<small><del>&#8377 ' . $row['course_original_price'] . '</del></small><span class="font-weight-bolder">&#8377 ' . $row['course_price'] . '</span></p>';

            // original code
            // <a href="coursedetails.php?course_id=' . $course_id . '" class="btn btn-primary text-white font-weight-bolder float-right">Enroll</a>
            // ✅ Only change here
            if (isset($_SESSION['is_admin_login'])) {
              // Admin always sees Enrolled
              echo '<a href="coursedetails.php?course_id=' . $course_id . '" class="btn btn-info font-weight-bolder float-right">Check Details</a>';

            } elseif (isset($_SESSION['is_login'])) {
              $stuEmail = $_SESSION['stuLogEmail'];
              $checkOrder = "SELECT * FROM courseorder WHERE course_id = $course_id AND stu_email = '$stuEmail'";
              $orderResult = $conn->query($checkOrder);

              if ($orderResult->num_rows > 0) {
                // Purchased
                echo '<a href="coursedetails.php?course_id=' . $course_id . '" class="btn btn-success font-weight-bolder float-right">Enrolled</a>';
              } else {
                // Logged in but not purchased
                echo '<a href="coursedetails.php?course_id=' . $course_id . '" class="btn btn-dark font-weight-bolder float-right">Enroll</a>';
              }

            } else {
              // Not logged in
              echo '<a href="coursedetails.php?course_id=' . $course_id . '" class="btn btn-dark font-weight-bolder float-right">Enroll</a>';
            }
            echo '</div>
                </div>
              </a>
            </div>';
          }
        }
        ?>
      </div>
    </div>

  </div>
</div>
<!-- end most all courses section -->

<!-- start footer -->
<?php
include('./mainInclude/footer.php');
?>
<!-- end footer -->