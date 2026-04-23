<?php
if (!isset($_SESSION)) {
    session_start();
}

include('../dbConnection.php');

// Ensure admin is logged in
if (!isset($_SESSION['adminLogEmail'])) {
    exit("Please log in to search.");
}

 $adminEmail = $_SESSION['adminLogEmail'];

// Default query (show all transactions of logged in student)
$sql = "SELECT * FROM courseorder";

// If search provided and not empty → add filter
if (isset($_POST['query']) && trim($_POST['query']) !== "") {
    $search = mysqli_real_escape_string($conn, $_POST['query']);
    $sql .= " WHERE stu_email LIKE '%$search%'";
}

// Add ordering to the query write here because not after order by - where %search%
$sql .= " ORDER BY order_date DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table table-bordered table-striped table-hover text-center'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Order ID</th>
                        <th>Stu Email</th>
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Amount</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                    <td>{$row['order_id']}</td>
                    <td>{$row['stu_email']}</td>
                    <td>{$row['course_id']}</td>
                    <td>{$row['course_name']}</td>
                    <td>{$row['amount']}</td>
                    <td>{$row['order_date']}</td>
                  </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p class='text-center'>No matching courses found.</p>";
}
?>