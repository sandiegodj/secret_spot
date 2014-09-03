<?php
    
    // configuration
    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {   
        //grab info from surfline and wind
        $info = lookup($_POST["spot"]);
        //Might just set the null value for time through mysql
        $query = query("INSERT INTO data (user_id, spot, height, conditions, rating, swell_p, swell_s, swell_t, wind_dir, wind_spd, tide, description, time) VALUES (?,?,?,?,?,?,?,?,?,?,?,?, DATE_SUB(NOW(), INTERVAL 3 HOUR))", $_SESSION["id"], $_POST["spot"], $_POST["height"], $_POST["conditions"], $_POST["rating"],$info["swell_p"], $info["swell_s"], $info["swell_t"], $info["wind_dir"], $info["wind_speed"], $info["tide"], $_POST["description"]);
    
    
    }   
    else  
    {
        render("insert_form.php", ["title"=> "Data Insert"]);
    }

?>
