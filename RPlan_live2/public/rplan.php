<?php

    // configuration
    require("../includes/config.php"); 
    
    /*Test database connection */
    $rows = Database::query("SELECT * FROM `inthev8_main_rplanner`. `users` WHERE username = ?", "matthew");
        
    
    if (empty($_SESSION["id"]))
    {
        
        render("login_form.1.php",["title" => "Log In"]); 
        
    }
    
    // If logged in already 
    else {
        
        // Get username (need general function for this)
        $rows = Database::query("SELECT * FROM `inthev8_main_rplanner`. `users` WHERE id = ?", $_SESSION["id"]);
        $id = $rows[0]["username"]; 
        //echo $id; 
        
        render("rplanv2.php",["title" => "RPlan", "name" => $id]); 
    }    
    
 
?>
