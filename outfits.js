var palette = [];
var url = "http://colormind.io/api/";
var data = { model: "default" };

var http = new XMLHttpRequest();
(function loop(i, length) {
    if (i >= length) {
        http.open("POST", "db-setup.php", true);
        // Send the proper header information along with the request
        http.setRequestHeader("Content-Type", "application/json");

        http.onreadystatechange = () => {
          // Call a function when the state changes.
          if (http.readyState == 4 && http.status == 200) {
            console.log("WORKED");
          }
        };
        http.send(JSON.stringify(palette));
        document.getElementById("status").innerText = "Finished!";
        return;
    }

    http.open("POST", url, true);
    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            let colors = JSON.parse(http.responseText).result;
            let outfit = {};
            if (i < 25) {
                outfit.outerwear = colors[2];
                outfit.shirt = colors[2];
                outfit.pants = colors[1];
                outfit.shoes = colors[3];
                outfit.season = "Winter";
            } else if (i < 50) {
                outfit.shirt = colors[1];
                outfit.pants = colors[1];
                outfit.outerwear = colors[0];
                outfit.shoes = colors[3];
                outfit.season = "Spring";
            } else if (i < 75) {
                outfit.outerwear = colors[0];
                outfit.shirt = colors[1];
                outfit.pants = colors[2];
                outfit.shoes = colors[1];
                outfit.season = "Summer";
            } else {
                outfit.outerwear = colors[0];
                outfit.pants = colors[0];
                outfit.shirt = colors[1];
                outfit.shoes = colors[3];
                outfit.season = "Fall";
            }
            palette.push(outfit);
            document.getElementById("status").innerText = "Loading... -> " + (i + 1) + "/" + length;
            loop(i + 1, length);
        }
    }
    http.send(JSON.stringify(data));
})(0, 20);