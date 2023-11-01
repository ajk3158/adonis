
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

  <meta name="author" content="Alex Kim, Jason Nguyen">
  <meta name="description" content="User Profile page for Adonis members where they can view personal information">
  <meta name="keywords" content="Clothing, Fashion, Homepage">

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

      <div class="nav-item dropdown nav-profile">
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
        <li><a href="?command=viewColorPrefs">Color Preferences</a></li>
        <li><a href="#">Color Rejections</a></li>
      </ul>
    </div>

    <!-- Form to edit Profile Information -->
    <form action="?command=updateProfile" method="post">

      <div class="form-group">
        <label for="edit_firstname">First Name</label>
        <input type="text" class="form-control form-control-name " id="edit_firstname" name = edit_firstname placeholder="first name" >
      </div>

      <div class="form-group">
        <label for="edit_lastname">Last Name</label>
        <input type="text" class="form-control form-control-name" id="edit_lastname" name= edit_lastname placeholder="last name" >
      </div>

      <div class="form-group">
        <label for="edit_age">Age</label>
        <input type="text" id="edit_age" name="edit_age" class="form-control form-control-name" placeholder="##" >
      </div>

      <div class="form-group">
        <label for="edit_username">Username</label>
        <input type="text" class="form-control form-control-name" id="edit_username" name = "edit_username" placeholder="example" >
      </div>

      <div class="form-group">
        <label for="edit_email">Email address</label>
        <input type="email" class="form-control" id="edit_email" name = "edit_email" placeholder="example@gmail.com" >
      </div>
     
      <div>
          <button class="btn btn-outline-dark" type="submit">Update</button>
      </div>
      <!-- Edit Profile Button
      <div class="form-group">
        <a class="forgot-link" href="#"><u>Edit Profile</u></a>
      </div>-->
    </form>

  </div>
</body>

</html>