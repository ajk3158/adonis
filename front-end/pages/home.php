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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <script>
    var outfitChoices = [];
    var url = "http://colormind.io/api/";
    var data = { model: "default" };

    var preferredColors = <?php echo json_encode($userColors); ?>;

    var http = new XMLHttpRequest();

    (function loop(i, length) {
      if (i >= length) {
        $("#status").empty();
        $("input[type=checkbox]").attr('disabled', false);
        changeColor();
        changeSeason();
        return;
      }

      http.open("POST", url, true);
      http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
          var colors = JSON.parse(http.responseText).result;
          let outfit = {};
          outfit.id = i + 1;
          outfit.genColors = [];
          for (let j = 0; j < 3; j++) {
            let r = colors[j][0];
            let g = colors[j][1];
            let b = colors[j][2];
            outfit.genColors.push(classifyColor(r, g, b));
            colors[j] = "rgb(" + r + "," + g + "," + b + ")";
          }
          outfit.genColors = Array.from(new Set(outfit.genColors));
          if (preferredColors.length > 0 && (preferredColors.some(item => outfit.genColors.includes(item))) == false) {
            loop(i, length);
            return;
          }
          if (i < 15) {
            outfit.outerwear = colors[2];
            outfit.shirt = colors[2];
            outfit.pants = colors[1];
            outfit.shoes = colors[0];
            outfit.season = "Winter";
          } else if (i < 30) {
            outfit.shirt = colors[1];
            outfit.pants = colors[1];
            outfit.outerwear = colors[2];
            outfit.shoes = colors[0];
            outfit.season = "Spring";
          } else if (i < 45) {
            outfit.outerwear = colors[0];
            outfit.shirt = colors[1];
            outfit.pants = colors[2];
            outfit.shoes = colors[1];
            outfit.season = "Summer";
          } else {
            outfit.outerwear = colors[0];
            outfit.pants = colors[0];
            outfit.shirt = colors[1];
            outfit.shoes = colors[2];
            outfit.season = "Fall";
          }
          setOutfits(outfit);
          document.getElementById("status").innerHTML = "<h3>Loading... -> " + (i + 1) + "/" + length + "</h3><p>(queries will not be in effect during load)</p>";
          loop(i + 1, length);
        }
      }
      http.send(JSON.stringify(data));
    })(0, 20);

    // function saveOutfits(){


    // }

    // function getOutfits(){
    //   $.get(
    //         "index.php",
    //         { command: "getOutfits" },
    //         function (response) {
    //           if(response )
    //         }
    //       );
    // }


    setOutfits = (outfit) => {
      outfitChoices.push(outfit);
      let card = '<div class="card bg-light mb-3 ' + outfit.season + '" style="max-width: 17rem; width: 17rem;">';
      card += '<div class="card-header">' + outfit.season + ' Outfit</div>';
      card += '<div class="card-body">';
      card += '<small class="white" style="margin-bottom:1rem;"> Outfit ID: ' + outfit.id + '</small>';
      card += '<h4 class="card-title" style="color:' + outfit.outerwear + '">Outerwear</h4>';
      card += '<h4 class="card-title" style="color:' + outfit.shirt + '">Shirt</h4>';
      card += '<h4 class="card-title" style="color:' + outfit.pants + '">Pants</h4>';
      card += '<h4 class="card-title" style="color:' + outfit.shoes + '">Shoes</h4>';
      card += '<h5 class="card-text"> General colors: ' + outfit.genColors.join(", ") + '</h5>';
      card += '<button class="btn btn-outline-dark btn-card" type="submit">Save Outfit</button></div></div>';

      $("#rec-outfits").append(card);

      // <div class="card bg-light mb-3" style="max-width: 18rem;">
      //       <div class="card-header">Fall Outfit</div>
      //       <div class="card-body">
      //         <h4 class="card-title" style="color:brown">Outerwear</h4>
      //         <h4 class="card-title white">Shirt</h4>
      //         <h4 class="card-title" style="color:black">Pants</h4>
      //         <h4 class="card-title white">Shoes</h4>
      //         <p class="card-text">A perfect outfit that is simple and creative!</p>
      //         <button class="btn btn-outline-dark btn-card" type="submit">More details</button>
      //       </div>
      //     </div>
    }

    function manhattan(x1, x2, x3, y1, y2, y3) {
      return Math.abs(x1 - y1) + Math.abs(x2 - y2) + Math.abs(x3 - y3);
    }

    function classifyColor(r, g, b) {
      colors = {
        "red": [255, 0, 0],
        "red": [128, 80, 40],
        "red": [209, 163, 209],
        "red": [166, 43, 66],
        "black": [0, 0, 0],
        "black": [40, 40, 40],
        "green": [0, 255, 0],
        "green": [0, 128, 0],
        "green": [159, 209, 6],
        "white": [255, 255, 255],
        "white": [215, 215, 215],
        "blue": [0, 0, 255],
        "blue": [164, 211, 128],
        "blue": [68, 165, 237],
        "brown": [150, 75, 0],
        "brown": [120, 71, 23],
        "brown": [79, 63, 45],
        "grey": [128, 128, 128]
      }
      let min = 1000000;
      let color = "";
      Object.keys(colors).forEach((key) => {
        let result = manhattan(r, g, b, colors[key][0], colors[key][1], colors[key][2]);
        if (result < min) {
          color = key;
          min = result;
        }
      });
      return color;

    }

    $(document).ready(function () {
      if (!($("#color-options").length)) {
        $("#color-schematic").replaceWith("<h2>*User has no preferred colors!*</h2>");
      }
    });

    function changeColor() {
      $("#color-button").on("click", function () {
        $(".card").removeClass("Processed")
        for (index in preferredColors) {
          if (!($("#color" + preferredColors[index]).is(':checked'))) {
            $(".card:contains(" + preferredColors[index] + ")").css({
              display: "none"
            }).addClass("Processed");

          } else {
            $(".card:contains(" + preferredColors[index] + ")").each(function () {
              if (!$(this).hasClass("Processed")) {
                $(this).css({
                  display: "inline"
                });
              }
            })
          }
        }
      });
    }

    function changeSeason() {
      $("#season-button").on("click", function () {
        const seasons = ["Winter", "Spring", "Fall", "Summer"];
        seasons.forEach(function (element) {
          if (!($("#" + element + "Button").is(':checked'))) {
            $("." + element).css({
              display: "none"
            });
          } else {
            $("." + element).css({
              display: "inline"
            });
          }
        });
      });
    }

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
        <li class="nav-item">
          <a class="nav-link" href="#">Explore by Season</a>
        </li>
      </ul>

      <div class="nav-item dropdown nav-profile">
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
      <div id="left-side-bar" class="col-3 side-element">
        <!-- User's Preferred Color Schematic Functionality -->
        <div id="color-schematic" class="container">
          <h2>Recommended Color Schematics</h2>

          <?php foreach ($userColors as $color):
            ?>

            <div id="color-options" class="container left-queries">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="color<?= $color ?>" checked disabled>
                <label class="form-check-label" for="color<?= $color ?>">
                  <?= $color ?>
                </label>
              </div>
            </div>
          <?php
          endforeach; ?>

          <!-- Expands Color Schematic List -->
          <button id="color-button" class="btn btn-outline-dark">Apply Changes</button>
        </div>

        <!-- User's Preferred Seasons Functionality -->
        <div class="container">
          <h2>Seasons</h2>

          <div class="container left-queries">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="WinterButton" checked disabled>
              <label class="form-check-label" for="WinterButton">Winter</label>
            </div>


            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="SpringButton" checked disabled>
              <label class="form-check-label" for="SpringButton">Spring</label>
            </div>

            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="SummerButton" checked disabled>
              <label class="form-check-label" for="SummerButton">Summer</label>
            </div>

            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="FallButton" checked disabled>
              <label class="form-check-label" for="FallButton">Fall</label>
            </div>
          </div>

          <!-- Clear Selected User Choices -->
          <button id="season-button" class="btn btn-outline-dark">Apply Changes</button>
        </div>
      </div>

      <!-- Recommended Outfit Designs based on User Preferences -->
      <section class="container col-6">
        <div class="app-logo">
          <h1 class="app-brand">ADONIS</h1>
          <img class="app-brand-image" alt="ADONIS logo" src="front-end/assets/logo.png">
        </div>

        <h1>Recommended Outfits</h1>

        <h3 id="status"></h3>

        <!-- Cards for Each Outfit -->
        <div class="container rec-outfits" id="rec-outfits">
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
</body>

</html>