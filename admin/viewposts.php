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
                    <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">View</a>
                    <div class="dropdown-menu m-0">
                        <a href="viewposts.php" class="dropdown-item active">Blog Post</a>
                        <a href="viewteam.php" class="dropdown-item">Team Members</a>
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
                <h1 class="display-4 text-white">Blog Grid</h1>
            </div>
        </div>
    </div>

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
                <h4>Blog Post</h4>
            </div>
        </div>
    </div>

        
    <!-- Page Header End -->

    <!-- Blog Start -->
    <div class="container-fluid px-5">
        <form action="include/postdelete_inc.php" method="post" class="row g-5">
            <?php 
            $currentRecordglory = count($posts) - 1; // Set the glory of the current record to the last one

            for ($glory = $currentRecordglory; $glory >= 0; $glory--) {
                $e = $posts[$glory];
            ?>
            <div class="col-lg-4 py-2">
                <div class="blog-item">
                    <div class="position-relative overflow-hidden">
                        <img style="width: 100%; height: 250px; object-fit: cover;" src="data:image/jpeg;base64,<?php echo base64_encode($e['post_image']); ?>" alt="">
                    </div>
                    <div class="bg-secondary d-flex">
                        <div class="flex-shrink-0 d-flex flex-column justify-content-center text-center bg-primary text-white px-4">
                            <span><?php echo date('j', strtotime($e['post_date'])); ?></span>
                            <h5 class="text-uppercase m-0"><?php echo date('M', strtotime($e['post_date'])); ?></h5>
                            <span><?php echo date('Y', strtotime($e['post_date'])); ?></span>
                        </div>
                        <div class="justify-content-center position-relative overflow-hidden py-3 px-4" style="height: 180px;">
                            <div class="d-flex mb-2">
                                <small class="text-uppercase me-3"><i class="bi bi-bookmarks me-2"></i><?php echo substr($e['post_category'], 0, 19); ?></small>
                            </div>
                            <div class="py-1" style="height: 95px;">
                                <a class="h4" href="detail.php?post_id=<?php echo $e['post_id']; ?>"><?php echo substr($e['post_topic'], 0, 35); ?>...</a>
                            </div>
                            <div class="d-flex mb-2">
                                <a href="editpost.php?post_id=<?php echo $e['post_id']; ?>" class="btn btn-primary w-20 py-1 me-4 edit-btn" name="edit_id">Edit</a>
                                <button class="btn btn-primary w-20 py-1 me-4" type="submit" name="delete_id" value="<?php echo $e['post_id']; ?>">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
            } // End of for loop
            ?>
        </form>
    </div>
</div>
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

    <div class="container-fluid bg-dark text-secondary text-center border-top py-4 px-5" style="border-color: rgba(256, 256, 256, .1) !important;">
        <p class="m-0">&copy; <a class="text-secondary border-bottom" href="glory.php">Skyline Strategies.com</a>. All Rights Reserved.
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all edit buttons
        var editButtons = document.querySelectorAll('.edit-btn');

        // Add click event listener to each edit button
        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var postId = this.getAttribute('data-post-id');
                // Redirect the user to the editpost.php page with the post_id parameter
                window.location.href = 'editpost.php?post_id=' + postId;
            });
        });
    });
    </script>
    <script>
        function editPost(post_Id) {
        window.location.href = 'editpost.php?post_id=' + post_Id;
    }
    </script>


    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>