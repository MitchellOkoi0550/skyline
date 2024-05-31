
<?php
// Include the file for retrieving data
require_once "include/viewcontact_inc.php";

// Display the HTML using the retrieved data

session_start();

// Check if the success message is set
if (isset($_SESSION['success_message'])) {
    // Output JavaScript to display the success message in a dialog box
    echo "<script>alert('" . $_SESSION['success_message'] . "');</script>";
    // Unset the session variable to remove the message after displaying it
    unset($_SESSION['success_message']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Blog</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}
</style>
</head>

<div>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm px-5 py-3 py-lg-0">
        <a href="glory.php" class="navbar-brand p-0">
        <h1 class="m-0 text-uppercase"><i class="me-2"></i>skyline Strategies</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0 me-n3">
                <a href="glory.php" class="nav-item nav-link ">Home</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Uploads</a>
                    <div class="dropdown-menu m-0">
                        <a href="addpost.php" class="dropdown-item">Add Post</a>
                        <a href="addteam.php" class="dropdown-item">Add Team</a>
                        <a href="addtestimonial.php" class="dropdown-item">Add Testimonial</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">View</a>
                    <div class="dropdown-menu m-0">
                        <a href="viewposts.php" class="dropdown-item">Blog Post</a>
                        <a href="viewteam.php" class="dropdown-item">Team Members</a>
                        <a href="viewclientrequest.php" class="dropdown-item">Client Request</a>
                    </div>
                </div>
                <a href="clientquery.php" class="nav-item nav-link active">Client Queries</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid bg-dark">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white">Client Request</h1>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container-fluid py-3 px-4">
        <div class="row g-5">
            <div class="col-12 text-center">
                <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle mb-2" style="width: 60px; height: 60px; margin: auto;">
                <?php
                    // Database connection setup
                    $dbHOST = $_ENV['MYSQLHOST'] ?? 'localhost';
                    $dbUSER = $_ENV['MYSQLUSER'] ?? 'root';
                    $dbPASSWORD = $_ENV['MYSQLPASSWORD'] ?? '';
                    $dbPORT = $_ENV['MYSQLPORT'] ?? 3306;
                    $dbname = $_ENV['MYSQLDATABASE'] ?? 'skyline';
                    $dsn = "mysql:host={$dbHOST};dbname={$dbname}";
                    // $dbusername = "root";
                    // $dbpassword = "";

                    try {
                        $pdo = new PDO($dsn, $dbUSER, $dbPASSWORD);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    } catch (PDOException $e) {
                        echo "Connection failed: " . htmlspecialchars($e->getMessage());
                        exit; // Stop further execution if the connection fails
                    }

                    try {
                        // Prepare the SQL statement to count records in the my_post table
                        $stmt = $pdo->prepare("SELECT COUNT(*) AS client_count FROM contact");
                        $stmt->execute();
                        $client_count = $stmt->fetchColumn();

                        // Output the record count
                        echo '<h3 class="text-white">' . htmlspecialchars($client_count) . '</h3>';
                    } catch (PDOException $e) {
                        // Handle database errors
                        echo "Error: " . htmlspecialchars($e->getMessage());
                    }
                    ?>
                    </div>
                    <div>
                    <h4>Queries</h4>
                    </div>
            </div>
        </div>
    </div>

    <!-- Contact Start -->
    <div class="row">
        <div class="col-lg-9 py-2 px-1 mx-auto">
            <div>
                <?php
                    // Define the number of records per page
                    $records_per_page = 10;

                    // Determine the total number of records
                    $total_records = count($posts);

                    // Calculate the total number of pages
                    $total_pages = ceil($total_records / $records_per_page);

                    // Get the current page number
                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

                    // Calculate the starting glory of records for the current page
                    $start_glory = ($current_page - 1) * $records_per_page;

                    // Get the subset of records for the current page
                    $subset_posts = array_slice($posts, $start_glory, $records_per_page);
                ?>
                <form action="include/viewcontact_inc.php" method="post" class="row g-5">
                    <table>
                        <tr>
                            <th class="container-fluid bg-dark text-white" style="width:20px;">Name</th>
                            <th class="container-fluid bg-dark text-white" style="width:30px;">Email</th>
                            <th class="container-fluid bg-dark text-white" style="width:30px;">Subject</th>
                            <th class="container-fluid bg-dark text-white" style="width:30px;">Message</th>
                            <th class="container-fluid bg-dark text-white" style="width:10px;">Action</th>
                        </tr>
                        <?php 
                            // Loop through the subset of records for the current page
                            foreach ($subset_posts as $s) {
                            ?>
                            <tr>
                                <td><?php echo $s['Full_Name']; ?></td>
                                <td><?php echo $s['Emails']; ?></td>
                                <td><?php echo $s['Subjects']; ?></td>
                                <td><?php echo $s['Messages']; ?></td>
                                <td>
                                    <div class="d-flex mb-2">
                                        <a href="editpost.php?post_id=<?php echo $e['post_id']; ?>" class="btn btn-primary w-20 py-1 me-4 edit-btn" name="view_id">View</a>
                                        <button class="btn btn-primary w-20 py-1 me-4" type="submit" name="delete_id" value="<?php echo $e['post_id']; ?>">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        <?php 
                        } // End of foreach loop
                        ?>
                    </table>
                    <div clas="">
                        <!-- Pagination links -->
                        <?php if ($total_pages > 1): ?>
                            <div>
                                <!-- Previous page button -->
                                <?php if ($current_page > 1): ?>
                                    <a href="?page=<?php echo $current_page - 1; ?>"><button class="btn btn-primary w-20 py-1 me-3" type="button">Previous</button></a>
                                <?php endif; ?>
                                
                                <!-- Page numbers -->
                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <?php if ($i == $current_page): ?>
                                        <span><button class="btn btn-primary w-20 py-1 me-3" type="button"><?php echo $i;?></button></span>
                                    <?php else: ?>
                                        <a href="?page=<?php echo $i; ?>"><button class="btn btn-primary w-20 py-1 me-3" type="button"><?php echo $i; ?></button></a>
                                    <?php endif; ?>
                                <?php endfor; ?>
                                
                                <!-- Next page button -->
                                <?php if ($current_page < $total_pages): ?>
                                    <a href="?page=<?php echo $current_page + 1; ?>"><button class="btn btn-primary w-20 py-1 me-3" type="button">Next</button></a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </form>

                <div id="paginationButtons">
                    <!-- Pagination buttons will be dynamically added here -->
                </div>
                
            </div>
        </div>
    </div>

    <div class="container-fluid bg-dark text-secondary text-center border-top py-4 px-5" style="border-color: rgba(256, 256, 256, .1) !important;">
        <p class="m-0">&copy; <a class="text-secondary border-bottom" href="glory.php">Skyline Strategies.com</a>. All Rights Reserved.
    </div>
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>