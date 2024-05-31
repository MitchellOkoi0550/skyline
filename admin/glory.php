<?php
// Include the file for retrieving data
require_once "include/viewposts_inc.php";

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
    <meta content="Skyline Strategies" name="keywords">
    <meta content="Business Consultancy" name="description">

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
</head>

<body>
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
                <a href="glory.php" class="nav-item nav-link active">Home</a>
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
                <a href="clientquery.php" class="nav-item nav-link ">Client Queries</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <div class="container-fluid pt-3 px-5 mb-1">
    <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 mb-0">Dashboard</h1>
            <hr class="w-25 mx-auto bg-primary">
        </div>

        <div class="row g-5">
            <div class="col-lg-4 col-md-3">
                <div class="service-item bg-secondary text-center px-5 col-lg-4 col-md-3" style="height: 170px; width: 100%;">
                    <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle mb-2" style="width: 60px; height: 60px;">
                    <?php
                    // Database connection setup
                    $dsn = "mysql:host=localhost;dbname=skyline";
                    $dbusername = "root";
                    $dbpassword = "";

                    try {
                        $pdo = new PDO($dsn, $dbusername, $dbpassword);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    } catch (PDOException $e) {
                        echo "Connection failed: " . htmlspecialchars($e->getMessage());
                        exit; // Stop further execution if the connection fails
                    }

                    try {
                        // Prepare the SQL statement to count records in the my_post table
                        $stmt = $pdo->prepare("SELECT COUNT(*) AS post_count FROM my_post");
                        $stmt->execute();
                        $post_count = $stmt->fetchColumn();

                        // Output the record count
                        echo '<h3 class="text-white">' . htmlspecialchars($post_count) . '</h3>';
                    } catch (PDOException $e) {
                        // Handle database errors
                        echo "Error: " . htmlspecialchars($e->getMessage());
                    }
                    ?>
                    </div>
                    <div>
                    <a href="viewposts.php"><p class="mb-3 h4">Blog Post</p></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-3">
                <div class="service-item bg-secondary text-center px-5 col-lg-4 col-md-3" style="height: 170px; width: 100%;">
                    <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle mb-2" style="width: 60px; height: 60px;">
                    <?php
                    // Database connection setup
                    $dsn = "mysql:host=localhost;dbname=skyline";
                    $dbusername = "root";
                    $dbpassword = "";

                    try {
                        $pdo = new PDO($dsn, $dbusername, $dbpassword);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    } catch (PDOException $e) {
                        echo "Connection failed: " . htmlspecialchars($e->getMessage());
                        exit; // Stop further execution if the connection fails
                    }

                    try {
                        // Prepare the SQL statement to count records in the my_post table
                        $stmt = $pdo->prepare("SELECT COUNT(*) AS team_count FROM my_team");
                        $stmt->execute();
                        $team_count = $stmt->fetchColumn();

                        // Output the record count
                        echo '<h3 class="text-white">' . htmlspecialchars($team_count) . '</h3>';
                    } catch (PDOException $e) {
                        // Handle database errors
                        echo "Error: " . htmlspecialchars($e->getMessage());
                    }
                    ?>
                    </div>
                    <div>
                    <a href="viewteam.php"><p class="mb-3 h4">Team Members</p></a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-3">
                <div class="service-item bg-secondary text-center px-5 col-lg-4 col-md-3" style="height: 170px; width: 100%;">
                    <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle mb-2" style="width: 60px; height: 60px;">
                    <?php
                    // Database connection setup
                    $dsn = "mysql:host=localhost;dbname=skyline";
                    $dbusername = "root";
                    $dbpassword = "";

                    try {
                        $pdo = new PDO($dsn, $dbusername, $dbpassword);
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
                    <a href="clientquery.php"><p class="mb-3 h4">Queries</p></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-3">
                <div class="service-item bg-secondary text-center px-5 col-lg-4 col-md-3 mb-5" style="height: 170px; width: 100%;">
                    <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle mb-2" style="width: 60px; height: 60px;">
                    <?php
                    // Database connection setup
                    $dsn = "mysql:host=localhost;dbname=skyline";
                    $dbusername = "root";
                    $dbpassword = "";

                    try {
                        $pdo = new PDO($dsn, $dbusername, $dbpassword);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    } catch (PDOException $e) {
                        echo "Connection failed: " . htmlspecialchars($e->getMessage());
                        exit; // Stop further execution if the connection fails
                    }

                    try {
                        // Prepare the SQL statement to count records in the my_post table
                        $stmt = $pdo->prepare("SELECT COUNT(*) AS request_count FROM quotes");
                        $stmt->execute();
                        $request_count = $stmt->fetchColumn();

                        // Output the record count
                        echo '<h3 class="text-white">' . htmlspecialchars($request_count) . '</h3>';
                    } catch (PDOException $e) {
                        // Handle database errors
                        echo "Error: " . htmlspecialchars($e->getMessage());
                    }
                    ?>
                    </div>
                    <div>
                    <a href="viewclientrequest.php"><p class="mb-3 h4">Quote Request</p></a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-3">
                <div class="service-item bg-secondary text-center px-5 col-lg-4 col-md-3" style="height: 170px; width: 100%;">
                    <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle mb-2" style="width: 60px; height: 60px;">
                    <?php
                    // Database connection setup
                    $dsn = "mysql:host=localhost;dbname=skyline";
                    $dbusername = "root";
                    $dbpassword = "";

                    try {
                        $pdo = new PDO($dsn, $dbusername, $dbpassword);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    } catch (PDOException $e) {
                        echo "Connection failed: " . htmlspecialchars($e->getMessage());
                        exit; // Stop further execution if the connection fails
                    }

                    try {
                        // Prepare the SQL statement to count records in the my_post table
                        $stmt = $pdo->prepare("SELECT COUNT(*) AS update_count FROM updates");
                        $stmt->execute();
                        $update_count = $stmt->fetchColumn();

                        // Output the record count
                        echo '<h3 class="text-white">' . htmlspecialchars($update_count) . '</h3>';
                    } catch (PDOException $e) {
                        // Handle database errors
                        echo "Error: " . htmlspecialchars($e->getMessage());
                    }
                    ?>
                    </div>
                    <div>
                    <a href="viewposts.php"><p class="mb-3 h4">Emails for New Updates</p></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-3">
                <div class="service-item bg-secondary text-center px-5 col-lg-4 col-md-3 mb-5" style="height: 170px; width: 100%;">
                    <div class="d-flex align-items-center justify-content-center bg-dark text-white rounded-circle mb-2" style="width: 60px; height: 60px;">
                    <i class="far fa-smile fs-4 text-white"></i>
                    </div>
                    <div>
                    <a href="#"><p class="mb-3 h4">Skyline Site</p></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->
    
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


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