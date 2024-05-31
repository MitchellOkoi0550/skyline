<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $post_category = $_POST["floatingSelects"];
    $post_topic = $_POST["title"];
    $notes = $_POST["note"];
    $post_image = file_get_contents($_FILES["pictures"]["tmp_name"]);

    try {
        require_once "dbcon_inc.php";

        $query = "INSERT INTO my_post (post_category, post_topic, notes, post_image) VALUES (:floatingSelects, :title, :note, :pictures);";

        $stmt  = $pdo->prepare($query);

        $stmt->bindParam(":floatingSelects", $post_category);
        $stmt->bindParam(":title", $post_topic);
        $stmt->bindParam(":note", $notes);
        $stmt->bindParam(":pictures", $post_image, PDO::PARAM_LOB); // Use PDO::PARAM_LOB for BLOB data

        $stmt->execute();

        session_start();
        $_SESSION['success_message'] = "Record saved successfully.";

        $pdo = null;
        $stmt = null;

        header("Location: ../addpost.php"); 
        exit();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
else {
    header("Location: ../addpost.php");
    exit();
}
?>
