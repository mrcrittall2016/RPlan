<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("login_form.1.php", ["title" => "Log In"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }

        // query database for user
        $rows = Database::query("SELECT * FROM `inthev8_main_rplanner`.`users` WHERE username = ?", $_POST["username"]);
       
       
        $test = count($rows);
        //echo $test; 
        
        // if we found user, check password
        if (count($rows) == 1)
        {
            // first (and only) row
            $row = $rows[0];
            //print_r ($row); 

            // compare hash of user's input against hash that's in database
            if (password_verify($_POST["password"], $row["hash"]))
            {
                
                // remember that user's now logged in by storing user's ID in session
                $_SESSION["id"] = $row["id"];

                // redirect to portfolio
                $name = $_POST["username"]; 
                redirect("/");
                
                echo $_SERVER['HTTP_REFERER']; 
                
                //redirect($_SERVER['HTTP_REFERER']); 
                 
            }
        }

        // else apologize
        apologize("Invalid username and/or password.");
    }

?>
