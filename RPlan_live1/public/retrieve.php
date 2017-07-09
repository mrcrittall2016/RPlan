<?php

    // configuration
    require("../includes/config.php"); 
    
    // Scheme_id array
    $schemes = []; 
    
    /*Test database connection */
    $rows = Database::query("SELECT * FROM `main_rplanner`. `users` WHERE username = ?", "matthew");
    
    // Get current username 
    $rows = Database::query("SELECT username FROM `main_rplanner` . `users` WHERE id = ?", $_SESSION["id"]);
    $username = $rows[0]["username"];
    
    // Get all reaction schemes associated with this user
    $rows = Database::query("SELECT * FROM `main_rplanner`. `reactions` WHERE username = ?", $username);
    
    if ($rows){
        
        foreach ($rows as $row){
            
            //print_r($row["Scheme_name"]); 
            array_push($schemes, $row["Scheme_name"]); 
        }
        
    }
    
    //print_r($schemes); 
    
    header("Content-type: application/json");
    print(json_encode($schemes, JSON_PRETTY_PRINT));
   
 
?>