<?php
// Include the file for retrieving data
require_once "include/viewteam_inc.php";

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
</head>

<body margin ="0px" padding="0px">
    <div>
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm px-5 py-0 py-lg-0">
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
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">View</a>
                        <div class="dropdown-menu m-0">
                            <a href="viewposts.php" class="dropdown-item">Blog Post</a>
                            <a href="viewteam.php" class="dropdown-item active">Team Members</a>
                            <a href="viewclientrequest.php" class="dropdown-item">Client Request</a>
                        </div>
                    </div>
                    <a href="clientquery.php" class="nav-item nav-link ">Client Queries</a>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->


        <!-- Page Header Start -->
        <div class="container-fluid bg-dark">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-4 text-white">Our Team</h1>
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
                    <h4>Team Members</h4>
                    </div>
                </div>
            </div>
        </div>


        <!-- Team Start -->
        <div class="container-fluid px-5">            
            <div">
                <form action="include/viewteam_inc.php" method="post" class="row g-5">
                    <?php 
                    // Start the loop from the first record
                    foreach ($posts as $q) {
                    ?>
                    <div class="col-lg-4 py-3 px-4">
                        <div class="team-item position-relative overflow-hidden ">
                            <img class="img-fluid w-100" style="width: 100%; height: 500px; object-fit: cover;" src="data:image/jpeg;base64,<?php echo base64_encode($q['team_image']); ?>" alt="">
                            <div class="team-text w-100 position-absolute top-50 text-center bg-primary p-4">
                                <h3 class="text-white"><?php echo $q['team_position']; ?></h3>
                                <p class="text-white text-uppercase mb-0"><?php echo $q['team_name']; ?></p>
                            </div>
                        </div>
                        <div class="d-flex mb-2 py-3">
                            <a href="editteam.php"><button class="btn btn-primary w-20 py-1 me-4 edit-btn" name="edit_id">Edit</button></a>
                            <button class="btn btn-primary w-20 py-1 me-4" type="submit" name="delete_id" value="<?php echo $e['post_id']; ?>">Delete</button>
                        </div>
                    </div>
                    <?php 
                    } // End of foreach loop
                    ?>
                </form>
            </div>
        </div>
    </div>

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
