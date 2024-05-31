<?php
// Include the file for retrieving data
require_once "includes/viewpostinc.php";
require_once "includes/detailinc.php";

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
    <title>Details - Skyline Strategies</title>
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

    <!-- Include TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/5bobx8wmtsdcnkdxmyrn87ge9ntao5c4jcppa1p209zoe8pn/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<div>
    <!-- Topbar Start -->
    <div class="container-fluid bg-secondary ps-5 pe-0 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <!-- <a class="text-body py-2 pe-3 border-end" href=""><small>FAQs</small></a>
                    <a class="text-body py-2 px-3 border-end" href=""><small>Support</small></a>
                    <a class="text-body py-2 px-3 border-end" href=""><small>Privacy</small></a>
                    <a class="text-body py-2 px-3 border-end" href=""><small>Policy</small></a>
                    <a class="text-body py-2 ps-3" href=""><small>Career</small></a> -->
                </div>
            </div>
            <div class="col-md-6 text-center text-lg-end">
                <div class="position-relative d-inline-flex align-items-center bg-primary text-white top-shape px-5">
                    <div class="me-3 pe-3 border-end py-2">
                        <p class="m-0"><i class="fa fa-envelope-open me-2"></i>gee9ice144@gmail.com</p>
                    </div>
                    <div class="py-2">
                        <p class="m-0"><i class="fa fa-phone-alt me-2"></i>+7 915 197-33-65</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm px-5 py-3 py-lg-0">
        <a href="index.php" class="navbar-brand p-0">
            <h1 class="m-0 text-uppercase text-primary"><i class="text-primary me-2"></i>skyline Strategies</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0 me-n3">
                <a href="index.php" class="nav-item nav-link">Home</a>
                <a href="about.php" class="nav-item nav-link">About</a>
                <a href="service.php" class="nav-item nav-link">Service</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu m-0">
                        <a href="blog.php" class="dropdown-item">Blog Grid</a>
                        <a href="feature.php" class="dropdown-item">Features</a>
                        <a href="quote.php" class="dropdown-item">Quote Form</a>
                        <a href="team.php" class="dropdown-item">The Team</a>
                        <a href="testimonial.php" class="dropdown-item">Testimonial</a>
                    </div>
                </div>
                <a href="contact.php" class="nav-item nav-link">Contact</a>
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
                    <p><?php echo $post['notes']; ?></p>
                    <p>Okoi</p>
                </div>
                <!-- Blog Detail End -->

                <!-- Comment Form Start -->
                <div class="bg-secondary p-5">
                    <h2 class="mb-4">Leave a comment</h2>
                    <form method="post" action="includes/submitcommentinc.php" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control bg-white border-0" name="comment_author" required placeholder="Your Name" style="height: 55px;">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="email" class="form-control bg-white border-0" name="comment_author_email" required placeholder="Your Email" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control bg-white border-0" id="comment_content" name="comment_content" rows="5" required placeholder="Comment"></textarea>
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
                        echo '<h2 class="mb-4">' . $comment_count . ' Comments</h2>';
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
                            echo '  <div class="d-flex mb-4">';
                            echo '      <div class="ps-3">';
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

                    <script>
                        // Add event listeners to reply buttons
                        const replyButtons = document.querySelectorAll('.reply-btn');
                        replyButtons.forEach(button => {
                            button.addEventListener('click', function() {
                                // Toggle visibility of corresponding reply form
                                const targetId = this.getAttribute('data-target');
                                const replyForm = document.getElementById(targetId);
                                if (replyForm) {
                                    replyForm.style.display = replyForm.style.display === 'none' ? 'block' : 'none';
                                }
                            });
                        });
                    </script>
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
                        $currentRecordIndex = count($posts) - 1; // Set the index of the current record to the last one
                        for ($index = $currentRecordIndex; $index >= 0; $index--) {
                            $e = $posts[$index];
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
                
            </div>
            <!-- Sidebar End -->
        </div>
    </div>
    <!-- Blog End -->
    
    <!-- Footer Start -->
    <div class="container-fluid bg-primary text-secondary p-5">
        <div class="row g-5">
            <div class="col-12 text-center">
                <h1 class="display-5 mb-4">Stay Updated!!!</h1>
                <form action="includes/updates.php" method="POST" class="mx-auto" style="max-width: 600px;">
                    <div class="input-group">
                        <input type="email" name="email"class="form-control border-white p-3" required placeholder="Your Email">
                        <button class="btn btn-dark px-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-secondary p-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h3 class="text-white mb-4">Quick Links</h3>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-secondary mb-2" href="index.php"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                    <a class="text-secondary mb-2" href="about.php"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                    <a class="text-secondary mb-2" href="service.php"><i class="bi bi-arrow-right text-primary me-2"></i>Our Services</a>
                    <a class="text-secondary mb-2" href="blog.php"><i class="bi bi-arrow-right text-primary me-2"></i>Latest Blog Post</a>
                    <a class="text-secondary" href="contact.php"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 class="text-white mb-4">Popular Links</h3>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-secondary mb-2" href="feature.php"><i class="bi bi-arrow-right text-primary me-2"></i>Features</a>
                    <a class="text-secondary mb-2" href="quote.php"><i class="bi bi-arrow-right text-primary me-2"></i>Quote Form</a>
                    <a class="text-secondary mb-2" href="team.php"><i class="bi bi-arrow-right text-primary me-2"></i>Our Team</a>
                    <a class="text-secondary" href="testimonial.php"><i class="bi bi-arrow-right text-primary me-2"></i>Testimonial</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 class="text-white mb-4">Get In Touch</h3>
                <p class="mb-2"><i class="bi bi-geo-alt text-primary me-2"></i>Lenskaya Street House 7, Babushkinkaya Moscow, Russia.</p>
                <p class="mb-2"><i class="bi bi-envelope-open text-primary me-2"></i>gee9ice144@gmail.com</p>
                <p class="mb-0"><i class="bi bi-telephone text-primary me-2"></i>+7 915 197-33-65</p>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 class="text-white mb-4">Follow Us</h3>
                <div class="d-flex">
                    <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="https://x.com/OfficialGee9ice?t=KqOXV7iluP8GpuYL18m9QA" target="_blank"><i class="fab fa-twitter fw-normal"></i></a>
                    <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="https://www.facebook.com/gee9ice?mibextid=ZbWKwL" target="_blank"><i class="fab fa-facebook-f fw-normal"></i></a>
                    <a class="btn btn-lg btn-primary btn-lg-square rounded-circle" href="https://www.instagram.com/gee9ice?igsh=MTFncjJ2amV1NGN0bg==" target="_blank"><i class="fab fa-instagram fw-normal"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-secondary text-center border-top py-4 px-5" style="border-color: rgba(256, 256, 256, .1) !important;">
        <p class="m-0">&copy; <a class="text-secondary border-bottom" href="index.php">Skyline Strategies.com</a>. All Rights Reserved.
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
    <script>
    tinymce.init({
      selector: '#comment_content',
      plugins: 'lists advlist drawio',
      toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | charmap drawio image',
      automatic_uploads: true,
      menubar: false, // Disable the entire menubar
    });
    </script>
</body>

</html>