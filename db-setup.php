<?php
// Sources used: https://cs4640.cs.virginia.edu
// Authors: Alex Kim (database set up, user table creation), Jason Nguyen (color preferences table creation)
// Note that these are for the local Docker container

// $host = "localhost";
// $port = "5432";
// $database = "ajk5qwb";
// $user = "ajk5qwb";
// $password = "iY6pjYWmL_BT";

$host = "db";
$port = "5432";
$database = "example";
$user = "localuser";
$password = "cs4640LocalUser!";

$dbHandle = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");

if ($dbHandle) {
    echo "Success connecting to database";
} else {
    echo "An error occurred connecting to the database";
}

// Drop tables and sequences
$res = pg_query($dbHandle, "drop sequence if exists question_seq;");
$res = pg_query($dbHandle, "drop sequence if exists user_seq;");
$res = pg_query($dbHandle, "drop sequence if exists userquestion_seq;");
$res = pg_query($dbHandle, "drop table if exists questions;");
$res = pg_query($dbHandle, "drop table if exists users;");

// Create sequences
$res = pg_query($dbHandle, "create sequence user_seq;");
$res = pg_query($dbHandle, "create sequence color_seq;");

// Create color preferences table
$res = pg_query($dbHandle, "create table colorPreferences (
            id int primary key,
            black boolean,
            white boolean,
            red boolean,
            blue boolean,
            brown boolean,
            grey boolean
    );");

// Create user  table
$res = pg_query($dbHandle, "create table users (
            id int primary key default nextval('user_seq'),
            email text unique,
            username text unique,
            age text,
            firstname text,
            lastname text,
            password text
        );");

// // Create outfit color table
// $res = pg_query($dbHandle, "create table outfits (
//     id int primary key default nextval('color_seq'),
//     season text,
//     outerwear text,
//     shirt text,
//     pants text,
//     shoes text,

// );");

?>

<!-- <script type="text/javascript" src="outfits.js"></script>
<h2>Data Loading Status: <div id="status">
        <div>
</h2> -->

<!-- <script>
    if (document.getElementById("status").innerText == "Finished!") { -->
        <!-- <?php
        $json = file_get_contents('php://input', true);
        $msg = json_decode($json);
        var_dump($msg);
        ?> -->
    <!-- }
</script> -->