<?php
// Check if the post_id parameter is set in the URL
if(isset($_GET['post_id'])) {
    // Retrieve the post_id from the URL
    $post_id = $_GET['post_id'];

    // Assuming you're using PDO for database operations
    // Establish database connection
    $pdo = new PDO("mysql:host=localhost;dbname=skyline", "root", "");
    
    // Prepare and execute the SQL query to fetch the post details
    $stmt = $pdo->prepare("SELECT * FROM my_post WHERE post_ID = :post_id");
    $stmt->execute(['post_id' => $post_id]);
    
    // Fetch the post details
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
