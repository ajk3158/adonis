<?php
// Sources used: https://cs4640.cs.virginia.edu
class AdonisController
{
    private $categories;
    private $db;
    private $iD;
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
            case "search":
                $this->search();
                break;
            case "showRegister":
                $this->showRegister();
                break;
            case "viewProfile":
                $this->viewProfile();
                break;
            case "viewColorPrefs":
                $this->viewColorPreferences();
                break;
            case "updateProfile":
                $this->updateProfile();
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

            if(preg_match("/^[a-zA-Z0-9\/.-]+@[a-zA-Z0-9\/-]+.[a-zA-Z0-9\/-]+$/", $_POST["email"])){


            // Check if user is in database
            $res = $this->db->query("select * from users where email = $1;", $_POST["email"]);
            if (empty($res)) {
                $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                Account doesn't exist!
                </div>";
                $this->showlogin();
                return;
            } else {
                // User was in the database, verify password
                if (password_verify($_POST["password"], $res[0]["password"])) {
                    // Password was correct
                    $_SESSION["id"] = $res[0]["id"];
                    $_SESSION["email"] = $res[0]["email"];
                    $_SESSION["username"] = $res[0]["username"];
                    $_SESSION["firstname"] = $res[0]["firstname"];
                    $_SESSION["age"] = $res[0]["age"];
                    $_SESSION["lastname"] = $res[0]["lastname"];
                    $this -> showHome();
                    return;
                } else {
                    $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                Password is incorrect!
                </div>";
                }
            }} else {
                $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                Email invalid! Must be in the format example@mail.com!
                </div>";
            }
        } else {
            $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
            Email, Username, and Password are all required!
            </div>";
        }
        // If something went wrong, show the welcome page again
        $this->showLogin();
    }
    //update information of specific users in database
    public function updateProfile(){
        if (isset($_SESSION["id"])){

            //Email update
            if (isset($_POST["edit_email"]) && !empty($_POST["edit_email"])){
                if (filter_var($_POST["edit_email"], FILTER_VALIDATE_EMAIL)){
                    $this->db->query("update users set email = $1 where id = $2", $_POST["edit_email"],$_SESSION["id"]);
                    $_SESSION["email"] = $_POST["edit_email"];
                }
                else{
                    $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                    Email format is incorrect!
                    </div>";
                }
            }
            else{
                $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                Email can not be empty!
                </div>";
            }

            //username 
            if (isset($_POST["edit_username"]) && !empty($_POST["edit_username"])){
                if (strlen($_POST["edit_username"]) < 20){
                    $this->db->query("update users set username = $1 where id = $2", $_POST["edit_username"],$_SESSION["id"]);
                }
                else{
                    $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                    Username is too long
                    </div>";
                }
            }
            else{
                $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                Username can not be empty!
                </div>";
            }

            //password
            if (isset($_POST["edit_password"]) && !empty($_POST["edit_password"])){
                if (strlen($_POST["edit_password"]) > 8){
                    $this->db->query("update users set password = $1 where id = $2", password_hash($_POST["password"], PASSWORD_DEFAULT),$_SESSION["id"]);
                }
                else{
                    $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                    Password is too short
                    </div>";
                }
            }
            else{
                $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                Password can not be empty!
                </div>";
            }

            //age
            if (isset($_POST["edit_age"])){
                if (!empty($_POST["edit_age"])){
                    $this->db->query("update users set age = $1 where id = $2", $_POST["edit_age"],$_SESSION["id"]);
                }
                else{
                    $this->db->query("update users set age = $1 where id = $2", null,$_SESSION["id"]);
                }
            }
            //firstname
            if (isset($_POST["edit_firstname"])){
                if (!empty($_POST["edit_firstname"])){
                    $this->db->query("update users set firstname = $1 where id = $2", $_POST["edit_firstname"],$_SESSION["id"]);
                }
                else{
                    $this->db->query("update users set firstname = $1 where id = $2", null,$_SESSION["id"]);
                }
            }

            //lastname
            if (isset($_POST["edit_lastname"])){
                if (!empty($_POST["edit_lastname"])){
                    $this->db->query("update users set lastname = $1 where id = $2", $_POST["edit_lastname"],$_SESSION["id"]);
                }
                else{
                    $this->db->query("update users set lastname = $1 where id = $2", null,$_SESSION["id"]);
                }
            }
            $res = $this->db->query("select * from users where id = $1;", $_SESSION["id"]);
            $_SESSION["email"] = $res[0]["email"];
        $_SESSION["username"] = $res[0]["username"];
        $_SESSION["firstname"] = $res[0]["firstname"];
        $_SESSION["lastname"] = $res[0]["lastname"];
        $_SESSION["age"] = $res[0]["age"];

        $this -> viewProfile();
        return;
        }

        $this -> showLogin();
        
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

        if (
            isset($_POST["firstname"]) && !empty($_POST["firstname"]) &&
            isset($_POST["lastname"]) && !empty($_POST["lastname"]) &&
            isset($_POST["age"]) && !empty($_POST["age"]) &&
            isset($_POST["username"]) && !empty($_POST["username"]) &&
            isset($_POST["password"]) && !empty($_POST["password"]) &&
            isset($_POST["email"]) && !empty($_POST["email"])
        ) {

            if(preg_match("/^[a-zA-Z0-9\/.-]+@[a-zA-Z0-9\/-]+.[a-zA-Z0-9\/-]+$/", $_POST["email"])){
                

            // Check if user is in database
            $res = $this->db->query("select * from users where email = $1;", $_POST["email"]);
            if (empty($res)) {
                // User was not there, so insert them
                $this->db->query(
                    "insert into users (email, username, age, firstname, lastname, password) values ($1, $2, $3, $4, $5, $6);",
                    $_POST["email"],
                    $_POST["username"],
                    $_POST["age"],
                    $_POST["firstname"],
                    $_POST["lastname"],
                    password_hash($_POST["password"], PASSWORD_DEFAULT)
                );
                $res = $this->db->query("select * from users where email = $1;", $_POST["email"]);
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["email"] = $_POST["email"];
                $_SESSION["age"] = $_POST["age"];
                $_SESSION["firstname"] = $_POST["firstname"];
                $_SESSION["lastname"] = $_POST["lastname"];
                // Send user to the login page
                $this -> showLogin();
                return;
            } else{
                $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                User already exists!
                </div>";
            }
        }else {
            $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
            Email invalid! Must be in the format example@mail.com!
            </div>";
        }
        } else {
            $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
            All fields are required!
            </div>";
        }
        $this -> showRegister();
    }

    

    /**
     * Checks user information during log-in
     */
    public function showRegister()
    {
        $errorMessage = $this-> errorMessage; 
        include("front-end/pages/register-profile.php");
    }

    /**
     * Allows user to view profile
     */
    public function viewProfile()
    {
        $firstname = $_SESSION["firstname"];
        $email = $_SESSION["email"];
        $username = $_SESSION["username"];
        $lastname = $_SESSION["lastname"];
        $age = $_SESSION["age"];
        include("front-end/pages/profile.php");

    }

    /**
     * Allows user to view their color preferences
     */
    public function viewColorPreferences()
    {
        $firstname = $_SESSION["firstname"];
        include("front-end/pages/color-preferences.php");

    }

    /**
     * Allows user to edit profile
     */
    public function editProfile()
    {
        $firstname = $_SESSION["firstname"];
        include("front-end/pages/edit-profile.php");

    }

    /**
     * Allows user to edit profile
     */
    public function search()
    {
        $firstname = $_SESSION["firstname"];
        include("front-end/pages/edit-profile.php");

    }


    // /**
    //  * Sets User Information within database
    //  * 
    //  * Storage of User information
    //  */
    // private function setUserInfo()
    // {
    //     if (!isset($_SESSION["name"]) && isset($_POST["fullname"])) {
    //         $_SESSION["name"] = $_POST["fullname"];
    //     }

    //     if (!isset($_SESSION["email"]) && isset($_POST["email"])) {
    //         $_SESSION["email"] = $_POST["email"];
    //     }

    //     if (!isset($_SESSION["password"]) && isset($_POST["password"])) {
    //         $_SESSION["password"] = $_POST["password"];
    //     }

    // }


    /**
     * Show the welcome page to the user.
     */
    public function showHome()
    {
        $firstname = $_SESSION["firstname"];
        include("front-end/pages/home.php");
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