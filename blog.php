<?php
// Include the file for retrieving data
require_once "includes/viewpostinc.php";

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
    <title>Blog - Skyline Strategies</title>
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
                        <a href="blog.php" class="dropdown-item active">Blog Grid</a>
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
    <div class="container-fluid bg-dark p-4">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white">Blog Grid</h1>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Blog Start -->
    <div class="container-fluid py-5 px-5">
        
        <!-- Search Form Start -->
        <div class="mb-5">
            <div class="input-group">
                <input type="text" class="form-control p-2" placeholder="Keyword">
                <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
            </div>
        </div>
        <!-- Search Form End -->

        <div class="row g-5">
            <!-- Blog list Start -->
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

                    // Calculate the starting index of records for the current page
                    $start_index = ($current_page - 1) * $records_per_page;

                    // Get the subset of records for the current page
                    $e = array_slice($posts, $start_index, $records_per_page);
                ?>
                <form action="include/postdelete_inc.php" method="post" class="row g-5">
                    <?php 
                    $currentRecordIndex = count($posts) - 1; // Set the index of the current record to the last one

                    for ($index = $currentRecordIndex; $index >= 0; $index--) {
                        $e = $posts[$index];
                    ?>
                    <div class="col-lg-4">
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
                                <div class="justify-content-center py-3 px-4" style="height: 150px;">
                                    <div class="d-flex mb-2">
                                        <small class="text-uppercase me-3"><i class="bi bi-bookmarks me-2"></i><?php echo substr($e['post_category'], 0, 19); ?></small>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <a class="h4" href="detail.php?post_id=<?php echo $e['post_id']; ?>"><?php echo substr($e['post_topic'], 0, 35); ?>...</a>
                                    </div>    
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                    } // End of for loop
                    ?>
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
            </div>
            <!-- Blog list End -->
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
                        <input  type="email" name="email" class="form-control border-white p-3" required placeholder="Your Email">
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
</body>

</html>