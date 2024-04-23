<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Login page</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,700;1,200&family=Unbounded:wght@400;700&display=swap"
      rel="stylesheet"
    />

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
  <?php
session_start();
require 'pdo_connection.php';

$error = ''; // Variable to store error message.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        // Prepare the SQL statement to prevent SQL injection.
        $sql = "SELECT * FROM Students WHERE Email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['Password'])) {
            // User is found and password is correct.
            $_SESSION['user_id'] = $user['ID'];
            $_SESSION['email'] = $user['Email'];

            // Redirect to the static HTML page.
            header("Location: student-login.html");
            exit;
        } else {
            // No user found or password is incorrect.
            $error = "Invalid email or password. Please try again.";
        }
    } else {
        $error = "Please enter both email and password.";
    }
}

// If the script reaches here without redirecting, it means no login occurred.
// Include login form here or in a separate file as preferred.
?>
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

      <div
        class="offcanvas offcanvas-end"
        data-bs-scroll="true"
        tabindex="-1"
        id="offcanvasMenu"
        aria-labelledby="offcanvasMenuLabel"
      >
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
                <a class="active" href="login.php">Login</a>
              </li>

              <li>
                <a href="register.php">Create an account</a>
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
      <div
        class="modal fade"
        id="subscribeModal"
        tabindex="-1"
        aria-labelledby="subscribeModalLabel"
        aria-hidden="true"
      >
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
              <p>By signing up, you agree to our Privacy Notice</p>
            </div>
          </div>
        </div>
      </div>

      <section class="hero-section d-flex justify-content-center align-items-center">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 col-12 mx-auto">
        <form class="custom-form login-form" role="form" method="post" action="login.php">
          <h2 class="hero-title text-center mb-4 pb-2">Login</h2>
          
          <?php if (!empty($error)): ?>
            <div class="alert alert-danger" role="alert">
              <?php echo htmlspecialchars($error); ?>
            </div>
          <?php endif; ?>
          
          <div class="form-floating mb-4 p-0">
            <input
              type="email"
              name="email"
              id="email"
              pattern="[^ @]*@[^ @]*"
              class="form-control"
              placeholder="Email address"
              required=""
            />
            <label for="email">Email address</label>
          </div>

          <div class="form-floating p-0">
            <input
              type="password"
              name="password"
              id="password"
              class="form-control"
              placeholder="Password"
              required=""
            />
            <label for="password">Password</label>
          </div>
        
          <div style="display: flex; justify-content: center; gap: 20px;">
            <div class="form-check mb-4">
              <input
                class="form-check-input"
                type="checkbox"
                value="student"
                name="user_type"
                id="flexCheckDefault1"
              />
              <label class="form-check-label" for="flexCheckDefault1">
                <span style="color: #F2CC8F; cursor: pointer;">Student</span>
              </label>
            </div>

            <div class="form-check mb-4">
              <input
                class="form-check-input"
                type="checkbox"
                value="professor"
                name="user_type"
                id="flexCheckDefault2"
              />
              <label class="form-check-label" for="flexCheckDefault2">
                <span style="color: #F2CC8F; cursor: pointer;">Professor</span>
              </label>
            </div>
          </div>
              
                <div class="row justify-content-center align-items-center">
                  <div class="col-lg-5 col-12">
                    <button type="submit" class="form-control">Login</button>
                  </div>

                  <div class="col-lg-5 col-12">
                    <a
                      href="register.php"
                      class="btn custom-btn custom-border-btn"
                      >Register</a
                    >
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="video-wrap">
          <video autoplay="" loop="" muted="" class="custom-video" poster="">
            <source src="videos/flag1.mp4" type="video/mp4" />

            Your browser does not support the video tag.
          </video>
        </div>
      </section>
    </main>

    <script>
    document.addEventListener("DOMContentLoaded", (event) => {
  const loginForm = document.querySelector(".login-form");
  loginForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const studentChecked = document.getElementById("flexCheckDefault1").checked;
    const professorChecked = document.getElementById("flexCheckDefault2").checked;

    if (studentChecked) {
      window.location.href = 'student-login.html';
    } else if (professorChecked) {
      window.location.href = 'professor-login.html';
    } else {
      // No checkboxes are checked, or some other logic you want to implement
      alert("Please select an option.");
    }
  });
});

    </script>

    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/countdown.js"></script>
    <script src="js/init.js"></script>
  </body>
</html>
