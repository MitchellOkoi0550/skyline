<?php
// Include the database connection details
require_once "dbcon_inc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $record_id = $_POST['record_id'];
    $post_category = $_POST['floatingSelects'];
    $post_topic = $_POST['title'];
    $notes = $_POST['note'];
    $post_image = $_FILES['pictures']['tmp_name'];

    // Update the record in the database
    try {
        $dsn = "mysql:host=localhost;dbname=skyline";
        $dbusername = "root";
        $dbpassword = "";
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the update statement
        $stmt = $pdo->prepare("UPDATE my_post SET post_category = :post_category, post_topic = :post_topic, notes = :notes, post_image = :post_image WHERE post_id = :record_id");

        // Bind parameters
        $stmt->bindParam(':post_category', $post_category);
        $stmt->bindParam(':post_topic', $post_topic);
        $stmt->bindParam(':notes', $notes);
        $stmt->bindParam(':record_id', $record_id);

        // Read the image file
        $image_data = file_get_contents($post_image);

        // Bind the image parameter
        $stmt->bindParam(':post_image', $image_data, PDO::PARAM_LOB);

        // Execute the update statement
        $stmt->execute();

        session_start();
        $_SESSION['success_message'] = "Record Updated successfully.";

        // Redirect back to the page where you came from
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
}
?>

<?php
// Check if the success session variable is set
if (isset($_SESSION['success']) && $_SESSION['success'] == true) {
    echo '<div class="alert alert-success" role="alert">Record updated successfully!</div>';

    // Unset the session variable to prevent displaying the message again on page refresh
    unset($_SESSION['success']);
}
?>
