<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $Full_Name = $_POST["username"];
    $Emails = $_POST["email"];
    $Subjects = $_POST["subjects"];
    $Messages = $_POST["messages"];

    try {
        require_once "dbcon_inc.php";

        $query = "INSERT INTO contact (Full_Name, Emails, Subjects, Messages) VALUES (:username, :email, :subjects, :messages);";

        $stmt  = $pdo->prepare($query);

        $stmt->bindParam(":username", $Full_Name);
        $stmt->bindParam(":email", $Emails);
        $stmt->bindParam(":subjects", $Subjects);
        $stmt->bindParam(":messages", $Messages);

        $stmt->execute();

        session_start();
        $_SESSION['success_message'] = "Record saved successfully.";

        $pdo = null;
        $stmt = null;

        header("Location: ../Skyline Strategies Web/contact.php"); 


        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e ->getMessage());
    }
}
else {
    header("Location: ../Skyline Strategies Web/contact.php");
}
?>
