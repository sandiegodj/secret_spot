<?php
    // Most of these are helper methods provided by cs50.

    require_once("constants.php");
    include('simple_html_dom.php');

    function apologize($message)
    {
        render("apology.php", ["message" => $message]);
        exit;
    }

    /**
     * Logs out current user, if any.  Based on Example #1 at
     * http://us.php.net/manual/en/function.session-destroy.php.
     */
    function logout()
    {
        // unset any session variables
        $_SESSION = [];

        // expire cookie
        if (!empty($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 42000);
        }

        // destroy session
        session_destroy();
    }

    //Except this one
    function lookup($spot)
    {   

    //determining my wind and buoy variables here.
    //pretty much have every spot running off mission bay or point loma
    //so remember just reference those buoy's.    
  
    if ($spot == 'Scripps') // La Jolla
    {
        $w_station = 'ME3170';
        $buoy = '46231';
    }
    else if ($spot == 'Blacks')
    {
       $w_station = 'KCASANDI213';
       $buoy = '46231';
    }
    else if ($spot == 'Hogans')
    {
        $w_station = 'KCASANDI84';
        $buoy = '46231';
    }
    else if ($spot == 'OceanBeach')
    {
        $w_station = 'KCASANDI6';
        $buoy = '43213';
    }
    else if ($spot == 'SunsetCliffs') //Sunset Cliffs
    {
        $w_station = 'KCASANDI119';
        $buoy = '20101';
    }
    else if ($spot == 'ImperialBeach')//Imperial Beach
    {
        $w_station = 'KCAIMPER2';
        $buoy = '20099';
    }
    //scrape buoy data from surfline and sterilize it for sql
    $html = file_get_html("http://www.surfline.com/buoy-report/_2953_$buoy/");
    foreach ($html->find('div[class=buoy-info-swells]') as $div) {
    $stuff = strip_tags($div . '<br />');
    $stuff = preg_replace('/[\p{Z}\s]{2,}/s',' ',$stuff); 
        };
        
    //TODO if $stuff contains 'No data available'  buoy is down and throw bouy is down error page.
        

    $stuff = str_replace('&deg;', '', $stuff);
    $stuff = str_replace('from', '@', $stuff);
    $stuff = str_replace('m', 'ft', $stuff);

    $lines = explode(')', $stuff);
    $lines[0] = $lines[0].= ')';
    $lines[1] = $lines[1].= ')';
    $lines[2] = $lines[2].= ')';

    $html->clear();
    
    //get wind data json and decode
    $handle = file_get_contents("http://api.wunderground.com/api/1fdd3f808375fd75/conditions/q/pws:$w_station.json");
    $wind = json_decode($handle, true);
        
    //get tide info and sanatize for sql      
    $html = file_get_html("http://www.surfline.com/surfdata/inc_spot/inc_mod_tides_ajax.cfm?id=4256&livetide=true&units=e&tideLocation=Imperial%2520Beach%2520%2528Point%2520Loma%2529");
    $tide = strip_tags($html);
    $tide = preg_replace('/[\p{Z}\s]{2,}/s',' ',$tide); 
    $tide = substr($tide, 49);
    
    if (strpos($html,'up') !== false) {
    $tide = $tide.= '+';
    }
    else {
    $tide = $tide.= '-';
    }

               
     return [
            "wind_speed" => $wind["current_observation"]["wind_mph"],
            "wind_dir" => $wind["current_observation"]["wind_dir"],
            "swell_p" => $lines[0],
            "swell_s" => $lines[1],
            "swell_t" => $lines[2],
            "tide" => $tide,
            ];
    
             

    }
    /**
     * Executes SQL statement, possibly with parameters, returning
     * an array of all rows in result set or false on (non-fatal) error.
     */
    function query(/* $sql [, ... ] */)
    {
        // SQL statement
        $sql = func_get_arg(0);

        // parameters, if any
        $parameters = array_slice(func_get_args(), 1);

        // try to connect to database
        static $handle;
        if (!isset($handle))
        {
            try
            {
                // connect to database
                $handle = new PDO("mysql:dbname=" . DATABASE . ";host=" . SERVER, USERNAME, PASSWORD);

                // ensure that PDO::prepare returns false when passed invalid SQL
                $handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
            }
            catch (Exception $e)
            {
                // trigger (big, orange) error
                trigger_error($e->getMessage(), E_USER_ERROR);
                exit;
            }
        }

        // prepare SQL statement
        $statement = $handle->prepare($sql);
        if ($statement === false)
        {
            // trigger (big, orange) error
            trigger_error($handle->errorInfo()[2], E_USER_ERROR);
            exit;
        }

        // execute SQL statement
        $results = $statement->execute($parameters);

        // return result set's rows, if any
        if ($results !== false)
        {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            return false;
        }
    }

    /**
     * Redirects user to destination, which can be
     * a URL or a relative path on the local host.
     *
     * Because this function outputs an HTTP header, it
     * must be called before caller outputs any HTML.
     */
    function redirect($destination)
    {
        // handle URL
        if (preg_match("/^https?:\/\//", $destination))
        {
            header("Location: " . $destination);
        }

        // handle absolute path
        else if (preg_match("/^\//", $destination))
        {
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            header("Location: $protocol://$host$destination");
        }

        // handle relative path
        else
        {
            // adapted from http://www.php.net/header
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
            header("Location: $protocol://$host$path/$destination");
        }

        // exit immediately since we're redirecting anyway
        exit;
    }

    /**
     * Renders template, passing in values.
     */
    function render($template, $values = [])
    {
        // if template exists, render it
        if (file_exists("./templates/$template"))
        {
            // extract variables into local scope
            extract($values);

            // render header
            require("./templates/header.php");

            // render template
            require("./templates/$template");

            // render footer
            require("./templates/footer.php");
        }

        // else err
        else
        {
            trigger_error("Invalid template: $template", E_USER_ERROR);
        }
    }

?>
