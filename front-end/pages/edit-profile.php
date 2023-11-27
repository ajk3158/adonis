<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="front-end/styles/app.css">
  <link rel="stylesheet" href="front-end/styles/profile.css">

  <!-- Webpage Title -->
  <title>User Profile - ADONIS</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

  <meta name="author" content="Alex Kim (php), Jason Nguyen (html, css)">
  <meta name="description" content="User Profile page for Adonis members where they can view personal information">
  <meta name="keywords" content="Clothing, Fashion, Homepage">
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
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">Explore by Color</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Explore by Season</a>
        </li>
      </ul>

      <!--Sidebar dropdown-->
      <div class="nav-item dropdown nav-profile" id="profileDropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <?php echo $firstname ?>'s Profile
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="?command=viewProfile">View Profile</a>
          <a class="dropdown-item" href="?command=editProfile">Edit Profile</a>
          <a class="dropdown-item" href="?command=logout">Logout</a>
        </div>
      </div>

    </div>
  </nav>

  <!-- Primary Content for Login -->
  <div style="margin-top: 6rem">


    <!-- Side Navigtion Bar -->
    <div class=navbar-side>
      <ul style="list-style-type: none; margin-top: 5rem;">
        <li><a href="?command=viewProfile">Profile</a></li>
        <li><a href="#">Password & Security</a></li>
        <li><a href="?command=viewColorPreferences">Color Preferences</a></li>
        <li><a href="#">Color Rejections</a></li>
      </ul>
    </div>

    <!-- Form to edit Profile Information -->
    <form id="profileForm" action="?command=updateProfile" method="post">

      <div class="form-group">
        <label for="edit_firstname">First Name</label>
        <input type="text" class="form-control form-control-name" id="edit_firstname" name="edit_firstname"
          placeholder="First name">
        <span id="firstnameError" class="error"></span>
      </div>

      <div class="form-group">
        <label for="edit_lastname">Last Name</label>
        <input type="text" class="form-control form-control-name" id="edit_lastname" name="edit_lastname"
          placeholder="Last name">
        <span id="lastnameError" class="error"></span>
      </div>

      <div class="form-group">
        <label for="edit_age">Age</label>
        <input type="text" id="edit_age" name="edit_age" class="form-control form-control-name" placeholder="##">
        <span id="ageError" class="error"></span>
      </div>

      <div class="form-group">
        <label for="edit_username">Username</label>
        <input type="text" class="form-control form-control-name" id="edit_username" name="edit_username"
          placeholder="Username">
        <span id="usernameError" class="error"></span>
      </div>

      <div class="form-group">
        <label for="edit_email">Email address</label>
        <input type="text" class="form-control" id="edit_email" name="edit_email" placeholder="example@gmail.com">
        <span id="emailError" class="error"></span>
      </div>

      <div>
        <button class="btn btn-outline-dark" type="submit">Update</button>
      </div>
    </form>


  </div>
  <script>

    /*Sources used: https://developer.mozilla.org/en-US/docs/Web/API/Element/mouseenter_event
    https://developer.mozilla.org/en-US/docs/Web/API/Element/mouseleave_event
    */
    function validateForm() {
      // Reset previous error messages
      document.getElementById('firstnameError').textContent = '';
      document.getElementById('lastnameError').textContent = '';
      document.getElementById('ageError').textContent = '';
      document.getElementById('usernameError').textContent = '';
      document.getElementById('emailError').textContent = '';

      // Get form data
      const firstname = document.getElementById('edit_firstname').value;
      const lastname = document.getElementById('edit_lastname').value;
      const age = document.getElementById('edit_age').value;
      const username = document.getElementById('edit_username').value;
      const email = document.getElementById('edit_email').value;

      // Perform client-side input validation
      let works = true;
      if (firstname === '') {
        document.getElementById('firstnameError').textContent = 'First Name cannot be empty';
        works = false;
      }

      if (lastname === '') {
        document.getElementById('lastnameError').textContent = 'Last Name cannot be empty';
        works = false;
      }

      if (age === '') {
        document.getElementById('ageError').textContent = 'Age cannot be empty';
        works = false;
      }

      if (username === '') {
        document.getElementById('usernameError').textContent = 'Username cannot be empty';
        works = false;
      }
      else {
        if (username.length < 5 || username.length >= 20) {
          document.getElementById('usernameError').textContent = 'Username length must be greater than or equal to 5 characters and below 20 characters!';
          works = false;
        }
      }

      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (email === '') {
        document.getElementById('emailError').textContent = 'Email cannot be empty';
        works = false;
      }
      else {
        if (emailRegex.test(email) === false) {
          document.getElementById('emailError').textContent = 'input is not a valid email address';
          works = false;
        }
      }

      return works;
    }

    document.getElementById('profileForm').addEventListener('submit', function (event) {//anonymous function
      // Prevent the default form submission
      event.preventDefault();
      if (validateForm()) {
        // If validation passes, manually submit the form
        event.target.submit();
      }
    });

    //hover nav bar top right
    const profileDropdown = document.getElementById('profileDropdown');

    profileDropdown.addEventListener('mouseenter', () => {
      // Show the dropdown menu when the cursor enters the nav item
      profileDropdown.querySelector('.dropdown-menu').classList.add('show');
    });

    profileDropdown.addEventListener('mouseleave', () => {//arrow function
      // Hide the dropdown menu when the cursor leaves the nav item
      profileDropdown.querySelector('.dropdown-menu').classList.remove('show');
    });

  </script>
</body>

</html>