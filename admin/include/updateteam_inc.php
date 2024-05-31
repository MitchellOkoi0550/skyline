<?php
// Include the database connection details
require_once "dbcon_inc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $record_id = $_POST['record_id'];
    $team_name = $_POST['teamname'];
    $post_category = $_POST['teamposition'];
    $post_image = $_FILES['teamimage']['tmp_name'];

    // Update the record in the database
    try {
        $dsn = "mysql:host=localhost;dbname=skyline";
        $dbusername = "root";
        $dbpassword = "";
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the update statement
        $stmt = $pdo->prepare("UPDATE my_team SET team_name = :team_name, team_position = :team_position, team_image = :team_image WHERE team_id = :record_id");

        // Bind parameters
        $stmt->bindParam(':team_name', $team_name);
        $stmt->bindParam(':team_position', $team_position);

        // Read the image file
        $image_data = file_get_contents($team_image);

        // Bind the image parameter
        $stmt->bindParam(':team_image', $image_data, PDO::PARAM_LOB);

        // Execute the update statement
        $stmt->execute();

        session_start();
        $_SESSION['success_message'] = "Record Updated successfully.";

        // Redirect back to the page where you came from
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } catch (PDOException $q {
        // Handle database errors
        echo "Error: " . $q->getMessage();
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
