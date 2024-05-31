<?php
// Include the file for retrieving data
require_once "include/viewposts_inc.php";
require_once "include/detail_inc.php";

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
                    <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Uploads</a>
                    <div class="dropdown-menu m-0">
                        <a href="addpost.php" class="dropdown-item active">Add Post</a>
                        <a href="addteam.php" class="dropdown-item">Add Team</a>
                        <a href="addtestimonial.php" class="dropdown-item">Add Testimonial</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">View</a>
                    <div class="dropdown-menu m-0">
                        <a href="viewposts.php" class="dropdown-item">Blog Post</a>
                        <a href="viewteam.php" class="dropdown-item">Team Members</a>
                        <a href="viewclientqueries.php" class="dropdown-item">Client Request</a>
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
                <h1 class="display-4 text-white">Blog Detail</h1>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Blog Start -->
    <div class="container-fluid py-6 px-5">
        <div class="row g-5">
            <div class="col-lg-8">
                
                <!-- Blog Detail Start -->
                <div class="mb-5">
                    <img class="img-fluid w-100 mb-5" src="data:image/jpeg;base64,<?php echo base64_encode($post['post_image']); ?>" alt="">
                    <h1 class="mb-4"><?php echo $post['post_topic']; ?></h1>
                    <p style="color: black;"><?php echo $post['notes']; ?></p>
                </div>
                <!-- Blog Detail End -->

                <!-- Comment Form Start -->
                <div class="bg-secondary p-5">
                    <h2 class="mb-4">Leave a comment</h2>
                    <form method="post" action="include/submitcomment_inc.php" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control bg-white border-0" name="comment_author" required placeholder="Your Name" style="height: 55px;">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="email" class="form-control bg-white border-0" name="comment_author_email" required placeholder="Your Email" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control bg-white border-0" name="comment_content" rows="5" required placeholder="Comment"></textarea>
                            </div>
                            <!-- You might also need to include a hidden input field to pass the post ID -->
                            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                            <!-- Optionally, you can include a hidden input field to specify the parent comment ID if this comment is a reply -->
                            <input type="hidden" name="parent_comment_id" value="<?php echo $parent_comment_id; ?>">
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit" name="submit_comment">Leave Your Comment</button>
                            </div>
                        </div>
                    </form>
                </div>          
                <!-- Comment Form End -->

                <!-- Comment List Start -->
                <div class="mb-5">
                    <?php
                    // Assuming $post_id contains the ID of the current post

                    try {

                        // Prepare the SQL statement to count comments for the post
                        $stmt = $pdo->prepare("SELECT COUNT(*) AS comment_count FROM post_comments WHERE post_id = ?");
                        $stmt->execute([$post_id]);
                        $comment_count = $stmt->fetchColumn();

                        // Output the comment count
                        echo '<h2 class="mb-4 p-3">' . $comment_count . ' Comments</h2>';
                    } catch (PDOException $e) {
                        // Handle database errors
                        echo "Error: " . $e->getMessage();
                    }
                    ?>

                    <?php
                    // Assuming $post_id contains the ID of the current post

                    try {
                        // Prepare the SQL statement to fetch comments for the post, ordered by date descending
                        $stmt = $pdo->prepare("SELECT * FROM post_comments WHERE post_id = ? ORDER BY comment_date DESC");
                        $stmt->execute([$post_id]);
                        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                        // Loop through comments and display each one
                        foreach ($comments as $comment) {
                            echo '  <div class="d-flex mb-4 bg-secondary p-3">';
                            echo '      <div class="">';
                            echo '          <h6>' . $comment['comment_author'] . ' <small><i>' . date('d M Y', strtotime($comment['comment_date'])) . '</i></small></h6>';
                            echo '          <p>' . $comment['comment_content'] . '</p>';
                            echo '      </div>';
                            echo '  </div>';
                        }
                    } catch (PDOException $e) {
                        // Handle database errors
                        echo "Error: " . $e->getMessage();
                    }
                    ?>
                </div>
                <!-- Comment List End -->
            </div>

            <!-- Sidebar Start -->
            <div class="col-lg-4">
                <!-- Recent Post Start -->
                <div class="mb-5">
                    <h2 class="mb-4">Recent Post</h2>
                    <form action="include/detail_inc.php" method="post" class="mb-3">
                        <?php 
                        $currentRecordglory = count($posts) - 1; // Set the glory of the current record to the last one
                        for ($glory = $currentRecordglory; $glory >= 0; $glory--) {
                            $e = $posts[$glory];
                        ?>
                        <div class="d-flex mb-3 bg-secondary">
                            <img class="img-fluid" src="data:image/jpeg;base64,<?php echo base64_encode($e['post_image']); ?>" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                            <a href="detail.php?post_id=<?php echo $e['post_id']; ?>" class="h5 d-flex align-items-center px-3 mb-0"><?php echo substr($e['post_topic'], 0, 30); ?>...</a>
                        </div>
                        <?php
                        } // End of for loop
                        ?>
                    </form>
                </div>
                <!-- Recent Post End -->

                <!-- Tags End -->

            </div>
            <!-- Sidebar End -->
        </div>
    </div>
    <!-- Blog End -->
    
    <div class="container-fluid bg-dark text-secondary text-center border-top py-4 px-5" style="border-color: rgba(256, 256, 256, .1) !important;">
        <p class="m-0">&copy; <a class="text-secondary border-bottom" href="glory.php">Skyline Strategies.com</a>. All Rights Reserved.
    </div>
    <!-- Footer End -->


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