<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

  include("connections.php");
  include("functions.php");

  if($_SERVER['REQUEST_METHOD'] == "POST"){
    //something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

  if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
    // Handle image upload
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Process the uploaded image
        $name = $_FILES['image']['name'];
        $type = $_FILES['image']['type'];
        $data = file_get_contents($_FILES['image']['tmp_name']);

        // Insert user data and image data into the database
        $student_id = random_num(11);
        $query = "INSERT INTO students (student_id, user_name, password, image_name, image_type, image_data) VALUES ('$student_id', '$user_name', '$password', ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 'sss', $name, $type, $data);
        mysqli_stmt_execute($stmt);

        // Redirect to login page after successful registration
        header("Location: login.php");
        exit;
    } else {
        echo "Image upload failed. Please try again.";
    }
} else {
    echo "Please enter valid information.";
}
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Create an account</title>
    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,700;1,200&family=Unbounded:wght@400;700&display=swap" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/bootstrap-icons.css" rel="stylesheet" />
    <link href="css/tooplate-kool-form-pack.css" rel="stylesheet" />
    <!--
    Tooplate 2136 Kool Form Pack
    https://www.tooplate.com/view/2136-kool-form-pack
    Bootstrap 5 Form Pack Template
    -->
</head>
<body>
    <main>
        <header class="site-header">
        <div class="container">
          <div class="row justify-content-between">
            <div class="col-lg-12 col-12 d-flex">
              <a
                class="site-header-text d-flex justify-content-center align-items-center me-auto"
                href="index.php"
              >
                <i class="bi-robot"></i>

                <span> INC GRADE </span>
              </a>

           
              <ul class="social-icon d-flex justify-content-center align-items-center mx-auto">
              <span class="text-white me-4 d-none d-lg-block">Stay connected</span>

              <li class="social-icon-item">
                <a href="https://www.instagram.com/bmcc_cuny/" target="_blank" class="social-icon-link bi-instagram"></a>
              </li>

                <li class="social-icon-item">
                <a href="https://twitter.com/bmcc_cuny/" target="_blank" class="social-icon-link bi-twitter"></a>
                </li>

              <li class="social-icon-item">
                <a href="https://www.tiktok.com/@bmcc_cuny" target="_blank" class="social-icon-link bi-tiktok"></a>
              </li>
            </ul>

              <div>
                <a
                  href="#"
                  class="custom-btn custom-border-btn btn"
                  data-bs-toggle="modal"
                  data-bs-target="#subscribeModal"
                  >Notify me
                  <i class="bi-arrow-right ms-2"></i>
                </a>
              </div>

              <a
                class="bi-list offcanvas-icon"
                data-bs-toggle="offcanvas"
                href="#offcanvasMenu"
                role="button"
                aria-controls="offcanvasMenu"
              ></a>
            </div>
          </div>
        </div>
        </header>

        <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
        <div class="offcanvas-header">
          <button
            type="button"
            class="btn-close ms-auto"
            data-bs-dismiss="offcanvas"
            aria-label="Close"
          ></button>
        </div>

        <div
          class="offcanvas-body d-flex flex-column justify-content-center align-items-center"
        >
          <nav>
            <ul>
              <li>
                <a href="login.php">Login</a>
              </li>

              <li>
                <a class="active" href="register.php">Create an account</a>
              </li>

              <li>
                <a href="password-reset.html">Password Reset</a>
              </li>

              <li>
                <a href="update.html">Update</a>
              </li>

              <li>
                <a href="contact.html">Contact Form</a>
              </li>
            </ul>
          </nav>
        </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>

            <div class="modal-body">
              <form
                action="#"
                method="get"
                class="custom-form mt-lg-4 mt-2"
                role="form"
              >
                <h2 class="modal-title" id="subscribeModalLabel">
                  Stay up to date
                </h2>

                <input
                  type="email"
                  name="email"
                  id="email"
                  pattern="[^ @]*@[^ @]*"
                  class="form-control"
                  placeholder="your@email.com"
                  required=""
                />

                <button type="submit" class="form-control">Notify</button>
              </form>
            </div>

            <div class="modal-footer justify-content-center">
              <p class="text-white" style="color: white">
                By signing up, you agree to our Privacy Notice
              </p>
            </div>
          </div>
        </div>
        </div>

        <section class="hero-section d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 mx-auto">
                        <form class="custom-form" role="form" method="post" action="register.php" enctype="multipart/form-data">
                            <h2 class="hero-title text-center mb-4 pb-2">Create an account</h2>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-floating">
                                        <input type="text" name="full-name" id="full-name" class="form-control" placeholder="Full Name" required="">
                                        <label for="floatingInput">Full Name</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-floating mb-4 p-0">
                                        <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address" required="">
                                        <label for="email">Email address</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <div class="form-floating p-0">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="">
                                        <label for="password">Password</label>
                                    </div>
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">I agree to the Terms of Service and Privacy Policy.</label>
                                    </div>
                                </div>
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-lg-5 col-md-5 col-5 ms-auto">
                                        <button type="submit" class="form-control">Submit</button>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-7">
                                        <div class="speech-bubble">
                                            <p class="mb-0 bubble-animation" style="font-weight: bold; color: rgb(0, 0, 0)">Already have an account? <a href="login.html" class="ms-2" style="text-decoration: underline">Login</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="video-wrap">
                <video autoplay="" loop="" muted="" class="custom-video" poster="">
                    <source src="videos/flag2.mp4" type="video/mp4" />
                    Your browser does not support the video tag.
                </video>
            </div>
        </section>
    </main>
    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/countdown.js"></script>
    <script src="js/init.js"></script>
</body>
</html>
