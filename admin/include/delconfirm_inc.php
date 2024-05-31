<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_id"])) {
    $delete_id = $_POST["delete_id"]; // Assuming you're passing the ID of the record to delete

    echo "<script>";
    echo "if(confirm('Are you sure you want to delete this record?')) {";
    echo "  window.location.href = 'delete.php?delete_id=$delete_id';";
    echo "} else {";
    echo "  window.location.href = '../blog.php';";
    echo "}";
    echo "</script>";
    exit();
}
?>
