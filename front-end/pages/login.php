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
  <meta name="author" content="Alex Kim (html, css, php), Jason Nguyen (html, css)">
  <meta name="description" content="User Login Page. On this page, users will be able to login to their ADONIS profile in order
        to access the website's contents.">
  <meta name="keywords" content="Clothing, Fashion, Registration">
  <style>
    .error {
      color: red;
    }
  </style>
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
      <div class="nav-item dropdown nav-profile" id="profileDropdown">
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
          <label for="email">Email</label>
          <input type="text" class="form-control form-control-name" id="email" name="email"
            placeholder="Example@gmail.com" value="<?php echo (isset($email)) ? $email : ''; ?>">
          <span id="emailError" class="error"></span>
        </div>

        <!-- Username Input -->
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control form-control-name" id="username" name="username" placeholder="Username"
            value="<?php echo (isset($username)) ? $username : ''; ?>">
          <span id="usernameError" class="error"></span>
        </div>

        <!-- Password Input -->
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control form-control-name" id="password" name="password"
            placeholder="Password">
          <span id="passwordError" class="error"></span>
        </div>
        <div>
          <!-- Login and Registration buttons -->
          <button type="submit" class="form-submit-btn btn" id="loginButton">Login</button>
          <button formaction="?command=showRegister" class="form-submit-btn btn">Register</button>
        </div>

      </form>


    </section>

  </div>
  <script>

    //sources used: https://developer.mozilla.org/en-US/docs/Web/API/Document/DOMContentLoaded_event
    //https://stackoverflow.com/questions/46155/how-can-i-validate-an-email-address-in-javascript
    //hover nav bar top right
    document.addEventListener("DOMContentLoaded", function () {
      const loginButton = document.getElementById("loginButton");
      const form = document.querySelector("form");
      loginButton.addEventListener("click", function (event) {
        // Flag to determine whether the form should be submitted
        let isValid = true;

        // Validate Email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const emailInput = document.getElementById("email");
        const emailError = document.getElementById("emailError");
        if (!emailInput.value.trim()) {
          emailError.innerText = "Email is required";
          isValid = false;
        } else {
          if (emailRegex.test(emailInput.value.trim()) === false) {
            document.getElementById('emailError').textContent = 'input is not a valid email address';
            isValid = false;
          }
          else {
            emailError.innerText = "";
          }
          
        }

        // Validate Username
        const usernameInput = document.getElementById("username");
        const usernameError = document.getElementById("usernameError");
        if (!usernameInput.value.trim()) {
          usernameError.innerText = "Username is required";
          isValid = false;
        } else {
          usernameError.innerText = "";
        }

        // Validate Password
        const passwordInput = document.getElementById("password");
        const passwordError = document.getElementById("passwordError");
        if (!passwordInput.value.trim()) {
          passwordError.innerText = "Password is required";
          isValid = false;
        } else {
          passwordError.innerText = "";
        }

        // Submit the form only if isValid is true
        if (!isValid) {
          event.preventDefault(); // Prevent form submission
        }
      });
    });



    const profileDropdown = document.getElementById('profileDropdown');

    profileDropdown.addEventListener('mouseenter', () => {
      // Show the dropdown menu when the cursor enters the nav item
      profileDropdown.querySelector('.dropdown-menu').classList.add('show');
    });

    profileDropdown.addEventListener('mouseleave', () => {
      // Hide the dropdown menu when the cursor leaves the nav item
      profileDropdown.querySelector('.dropdown-menu').classList.remove('show');
    });


  </script>>
</body>

</html>