<?php
    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
        if ($_POST["secret"] == "You shouldn't be here"){

            //check that password matches confirmation password and
            if ($_POST["password"] == $_POST["confirmation"]){
            
                $query = query("INSERT INTO users (username, hash, email) VALUES(?,?,?)",$_POST["username"], crypt($_POST["password"]), $_POST["email"]);
                
                if($query === false)
                {
                apologize("Sorry, that username already exists fool.");
                }

                $rows = query("SELECT id FROM users WHERE username = ?", $_POST["username"]);
                $_SESSION["id"] = $rows[0]["id"];
                //redirect back to index
                redirect("insert.php");        
            }
            else
            {
                apologize();
            }
        }
        else 
        {
            apologize();
        }
    }
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

?>
