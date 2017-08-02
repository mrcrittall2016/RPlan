<?php

    // configuration
    require("../includes/config.php"); 
    
    /*Test database connection */
    $rows = Database::query("SELECT * FROM `inthev8_main_rplanner`. `users` WHERE username = ?", "matthew");
    
    
    if (empty($_GET["id"]))
    {
        http_response_code(400);
        exit;
    }
    
    
    $id_delete = $_GET["id"]; 
    
    
    //$id_delete = "bob"; 
    
    //$user_name = "Rodger"; 
    
    // Delete from database.
    Database::query("DELETE FROM `inthev8_main_rplanner`. `reactions` WHERE Scheme_name = ?", $id_delete);
    
    // Check if row has been deleted or not...     
    $rows = Database::query("SELECT * FROM `inthev8_main_rplanner`. `reactions` WHERE Scheme_name = ?", $id_delete);  
    
    // If deleted  
    if (!$rows){
        
        $return = true; 
        
    }
    
    // If still there for whatever reason 
    else if ($rows){
        
        $return = false; 
        
    }
    
    $info = ["result" => $return]; 
    
    
    
    header("Content-type: application/json");
    print(json_encode($info, JSON_PRETTY_PRINT));
    
 
?>