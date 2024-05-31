<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $client_name = $_POST["clientname"];
    $client_position = $_POST["clientposition"];
    $client_comment = $_POST["clientcomment"];
    $client_image = $_POST["clientimage"];

    try {
        require_once "dbcon_inc.php";

        $query = "INSERT INTO clients (client_name, client_position, client_comment, client_image) VALUES (:clientname, :clientposition, :clientcomment, :clientimage);";

        $stmt  = $pdo->prepare($query);

        $stmt->bindParam(":clientname", $client_name);
        $stmt->bindParam(":clientposition", $client_position);
        $stmt->bindParam(":clientcomment", $client_comment);
        $stmt->bindParam(":clientimage", $client_image);

        $stmt->execute();

        session_start();
        $_SESSION['success_message'] = "Record saved successfully.";

        $pdo = null;
        $stmt = null;

        header("Location: ../addtestimonial.php"); 
 
        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e ->getMessage());
    }
}
else {
    header("Location: ../addtestimonial.php");
}
?>
