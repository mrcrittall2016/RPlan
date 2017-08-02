<?php

    // configuration
    require("../includes/config.php"); 
    
    // Scheme_id array
    $schemes = []; 
    
    /*Test database connection */
    $rows = Database::query("SELECT * FROM `inthev8_main_rplanner`. `users` WHERE username = ?", "matthew");
    
    // Get current username 
    $rows = Database::query("SELECT username FROM `inthev8_main_rplanner` . `users` WHERE id = ?", $_SESSION["id"]);
    $username = $rows[0]["username"];
    
    render("History_view.php",["title" => "Reaction History", "name" => $username]); 
   
 
?>