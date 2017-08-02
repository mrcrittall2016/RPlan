<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
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
        
        else if ($_POST["password"] != $_POST["confirmation"])
        {
            apologize("Passwords do not match."); 
        }
        
        else if (empty($_POST["email_address"]))
        {
            apologize("Please enter a valid email address."); 
        }
        
        // Now try SQL command with email address field. Note need underscore between email and address
        $result = Database::query("INSERT IGNORE INTO users (username, email, hash) 
        VALUES(?, ?, ?)", $_POST["username"], $_POST["email_address"], password_hash($_POST["password"], PASSWORD_DEFAULT));
        
        // Check for duplicate username
        if ($result == false)
        {
            apologize("This username is already taken. Please choose another."); 
        }
        
        // Get session id
        $rows = Database::query("SELECT LAST_INSERT_ID() AS id");
        $id = $rows[0]["id"];
        
        $_SESSION["id"] = $id; 
        
        redirect("/");
    
    }

?>