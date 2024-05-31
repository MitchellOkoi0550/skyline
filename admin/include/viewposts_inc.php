<?php
require_once "include/dbcon_inc.php"; // Include your database connection file

// Define an array to hold the data
$posts = array();

try {
    $query = "SELECT * FROM my_post";
    $stmt = $pdo->query($query);

    // Fetch all records into the array
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = null; // Close the prepared statement
    $pdo = null; // Close the database connection
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>
