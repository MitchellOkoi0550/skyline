<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_comment"])) {
    // Retrieve form data
    $post_id = $_POST["post_id"];
    $comment_author = $_POST["comment_author"];
    $comment_author_email = $_POST["comment_author_email"];
    $comment_content = $_POST["comment_content"];

    // Insert the comment into the database
    try {
        require_once "dbcon_inc.php";
        // Prepare the SQL statement
        $query = "INSERT INTO post_comments (post_id, comment_author, comment_author_email, comment_content) VALUES (:post_id, :comment_author, :comment_author_email, :comment_content);";
        // Bind parameters and execute the statement
        $stmt  = $pdo->prepare($query);

        $stmt->bindParam(":post_id", $post_id);
        $stmt->bindParam(":comment_author", $comment_author);
        $stmt->bindParam(":comment_author_email", $comment_author_email);
        $stmt->bindParam(":comment_content", $comment_content);

        $stmt->execute();

        $pdo = null;
        $stmt = null;

        header("Location: ../detail.php?post_id=$post_id"); 
        
        exit();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
else {
    header("Location: ../detail.php?post_id=$post_id");
    exit();
}
?>