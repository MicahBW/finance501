<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if ($_POST["username"] == NULL) {
             echo "<script>alert('Put in a username, idiot!');</script>";
        } else if ($_POST["password"] == NULL) {
             echo "<script>alert('Hey dingus, you need a password');</script>";
        } else if ($_POST["password"] != $_POST["confirmation"]){
            echo "<script> alert('They Gotta Match!'); </script>";
        } else {
            if (CS50::query("INSERT IGNORE INTO users (username, hash, cash) VALUES(?, ?, 10000.0000)", $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT)) != 0){
                $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
                $id = $rows[0]["id"];
                $_SESSION["id"] = $id;
                header("Location: https://ide50-micahwolfsohn.cs50.io/index.php"); /* Redirect browser */
                exit();
            } else {
                echo "<script> alert('You are a total idiot!!!!'); </script>";
            }
        }
    }

?>