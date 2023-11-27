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

  <meta name="author" content="Alex Kim (html, css), Jason Nguyen (html, css)">
  <meta name="description" content="User Profile page for Adonis members where they can view personal information">
  <meta name="keywords" content="Clothing, Fashion, Homepage">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <script>

    function showUsers(userList) {
      $("#seeAllUsers").text("Collapse Table");

      $("#user-table").append("<thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Age</th><th>Email</th></tr></thead><tbody>");

      for (let i = 0; i < userList.length; i++) {
        let row = "<tr><td>" + userList[i].id + "</td><td>" + userList[i].firstname + "</td><td>" + userList[i].lastname + "</td><td>" + userList[i].age + "</td><td>" + userList[i].email + "</td></tr>";
        $("#user-table").append(row);
      }

      $("#user-table").append("<tbody>");

    }

    // function collapseUsers(){
    //   if ($("#user-table").children().length > 0) {

    //     $("#seeAllUsers").on("click", function () {
    //       $("#user-table").empty();


    //     });
    //   }
    // }

    $(document).ready(function () {
      // Event handler for when the game starts
      $("#seeAllUsers").on("click", function () {
        if ($("#user-table").children().length > 0) {
          $("#user-table").empty();
          $("#seeAllUsers").text("SEE ALL USERS");
        } else {
          // Query the back-end
          $.get(
            "index.php",
            { command: "getAllUsers" },
            function (response) {
              // Handle the response to display the users
              console.log(response);
              showUsers(response);
              // collapseUsers();
            }
          );
        }
      });

    });
  </script>
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
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">Explore by Season</a>
        </li> -->
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

    <!-- Form Displaying Profile Information -->
    <form action="?command=editProfile" method="post">

      <div class="form-group">
        <label for="first-name-input">First Name</label>
        <input type="text" class="form-control form-control-name " id="first-name-input" placeholder=<?= $firstname ?>
          disabled>
      </div>

      <div class="form-group">
        <label for="last-name-input">Last Name</label>
        <input type="text" class="form-control form-control-name" id="last-name-input" placeholder=<?= $lastname ?>
          disabled>
      </div>

      <div class="form-group">
        <label for="age">Age</label>
        <input type="text" id="age" name="age" class="form-control form-control-name" placeholder=<?= $age ?> disabled>


      </div>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control form-control-name" id="username" placeholder=<?= $username ?> disabled>
      </div>

      <div class="form-group">
        <label for="email-input">Email address</label>
        <input type="email" class="form-control" id="email-input" placeholder=<?= $email ?> disabled>
      </div>


      <!-- Edit Profile Button-->
      <button class="btn btn-outline-dark m-1" type="submit">Edit Profile</button>
      <!-- See all Users Button -->
      <button class="btn btn-outline-dark m-1" id="seeAllUsers" type="button">See all Users</button>
    </form>

    <section class="table-container">
      <table id="user-table">

      </table>

    </section>

  </div>
  <script>
    //hover nav bar top right
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