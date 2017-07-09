<?php

    // configuration
    require("../includes/config.php"); 
    
    /*Test database connection */
    $rows = Database::query("SELECT * FROM `main_rplanner`. `users` WHERE username = ?", "matthew");
    
    //print_r($rows);
    
    
    //  If not logged in...
    if (empty($_SESSION["id"]))
    {
        
        render("Home.2.php",["title" => "ChemMaster", "name" => "undefined"]); 
        
    }
    
    // If logged in already ie returning from login.php
    else {
        
        // Get username (need general function for this)
        $rows = Database::query("SELECT * FROM `main_rplanner`. `users` WHERE id = ?", $_SESSION["id"]);
        $id = $rows[0]["username"]; 
        //echo $id; 
        
        render("Home.2.php",["title" => "ChemMaster", "name" => $id]); 
    }
 
?>
