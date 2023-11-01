<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="front-end/styles/app.css">
  <link rel="stylesheet" href="front-end/styles/login.css">
  <!-- Webpage Title -->
  <title>Login - ADONIS</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <meta name="author" content="Alex Kim, Jason Nguyen">
  <meta name="description" content="User Login Page. On this page, users will be able to login to their ADONIS profile in order
        to access the website's contents.">
  <meta name="keywords" content="Clothing, Fashion, Registration">

</head>

<body class="text-center">
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="nav-item nav-primary">
      <a class="nav-link" href="?command=homepage">ADONIS</a>
    </div>
    <div class="app-navbar-links collapse navbar-collapse" id="navbarNavDropdown">

      <!-- Navigation Bar Dropdown Bar -->
      <div class="nav-item dropdown nav-profile">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          Login
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href="?command=showLogin">Login</a>
          <a class="dropdown-item" href="?command=showRegister">Register</a>
        </div>
      </div>

    </div>
  </nav>

  <div style="margin-top: 6rem">

    <!-- Website logo -->
    <div class="app-logo">
      <h1 class="app-brand">ADONIS</h1>
      <img class="app-brand-image" alt="ADONIS logo" src="front-end/assets/logo.png">
    </div>

    <!-- Primary Login Section -->
    <section class="container">
      <h2>Join ADONIS</h2>

      <small class="form-text">Revolutionize your fashion, Take control of your wear.</small>

      <?php echo $errorMessage; ?>

      <!-- Form for User Login -->
      <form action="?command=login" method="post">


        <!-- Email Input -->
        <div class="form-group">
          <label for="username">Email</label>
          <input type="email" class="form-control form-control-name" id="email" name="email"
            placeholder="Example@gmail.com">
        </div>

        <!-- Username Input -->
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control form-control-name" id="username" name="username"
            placeholder="Username">
        </div>

        <!-- Password Input -->
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control form-control-name" id="password" name="password"
            placeholder="Password">
        </div>
        <div>
          <button type="submit" class="form-submit-btn btn">Login</button>
          <button formaction="?command=showRegister" class="form-submit-btn btn">Register</button>
        </div>

        <div class="form-group">
          <a class="forgot-link" href="#"><u>Forgot Your Password?</u></a>
        </div>
      </form>

    </section>

  </div>
</body>

</html>