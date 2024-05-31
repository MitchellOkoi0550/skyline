<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_id"])) {
    $delete_id = $_POST["delete_id"]; // Assuming you're passing the ID of the record to delete

    echo "<script>";
    echo "if(confirm('Are you sure you want to delete this record?')) {";
    echo "  window.location.href = 'postdelete_inc.php?delete_id=$delete_id';";
    echo "} else {";
    echo "  window.location.href = '../viewposts.php';";
    echo "}";
    echo "</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete_id"])) {
    $delete_id = $_GET["delete_id"]; // Assuming you're passing the ID of the record to delete

    try {
        require_once "dbcon_inc.php"; // Include your database connection file

        $query = "DELETE FROM my_post WHERE post_id = :post_id"; // Assuming your table has a column named 'id' as the primary key

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":post_id", $delete_id);
        $stmt->execute();

        session_start();
        $_SESSION['success_message'] = "Record deleted successfully.";

        $pdo = null;
        $stmt = null;

        header("Location: ../viewposts.php"); // Redirect to the page where you want to go after deletion
        exit();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../viewposts.php"); // Redirect if the delete request is not sent via GET
    exit();
}

?>
