<?php

require_once "include/editteam_inc.php";

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

    <!-- Include TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/5bobx8wmtsdcnkdxmyrn87ge9ntao5c4jcppa1p209zoe8pn/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
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
                <a href="glory.php" class="nav-item nav-link ">Home</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Uploads</a>
                    <div class="dropdown-menu m-0">
                        <a href="addpost.php" class="dropdown-item ">Add Post</a>
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
                <h1 class="display-4 text-white">Edit Post</h1>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Contact Start -->
    <div class="ol-lg-8">
        <div class="row g-0">
            <div class="col-lg-6 py-4 px-1 mx-auto" style="max-width: 700px;">
                <?php
                // Retrieve the record's data from the database based on its ID
                $record_id = $_GET['team_id']; // Assuming you pass the ID through the URL

                // Assuming you have a function to fetch record data from your database
                $record = fetchRecordById($record_id); // Fetch the record by ID

                // Assign fetched record data to variables
                $team_name = $record['team_name'];
                $team_position = $record['team_position'];
                $team_image = $record['team_image'];
                ?>
                <form action="include/updateteam_inc.php" method="POST" enctype="multipart/form-data" id="postForm">
                    <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" name="teamname" class="form-control" id="form-floating-1" required placeholder="Name" value="<?php echo $team_name; ?>">
                                <label for="form-floating-1">Consultant Name</label>
                            </div>
                        </div>
                        <div class="form-floating">
                            <select class="form-select" name="teamposition" aria-label="Financial Consultancy">
                                <option value="Financial Consultant" <?php if($team_position == "Financial Consultant") echo "selected"; ?>>Financial Consultant</option>
                                <option value="Strategic Consultant" <?php if($team_position == "Strategic Consultant") echo "selected"; ?>>Strategic Consultant</option>
                                <option value="Tax Consultant" <?php if($team_position == "Tax Consultant") echo "selected"; ?>>Tax Consultant</option>
                            </select>
                            <label for="floatingSelect">Select Category</label>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($team_image); ?>" alt="Team Image">
                                <input type="file" name="teamimage" accept="image/jpeg, image/jpg, image/png">
                            </div>
                        </div>                        
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-dark text-secondary text-center border-top py-4 px-5" style="border-color: rgba(256, 256, 256, .1) !important;">
        <p class="m-0">&copy; <a class="text-secondary border-bottom" href="glory.php">Skyline Strategies.com</a>. All Rights Reserved.</p>
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
    <script>
    tinymce.init({
      selector: '#note',
      plugins: 'image lists advlist charmap drawio',
      toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | charmap drawio image',
      automatic_uploads: true,
      images_upload_url: false, // Disable server-side upload
      images_upload_handler: function (blobInfo, success, failure) {
        try {
          var file = blobInfo.blob();
          var reader = new FileReader();
          reader.onload = function () {
            success(reader.result);
          };
          reader.onerror = function (error) {
            failure('Failed to read file: ' + error.target.error.name);
          };
          reader.readAsDataURL(file);
        } catch (error) {
          failure('Failed to upload image: ' + error.message);
        }
      }
    });
    </script>

    <script>
        document.getElementById('postForm').addEventListener('submit', function(event) {
            const textarea = document.getElementById('note');
            if (textarea.style.display === 'none') {
                textarea.removeAttribute('required');
            } else {
                textarea.setAttribute('required', 'required');
            }
        });
    </script>

</body>

</html>
