<?php
// Sources used: https://cs4640.cs.virginia.edu, Published Site: https://cs4640.cs.virginia.edu/ajk5qwb/ADONIS/
// Author: Alex Kim, Jason Nguyen
spl_autoload_register(function ($classname) {
    include "$classname.php";
});


$adonis = new AdonisController($_GET);

$adonis->run();