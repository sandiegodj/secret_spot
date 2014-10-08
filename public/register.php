<?php
    // configuration
    require("./includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        // sorry, private alpha.  this does not work.
        if ($_POST["secret"] == ""){

            //check that password matches confirmation password and
            if ($_POST["password"] == $_POST["confirmation"]){
            
                $query = query("INSERT INTO users (username, hash, email) VALUES(?,?,?)",$_POST["username"], crypt($_POST["password"]), $_POST["email"]);
                
                if($query === false)
                {
                apologize("Oops.");
                }

                $rows = query("SELECT id FROM users WHERE username = ?", $_POST["username"]);
                $_SESSION["id"] = $rows[0]["id"];
                //redirect
                redirect("insert.php");        
            }
            else
            {
                apologize("Oops.");
            }
        }
        else 
        {
            apologize("Oops.");
        }
    }
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

?>
