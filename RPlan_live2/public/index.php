<?php

    // configuration
    require("../includes/config.php"); 
    
    /*Test database connection. For inmotion hosting, this works with old CS50 code in vendor folder*/
    $rows = Database::query("SELECT * FROM `inthev8_main_rplanner`. `users` WHERE username = ?", "Matthew");
    
    //print_r($rows);
    
    if (!$rows){
    
    	echo "Could not connect to database!"; 
    	
    }
    
    
    //  If not logged in...
    if (empty($_SESSION["id"]))
    {
        
        render("Home.2.php",["title" => "ChemMaster", "name" => "undefined"]); 
        
    }
    
    // If logged in already ie returning from login.php
    else if (!empty($_SESSION["id"])){
        
        // Get username (need general function for this)
        $rows = Database::query("SELECT * FROM `inthev8_main_rplanner`. `users` WHERE id = ?", $_SESSION["id"]);
        $id = $rows[0]["username"]; 
        //echo $id; 
        
        render("Home.2.php",["title" => "ChemMaster", "name" => $id]); 
    }
 
?>
