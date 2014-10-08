<?php
    require("./includes/config.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    	$rows = query("SELECT swell_p, swell_s, swell_t, wind_dir, wind_spd, rating, conditions, height, description, time, spot, tide FROM data WHERE spot = ? AND user_id = ?", $_POST["spot"], $_SESSION['id']);
    
    	render("history.php", ["rows" => $rows, "spot" => $_POST["spot"], "title" => "HISTORY"]);
    }
    else
    {
    	render("lookup_form.php", ["title" => "HISTORY"]);
	}
?>
