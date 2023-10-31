<?php
// Sources used: https://cs4640.cs.virginia.edu
class AdonisController
{
    private $categories;
    private $db;
    private $input = [];

    private $errorMessage = "";



    /**
     * Constructor
     */
    public function __construct($input)
    {
        session_start();
        $this->db = new Database();
        $this->input = $input;

    }

    // public function request_Colors($colorid=null){
    //     if ($colorid === null) {
    //         $res = $this->db->query("select * from questions order by random() limit 1;");

    //         return [ "id" => $res[0]["id"], "question" => $res[0]["question"]];
    //     }
    //     if (is_numeric($colorid)) {
    //         $res = $this->db->query("select * from questions where id = $1;", $colorid);
    //         if (empty($res)) {
    //             return false;
    //         }
    //         return $res[0];
    //     }
    //     return false;
    // }


    /**
     * Run the server
     * 
     * Given the input (usually $_GET), then it will determine
     * which command to execute based on the given "command"
     * parameter.  Default is the welcome page.
     */
    public function run()
    {
        // Get the command
        $command = "welcome";
        if (isset($this->input["command"])) {
            $command = $this->input["command"];
            // if (!isset($_SESSION["name"]) && !isset($_SESSION["email"]) && !isset($_SESSION["password"])) {
            //     if (isset($_POST["fullname"]) && isset($_POST["email"]) && isset($_POST["password"])) {
            //         $this->showhome();
            //     } else {
            //         $this->login();
            //     }
            //     return;
            // }
        }
        switch ($command) {
            case "login":
                $this->login();
                break;
            case "register":
                $this->register();
                break;
            case "showRegister":
                $this->showRegister();
                break;
            case "viewProfile":
                $this->viewProfile();
                break;
            case "editProfile":
                $this->editProfile();
                break;
            case "homepage":
                $this->showHome();
                break;
            case "logout":
                $this->logout();
            default:
                $this->showLogin();
                break;
        }
    }



    /**
     * Handle user registration and log-in
     */
    public function login()
    {
        // need a name, email, and password
        if (
            isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["username"]) && !empty($_POST["username"]) &&
            isset($_POST["password"]) && !empty($_POST["password"])
        ) {

            // Check if user is in database
            $res = $this->db->query("select * from users where email = $1;", $_POST["email"]);
            if (empty($res)) {
                $this->register();
                return;
            } else {
                // User was in the database, verify password
                if (password_verify($_POST["password"], $res[0]["password"])) {
                    // Password was correct
                    $_SESSION["email"] = $res[0]["email"];
                    $_SESSION["username"] = $res[0]["username"];
                    header("Location: ?command=homepage");
                    return;
                } else {
                    $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                Password is incorrect!
                </div>";
                }
            }
        } else {
            $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
            Email, Username, and Password are all required!
            </div>";
        }
        // If something went wrong, show the welcome page again
        $this->showLogin();
    }

    /**
     * Handle user registration
     */
    public function showLogin()
    {
        $errorMessage = $this-> errorMessage; 
        include("front-end/pages/login.php");
    }

    /**
     * Handle user registration
     */
    public function register()
    {
        $this->setUserInfo();

        if (
            isset($_POST["username"]) && !empty($_POST["username"]) &&
            isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["password"]) && !empty($_POST["password"])
        ) {

            // Check if user is in database
            $res = $this->db->query("select * from users where email = $1;", $_POST["email"]);
            if (empty($res)) {
                // User was not there, so insert them
                $this->db->query(
                    "insert into users (name, email, password) values ($1, $2, $3);",
                    $_POST["username"],
                    $_POST["email"],
                    password_hash($_POST["password"], PASSWORD_DEFAULT)
                );
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["email"] = $_POST["email"];
                // Send user to the login page
                header("Location: ?command=showLogin");
                return;
            } else{
                $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                User already exists!
                </div>";
            }
        } else {
            $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
            Email, Username, and Password are all required!
            </div>";
        }
        $this -> showRegister();
    }

    /**
     * Checks user information during log-in
     */
    public function showRegister()
    {
        include("front-end/pages/register-profile.php");
    }

    /**
     * Checks user information during log-in
     */
    public function checkUserInfo()
    {

    }

    /**
     * Allows user to view profile
     */
    public function viewProfile()
    {

        include("front-end/pages/profile.php");

    }

    /**
     * Allows user to edit profile
     */
    public function editProfile()
    {

        include("front-end/pages/edit-profile.php");

    }

    /**
     * Gets connection table and sets categories
     * 
     * Returns a table with random connections
     */
    private function setTable()
    {
        $_SESSION["categoryIDs"] = array_rand($this->categories, 4);


        foreach ($_SESSION["categoryIDs"] as $index) {
            // foreach($this -> categories[$index]["words"] as $word){
            //     array_push($_SESSION["table"], $word);
            // }
            // array_push($_SESSION["tableCategories"]["wordIDs"], $this -> categories[$index]);
            $set = (array) $this->categories[$index]["words"];
            // array_push($_SESSION["table"], ...$set);
            for ($x = 0; $x < sizeof($set); $x++) {
                //rand int to randomize id
                array_push($_SESSION["table"], $set[$x]);
            }
        }

        shuffle($_SESSION["table"]);
        $_SESSION["table"] = array_combine(range(1, sizeof($_SESSION["table"])), $_SESSION["table"]);

    }


    /**
     * Sets User Information within database
     * 
     * Storage of User information
     */
    private function setUserInfo()
    {
        if (!isset($_SESSION["name"]) && isset($_POST["fullname"])) {
            $_SESSION["name"] = $_POST["fullname"];
        }

        if (!isset($_SESSION["email"]) && isset($_POST["email"])) {
            $_SESSION["email"] = $_POST["email"];
        }

        if (!isset($_SESSION["password"]) && isset($_POST["password"])) {
            $_SESSION["password"] = $_POST["password"];
        }

        $this->setTable();

    }


    /**
     * Show the welcome page to the user.
     */
    public function showHome()
    {
        include("front-end/pages/home.php");
    }
    /**
     * Game Over redirect after user loses game.
     */
    public function gameOver($win = false)
    {
        $name = $_SESSION["name"];
        $email = $_SESSION["email"];
        $password = $_SESSION["password"];
        $numGuesses = $_SESSION["numGuesses"];
        $categories = $this->categories;
        $categoryIDs = $_SESSION["categoryIDs"];
        $priorGuesses = $_SESSION["priorGuesses"];
        include("pages/gameover.php");
    }

    /**
     * Log out the user
     */
    public function logout()
    {
        session_destroy();
        session_start();
    }

}