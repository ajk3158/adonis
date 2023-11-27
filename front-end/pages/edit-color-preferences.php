<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="front-end/styles/app.css">
  <link rel="stylesheet" href="front-end/styles/profile.css">
  <link rel="stylesheet" href="front-end/styles/login.css">


  <!-- Webpage Title -->
  <title>Color Preferences Page - ADONIS</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

  <meta name="author" content="Alex Kim (php, html), Jason Nguyen (html)">
  <meta name="description" content="this is the color preferences part in a users profile, where
  users are able to specify which colors they prefer">
  <meta name="keywords" content="Clothing, Fashion, Homepage">

</head>

<body class="text-center">

  <!--Upper navigation bar-->
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
  <div style="margin-top: 6rem">

    <!--Side navigation bar for user profile-->
    <div class=navbar-side>
      <ul style="list-style-type: none; margin-top: 5rem;">
        <li><a href="?command=viewProfile">Profile</a></li>
        <li><a href="#">Password & Security</a></li>
        <li><a href="?command=viewColorPrefs">Color Preferences</a></li>
        <li><a href="#">Color Rejections</a></li>
      </ul>
    </div>


    <form action="?command=colorPref" method="post">

      <!--Checkbox code that displays in color preferences-->
      <div class="form-group" id="colorPreferences">
        <label>Color Preferences</label><br>
        <?php for ($x = 0; $x < sizeof($colors); $x++):
          $color = $colors[$x]["column_name"];
          if ($color == "id") {
            continue;
          } ?>
          <input type="checkbox" id="<?= $color ?>Check" name="<?= $color ?>Check" value="1" onchange="changeBackgroundColor(this)">
          <label for="<?= $color ?>Check">
            <?= $color ?>
          </label><br>
        <?php endfor; ?>
        <!-- Saves color preferences -->
        <div id="colorPreferencesDiv">
          <button class="btn btn-outline-dark">Save</button>
        </div>
      </div>
    </form>

  </div>
  <script>
    function changeBackgroundColor(checkbox) {
    // Get the color associated with the checkbox
    var color = checkbox.id.replace("Check", "").toLowerCase();

    // Get the colorPreferencesDiv
    var colorPreferencesDiv = document.getElementById("colorPreferences");

    // Change the background color based on checkbox state
    if (checkbox.checked) {
      colorPreferencesDiv.style.backgroundColor = color;
      setTimeout(function() {
        colorPreferencesDiv.style.backgroundColor = "";
      }, 300);
    } else {
      // You can set a default background color when the checkbox is unchecked
      colorPreferencesDiv.style.backgroundColor = "";
    }
  }

    const profileDropdown = document.getElementById('profileDropdown');

    profileDropdown.addEventListener('mouseenter', () => {
      // Show the dropdown menu when the cursor enters the nav item
      profileDropdown.querySelector('.dropdown-menu').classList.add('show');
    });

    profileDropdown.addEventListener('mouseleave', () => {
      // Hide the dropdown menu when the cursor leaves the nav item
      profileDropdown.querySelector('.dropdown-menu').classList.remove('show');
    });
  </script>
</body>

</html>