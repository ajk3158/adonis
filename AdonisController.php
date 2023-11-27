<?php
// Sources used: https://cs4640.cs.virginia.edu
// Alex Kim (Cookies (maintain state of the application), switch commands, login, logout, register, profile, getAllUsers, homepage, regex, database querying, view color edits, session management), Jason Nguyen (view/edit color preferences and their connection to register, update profile, edit profile, database querying, session management)
class AdonisController
{

    // Needed private fields for controller
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
            // if (!isset($_SESSION["id"]) && !isset($_SESSION["username"]) && !isset($_SESSION["email"])) {
            if (!isset($_POST["email"]) && !isset($_POST["username"]) && !isset($_POST["password"]) && !isset($_SESSION["id"])) {
                switch ($command) {
                    case "showRegister":
                        $this->showRegister();
                        break;
                    default:
                        $this->showLogin();
                        break;
                }
                return;
            }

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
            case "viewColorPreferences":
                $this->viewColorPreferences();
                break;
            case "viewColorEdits":
                $this->viewColorEdits();
                break;
            case "colorPref":
                $this->colorPref();
                break;
            case "saveOutfits":
                $this->saveOutfits();
                break;
            case "getOutfits":
                $this->getOutfits();
                break;
            case "updateProfile":
                $this->updateProfile();
                break;
            case "editProfile":
                $this->editProfile();
                break;
            case "getAllUsers";
                $this->getAllUsers();
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
     * Handle user log-in
     */
    public function login()
    {
        // need a username, email, and password
        if (
            isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["username"]) && !empty($_POST["username"]) &&
            isset($_POST["password"]) && !empty($_POST["password"])
        ) {

            if (preg_match("/^[a-zA-Z0-9\/.-]+@[a-zA-Z0-9\/-]+.[a-zA-Z0-9\/-]+$/", $_POST["email"]) && preg_match("/^.{5,19}$/", $_POST["username"]) && preg_match("/^.{8,}$/", $_POST["password"])) {


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
                        setcookie("email", $_POST["email"], time() + 10800);
                        setcookie("username", $_POST["username"], time() + 10800);
                        $this->showHome();
                        return;
                    } else {
                        $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                Password is incorrect!
                </div>";
                    }
                }
            } else {
                $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                Email must be in the format example@mail.com and username/password length conditions must be satisfied!
                </div>";
            }
        } else {
            $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
            Email, Username, and Password are all required!
            </div>";
        }
        // If something went wrong, show the login page again
        $this->showLogin();
    }

    /**
     * Update profile of current user in database and in session
     */
    public function updateProfile()
    {
        if (isset($_SESSION["id"])) {

            // Update email
            if (isset($_POST["edit_email"]) && !empty($_POST["edit_email"])) {
                if (filter_var($_POST["edit_email"], FILTER_VALIDATE_EMAIL)) {
                    $this->db->query("update users set email = $1 where id = $2", $_POST["edit_email"], $_SESSION["id"]);
                    $_SESSION["email"] = $_POST["edit_email"];
                    setcookie("email", $_POST["edit_email"], time() + 10800);
                } else {
                    $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                    Email format is incorrect!
                    </div>";
                }
            } else {
                $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                Email can not be empty!
                </div>";
            }

            // Update username 
            if (isset($_POST["edit_username"]) && !empty($_POST["edit_username"])) {
                if (strlen($_POST["edit_username"]) < 20 && strlen($_POST["edit_username"]) >= 5) {
                    $this->db->query("update users set username = $1 where id = $2", $_POST["edit_username"], $_SESSION["id"]);
                    $_SESSION["username"] = $_POST["edit_username"];
                    setcookie("username", $_POST["edit_username"], time() + 10800);
                } else {
                    $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                    Username length must be greater than or equal to 5 characters and below 20 characters!
                    </div>";
                }
            } else {
                $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                Username can not be empty!
                </div>";
            }

            // Update password
            if (isset($_POST["edit_password"]) && !empty($_POST["edit_password"])) {
                if (strlen($_POST["edit_password"]) > 7) {
                    $this->db->query("update users set password = $1 where id = $2", password_hash($_POST["password"], PASSWORD_DEFAULT), $_SESSION["id"]);
                } else {
                    $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                    Password length must be greater than 7 characters!
                    </div>";
                }
            } else {
                $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                Password can not be empty!
                </div>";
            }

            // Update age
            if (isset($_POST["edit_age"])) {
                if (!empty($_POST["edit_age"])) {
                    $this->db->query("update users set age = $1 where id = $2", $_POST["edit_age"], $_SESSION["id"]);
                } else {
                    $this->db->query("update users set age = $1 where id = $2", null, $_SESSION["id"]);
                }
            }
            // Update first name
            if (isset($_POST["edit_firstname"])) {
                if (!empty($_POST["edit_firstname"])) {
                    $this->db->query("update users set firstname = $1 where id = $2", $_POST["edit_firstname"], $_SESSION["id"]);
                } else {
                    $this->db->query("update users set firstname = $1 where id = $2", null, $_SESSION["id"]);
                }
            }

            // Update last name
            if (isset($_POST["edit_lastname"])) {
                if (!empty($_POST["edit_lastname"])) {
                    $this->db->query("update users set lastname = $1 where id = $2", $_POST["edit_lastname"], $_SESSION["id"]);
                } else {
                    $this->db->query("update users set lastname = $1 where id = $2", null, $_SESSION["id"]);
                }
            }
            // Reset session information with updated information
            $res = $this->db->query("select * from users where id = $1;", $_SESSION["id"]);
            $_SESSION["email"] = $res[0]["email"];
            $_SESSION["username"] = $res[0]["username"];
            $_SESSION["firstname"] = $res[0]["firstname"];
            $_SESSION["lastname"] = $res[0]["lastname"];
            $_SESSION["age"] = $res[0]["age"];

            $this->viewProfile();
            return;
        }

        $this->showLogin();

    }

    /**
     * Updates color preferences for user
     */
    public function colorPref()
    {
        $colors = array('black', 'white', 'red', 'blue', 'brown', 'grey');
        foreach ($colors as $color) {
            $checkboxName = $color . 'Check';
            $value = isset($_POST[$checkboxName]) ? 'true' : 'false';
            $query = "UPDATE colorPreferences SET $color = $value WHERE id = " . $_SESSION["id"];
            $this->db->query($query);
        }
        $this->viewColorPreferences();

    }

    /**
     * Shows login page
     */
    public function showLogin()
    {
        if (isset($_COOKIE["email"])) {
            $email = $_COOKIE["email"];
        }
        if (isset($_COOKIE["username"])) {
            $username = $_COOKIE["username"];
        }
        $errorMessage = $this->errorMessage;
        include("front-end/pages/login.php");
    }

    /**
     * Returns JSON of all users within the system (without their passwords)
     */
    public function getAllUsers()
    {
        $this->db->query("drop table if exists userTable;");
        $this->db->query("select * into userTable from users;");
        $this->db->query("alter table userTable drop column password;");
        $this->db->query("alter table userTable drop column username;");
        $allUserData = $this->db->query("select * from userTable;");

        header('Content-Type: application/json');

        echo json_encode($allUserData);
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

            if (preg_match("/^[a-zA-Z0-9\/.-]+@[a-zA-Z0-9\/-]+.[a-zA-Z0-9\/-]+$/", $_POST["email"]) && preg_match("/^.{5,19}$/", $_POST["username"]) && preg_match("/^.{8,}$/", $_POST["password"])) {


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
                    $this->db->query(
                        "insert into colorPreferences (id, black, white, red, blue, brown, grey) values ($1, false,false,false,false,false,false);",
                        $res[0]["id"]

                    );
                    // Send user to the login page
                    $this->showLogin();
                    return;
                } else {
                    $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                User already exists!
                </div>";
                }
            } else {
                $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
            Email must be in the format example@mail.com and username/password length conditions must be satisfied!
            </div>";
            }
        } else {
            $this->errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
            All fields are required!
            </div>";
        }
        $this->showRegister();
    }



    /**
     * Shows registration page
     */
    public function showRegister()
    {
        $errorMessage = $this->errorMessage;
        include("front-end/pages/register-profile.php");
    }

    /**
     * Shows user profile page
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
        $colors = $this->db->query("select * from colorPreferences where id = $1;", $_SESSION["id"]);
        $colors = $colors[0];
        $firstname = $_SESSION["firstname"];
        include("front-end/pages/color-preferences.php");

    }

    /**
     * Shows preferred color editing page
     */

    public function viewColorEdits()
    {
        $colors = $this->db->query("select column_name from information_schema.columns where table_name = N'colorpreferences';");
        $firstname = $_SESSION["firstname"];
        include("front-end/pages/edit-color-preferences.php");
    }

    /**
     * Shows edit profile page
     */
    public function editProfile()
    {
        $firstname = $_SESSION["firstname"];
        include("front-end/pages/edit-profile.php");

    }

    /**
     * Show the home page
     */
    public function showHome()
    {
        $colors = $this->db->query("select * from colorPreferences where id = $1;", $_SESSION["id"]);
        $userColors = [];
        foreach($colors[0] as $color=>$bool){
            if($color == 'id' || $bool == 'f'){
                continue;
            }
            array_push($userColors, $color);
        }
        $firstname = $_SESSION["firstname"];
        include("front-end/pages/home.php");
    }

    /**
     * Log out the user
     */
    public function logout()
    {
        unset($_COOKIE["email"]);
        setcookie("email", "", time() - 10800);
        unset($_COOKIE["username"]);
        setcookie("username", "", time() - 10800);
        session_destroy();
        session_start();
    }


    // public function saveOutfits()
    // {
    //     // User was not there, so insert them
    //     $this->db->query(
    //         "insert into users (email, username, age, firstname, lastname, password) values ($1, $2, $3, $4, $5, $6);",
    //         $_POST["email"],
    //         $_POST["username"],
    //         $_POST["age"],
    //         $_POST["firstname"],
    //         $_POST["lastname"],
    //         password_hash($_POST["password"], PASSWORD_DEFAULT)
    //     );
    // }

    // public function getOutfits()
    // {

    // }

}
