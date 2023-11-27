<!-- Purpose: users will have the ability to register a profile with ADONIS so they can access the website's contents -->
<!-- https://cs4640.cs.virginia.edu/ajk5qwb/ADONIS/front-end/pages/-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="front-end/styles/app.css">
  <link rel="stylesheet" href="front-end/styles/homepage.css">

  <!-- Webpage Title -->
  <title>Register - ADONIS</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <meta name="author" content="Alex Kim (php, html, css)">
  <meta name="description"
    content="Profile Home page - On this web page, users will be able to experience all of the core functionalities ADONIS offers when they first enter the site">
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
          Welcome,
          <?= $firstname ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="?command=viewProfile">View Profile</a>
          <a class="dropdown-item" href="?command=editProfile">Edit Profile</a>
          <a class="dropdown-item" href="?command=logout">Logout</a>
        </div>
      </div>

    </div>
  </nav>
  <?php var_dump($firstname) ?>
  <!-- HomePage Content -->
  <div style="margin-top: 6rem">
    <div class="row">

      <!-- Left-Side Elements -->
      <div class="col-3 side-element">
        <!-- User's Preferred Color Schematic Functionality -->
        <div class="container">
          <h2>Recommended Color Schematics</h2>

          <div class="container left-queries">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="colorScheme1">
              <label class="form-check-label" for="colorScheme1">Red/Brown</label>
            </div>


            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="colorScheme2">
              <label class="form-check-label" for="colorScheme2">Black/White</label>
            </div>

            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="colorScheme3">
              <label class="form-check-label" for="colorScheme3">Light Brown/Dark Brown</label>
            </div>
          </div>

          <!-- Expands Color Schematic List -->
          <button class="btn btn-outline-dark">Expand</button>
        </div>

        <!-- User's Preferred Seasons Functionality -->
        <div class="container">
          <h2>Seasons</h2>

          <div class="container left-queries">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="Winter">
              <label class="form-check-label" for="Winter">Winter</label>
            </div>


            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="Spring">
              <label class="form-check-label" for="Spring">Spring</label>
            </div>

            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="Summer">
              <label class="form-check-label" for="Summer">Summer</label>
            </div>

            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="Fall">
              <label class="form-check-label" for="Fall">Fall</label>
            </div>
          </div>

          <!-- Clear Selected User Choices -->
          <button class="btn btn-outline-dark">clear</button>
        </div>
      </div>

      <!-- Recommended Outfit Designs based on User Preferences -->
      <section class="container col-6">
        <div class="app-logo">
          <h1 class="app-brand">ADONIS</h1>
          <img class="app-brand-image" alt="ADONIS logo" src="front-end/assets/logo.png">
        </div>

        <h1>Recommended Outfits</h1>

        <!-- Cards for Each Outfit -->
        <div class="container rec-outfits">

          <div class="card bg-light mb-3" style="max-width: 18rem;">
            <div class="card-header">Fall Outfit</div>
            <div class="card-body">
              <h4 class="card-title" style="color:brown">Outerwear</h4>
              <h4 class="card-title white">Shirt</h4>
              <h4 class="card-title" style="color:black">Pants</h4>
              <h4 class="card-title white">Shoes</h4>
              <p class="card-text">A perfect outfit that is simple and creative!</p>
              <button class="btn btn-outline-dark btn-card" type="submit">More details</button>
            </div>
          </div>

          <div class="card bg-light mb-3" style="max-width: 18rem;">
            <div class="card-header">Fall Outfit</div>
            <div class="card-body">
              <h4 class="card-title" style="color:brown">Outerwear</h4>
              <h4 class="card-title white">Shirt</h4>
              <h4 class="card-title" style="color:black">Pants</h4>
              <h4 class="card-title white">Shoes</h4>
              <p class="card-text">A perfect outfit that is simple and creative!</p>
              <button class="btn btn-outline-dark btn-card" type="submit">More details</button>
            </div>
          </div>

          <div class="card bg-light mb-3" style="max-width: 18rem;">
            <div class="card-header">Fall Outfit</div>
            <div class="card-body">
              <h4 class="card-title" style="color:brown">Outerwear</h4>
              <h4 class="card-title white">Shirt</h4>
              <h4 class="card-title" style="color:black">Pants</h4>
              <h4 class="card-title white">Shoes</h4>
              <p class="card-text">A perfect outfit that is simple and creative!</p>
              <button class="btn btn-outline-dark btn-card" type="submit">More details</button>
            </div>
          </div>

          <div class="card bg-light mb-3" style="max-width: 18rem;">
            <div class="card-header">Fall Outfit</div>
            <div class="card-body">
              <h4 class="card-title" style="color:brown">Outerwear</h4>
              <h4 class="card-title white">Shirt</h4>
              <h4 class="card-title" style="color:black">Pants</h4>
              <h4 class="card-title white">Shoes</h4>
              <p class="card-text">A perfect outfit that is simple and creative!</p>
              <button class="btn btn-outline-dark btn-card" type="submit">More details</button>
            </div>
          </div>

        </div>
      </section>

      <!-- Right-Side Element (User Search Functionality) -->
      <div class="col-3 side-element">
        <h2>Search</h2>
        <form class="form-inline">
          <input class="form-control mr-sm-2" type="search" placeholder="Red/Winter/etc." aria-label="Search">
          <button class="btn btn-outline-dark" type="submit">Search</button>
        </form>
      </div>
    </div>
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