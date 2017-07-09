<?php
    
    // This file allows a user to input their email address and be sent an email with a link to reset their password. 
    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("reset_form.php", ["title" => "Password Reset"]);
    }
    
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
        if (empty($_POST["email"]))
        {
            apologize("You must provide a valid email address.");
        }
        
        // check email address exists 
        $return = CS50::query("SELECT email_address FROM users WHERE email_address = ?", $_POST["email"]); 
        
        if($return == false)
        {
            apologize("that email address does not exist."); 
        }
        
        // Send an email to client 
        
        $subject = "Password Reset"; 
        $body = '<br>Click <a href="https://ide50-mattcrittall.cs50.io/reset_return.php">here</a> to reset password</br>'; 
        
        email($_POST["email"], $subject, $body);
        
        $_SESSION["email"] = $_POST["email"]; 
        
        // After emailed link, return to portfolios.php
        redirect("/");
        
    }
?>