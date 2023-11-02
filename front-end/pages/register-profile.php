<!-- Purpose: users will have the ability to register a profile with ADONIS so they can access the website's contents -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="front-end/styles/app.css">
  <link rel="stylesheet" href="front-end/styles/register-profile.css">

  <!-- Webpage Title -->
  <title>Homepage - ADONIS</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

  <meta name="author" content="Alex Kim (html, css, php), Jason Nguyen (html)">
  <meta name="description" content="register profile, where users create their profile">
  <meta name="keywords" content="Clothing, Fashion, Homepage">

</head>

<body class="text-center">
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span\>
    </button>
    <div class="nav-item nav-primary">
      <a class="nav-link" href="?command=showLogin">ADONIS</a>
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

    <!-- Primary Register Profile Content -->
    <section class="container">
      <h2>Join ADONIS</h2>

      <small class="form-text">Revolutionize your fashion, Take control of your wear.</small>

      <?php echo $errorMessage; ?>

      <!-- Form to Register Profile -->
      <form action="?command=register" method="post">
        <div class="form-group">
          <label for="first-name-input">First Name</label>
          <input type="text" class="form-control form-control-name" name="firstname" id="first-name-input"
            placeholder="Enter first name">
        </div>
        <div class="form-group">
          <label for="last-name-input">Last Name</label>
          <input type="text" class="form-control form-control-name" name="lastname" id="last-name-input"
            placeholder="Enter last name">
        </div>

        <div class="form-group">
          <label for="age">Age</label>
          <input type="range" id="age" name="age" value="50" min="0" max="100" oninput="range_output.value = value"
            class="form-range">
          <output id="range_output">50</output> years old

        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control form-control-name" name="username" id="username"
            placeholder="Username">
          <small style="font-size: 12px;">Username length must be at least 5 characters but below 20 characters</small>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control form-control-name" name="password" id="password"
            placeholder="Password">
          <small style="font-size: 12px;">Password length must be at least 8 characters</small>
        </div>
        <div class="form-group">
          <label for="email-input">Email address</label>
          <input type="email" class="form-control" id="email-input" name="email" placeholder="Enter email">
        </div>
        <!-- Submit Button -->
        <button type="submit" class="form-submit-btn btn">Submit</button>
      </form>

    </section>

  </div>
</body>

</html>