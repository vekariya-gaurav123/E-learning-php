<!-- when do any update here update search_course.php also -->
<?php
include('./dbConnection.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Collect filter inputs
$q = isset($_POST['query']) ? trim($_POST['query']) : '';
$categories = isset($_POST['categories']) && is_array($_POST['categories']) ? $_POST['categories'] : [];
$price = isset($_POST['price']) ? $_POST['price'] : '';
$duration = isset($_POST['duration']) ? $_POST['duration'] : '';

$sql = "SELECT * FROM course WHERE 1";

// Search filter
if ($q !== '') {
    $qEsc = $conn->real_escape_string($q);
    $sql .= " AND course_name LIKE '%$qEsc%'";
}

// Category filter
if (!empty($categories)) {
    $catsEsc = array_map([$conn, 'real_escape_string'], $categories);
    $sql .= " AND course_category IN ('" . implode("','", $catsEsc) . "')";
}

// Price filter
if (!empty($price)) {
    if ($price == "0-1000") {
        $sql .= " AND course_price <= 1000";
    } elseif ($price == "1001-2000") {
        $sql .= " AND course_price BETWEEN 1001 AND 2000";
    } elseif ($price == "2001+") {
        $sql .= " AND course_price >= 2001";
    }
}

// Duration filter
if (!empty($duration)) {
    if ($duration == "0-3") {
        $sql .= " AND course_duration <= 3";
    } elseif ($duration == "4-8") {
        $sql .= " AND course_duration BETWEEN 4 AND 8";
    } elseif ($duration == "8+") {
        $sql .= " AND course_duration > 8";
    }
}

$sql .= " ORDER BY course_id DESC";
$result = $conn->query($sql);

// Output courses
if ($result && $result->num_rows > 0) {
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
              <h5 class="card-title">' . htmlspecialchars($row['course_name']) . '</h5>
              <p class="card-text">Duration : ' . htmlspecialchars($row['course_duration']) . ' Hours</p>
              <p class="card-title">Category : ' . htmlspecialchars($row['course_category']) . '</p>
            </div>
            <div class="card-footer">
              <p class="card-text d-inline">Price:
                <small><del>&#8377; ' . $row['course_original_price'] . '</del></small>
                <span class="font-weight-bolder">&#8377; ' . $row['course_price'] . '</span>
              </p>';

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
        echo '
            </div>
          </div>
          </a>
        </div>';
    }
} else {
    echo '<div class="col-12 text-center"><p>No courses found matching your criteria.</p></div>';
}
?>