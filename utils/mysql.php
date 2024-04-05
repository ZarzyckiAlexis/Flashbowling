<?php

    /** 
     * * AUTHOR: ALEXIS ZARZYCKI | LA219263 | la219263@student.helha.be
     * * FEEL FREE TO USE WITHOUT ASKING PERMISSIONS
    **/

    /**
     ** GENERAL PART 
    **/

    /**
     * *brief: Connect to the DataBase
     *  @param NONE
     * *return: the connexion
    **/

    function connexionDB(){
        try{
            $hostname = "localhost";
            $username = "root";
            $password = "";
            $database = "FlashBowling";
            $connexion = new PDO("mysql:host=$hostname;dbname=$database;", $username, $password);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connexion;
        } catch(PDOException $event){
            echo "Une erreur sauvage est apparue! " . $event->getMessage() . "\n";
        }
    }

    /**
     * *brief: Logout from the DataBase
     * @param connexion --> Current Connexion
     * *return: none
    **/

    function logoutDB($connexion){
        $connexion = null;
    }

    /**
     * *brief: Count all in a Table with a Where
     * @param table --> The table
     * @param where --> The item to search with 
     * *return: Number of row(s)
    **/

    function countAllFromTableWhere($table, $where){
        $connexion=connexionDB();
        $request=$connexion->prepare("SELECT COUNT(*) FROM $table WHERE $where");
        $request->execute();
        $result=$request->fetch()['COUNT(*)'];
        logoutDB($connexion);
        return $result;
    }

    /** 
     * *brief: Select all from a Table
     *  @param table --> The table
     * *return: Array of result
    **/

    function selectAllFromTable($table){
        $connexion = connexionDB();
        $request = $connexion->prepare("SELECT * FROM $table");
        $request->execute();
        logoutDB($connexion);
        return $request;
    }

    /**
     * *brief: Select all from a Table with a Where
     * @param table --> The table
     * @param where --> The item to search with
     * *return: Array of result
    **/

    function selectAllFromTableWhere($table, $where){
        $connexion=connexionDB();
        $request=$connexion->prepare("SELECT * FROM $table WHERE $where");
        $request->execute();
        logoutDB($connexion);
        return $request;
    }

    /**
     * *brief: Select all in a Table with an Order By 
     * @param table --> The table
     * @param order --> The item to order with
     * *return: Array of result
    **/

    function selectAllFromTableOrderByOne($table, $order){
        $connexion = connexionDB();
        $request=$connexion->prepare("SELECT * FROM $table ORDER BY $order");
        $request->execute();
        logoutDB($connexion);
        return $request;
    }

    /**
     * *brief: Select all in a Table with an Order By 
     * @param table --> The table
     * @param order --> The item to order with
     * @param ordertwo --> The second item to order with
     * *return: Array of result
    **/

    function selectAllFromTableOrderByTwo($table, $order, $ordertwo){
        $connexion = connexionDB();
        $order = $connexion->quote($order);
        $ordertwo = $connexion->quote($ordertwo);
        $request=$connexion->prepare("SELECT * FROM $table ORDER BY $order,$ordertwo");
        $request->execute();
        logoutDB($connexion);
        return $request;
    }

    /**
     ** USER PART 
    **/

    /**
     * *brief: Add a user in the User Table
     * @param username --> The username of the user
     * @param password --> The hashed password of the user
     * @param mail --> The mail of the user
     * *return: none
    **/

    function insertUsersIntoTable($username, $password, $mail){
        $connexion = connexionDB();
        $username = $connexion->quote($username);
        $password = $connexion->quote($password);
        $mail = $connexion->quote($mail);
        $request = $connexion->prepare("INSERT INTO `user`(`username`, `password`, `email`) VALUES ($username,$password,$mail)");
        $request->execute();
        logoutDB($connexion);
    }

    /**
     * *brief: Update a user password in the User Table
     * @param username --> The username of the user
     * @param password --> The hashed password of the user
     * *return: none
    **/

    function updateUsersPasswordFromTable($username, $password){
        $connexion = connexionDB();
        $username = $connexion->quote($username);
        $password = $connexion->quote($password);
        $request = $connexion->prepare("UPDATE `user` SET `password`=$password WHERE `username`=$username");
        $request->execute();
        logoutDB($connexion);
    }

    /**
     * *brief: Update a user in the User Table
     * @param username --> The username of the user
     * @param email --> The email of the user
     * @param rank --> The rank of the user 
     * *return: none
    **/

    function updateUsersFromTable($username, $email, $rank){
        $connexion = connexionDB();
        $username = $connexion->quote($username);
        $email = $connexion->quote($email);
        $rank = $connexion->quote($rank);
        $request = $connexion->prepare("UPDATE `user` SET `email`=$email,`rank`=$rank WHERE `username`=$username");
        $request->execute();
        logoutDB($connexion);
    }

    /**
     * *brief: Remove a user in the User Table
     * @param username --> The username of the user
     * *return: none
    **/

    function removeUsersFromTable($username){
        $connexion = connexionDB();
        $username = $connexion->quote($username);
        $request = $connexion->prepare("DELETE FROM `user` WHERE `username`=$username");
        $request->execute();
        logoutDB($connexion);
    }

    /**
     ** ANNOUNCEMENTS PART
    **/

    /**
     * *brief: Add a Announcements in the Announcements Table 
     * @param title --> title of the announcements
     * @param content --> content of the announcements
     * @param date --> publish date of the announcements
     * @param username --> publisher of the announcements
     * *return: none
    **/

    function addAnnouncementsFromTable($title, $content, $date, $username){
        $connexion = connexionDB();
        $title = $connexion->quote($title);
        $content = $connexion->quote($content);
        $date = $connexion->quote($date);
        $username = $connexion->quote($username);
        $request = $connexion->prepare("INSERT INTO `announcements`(`title`, `content`, `publishTime`, `username`) VALUES ($title,$content,$date,$username)");
        $request->execute();
        logoutDB($connexion);
    }

    /**
     * *brief: Update a Announcements in the Announcements Table 
     * @param id --> id of the announcements
     * @param title --> title of the announcements
     * @param content --> content of the announcements
     * *return: none
    **/

    function updateAnnouncementsFromTable($id, $title, $content){
        $connexion = connexionDB();
        $id = $connexion->quote($id);
        $title = $connexion->quote($title);
        $content = $connexion->quote($content);
        $request = $connexion->prepare("UPDATE `announcements` SET `title`=$title,`content`=$content WHERE `id`=$id");
        $request->execute();
        logoutDB($connexion);
    }

    /**
     * *brief: Remove a Announcements in the Announcements Table
     * @param id --> id of the announcements
     * *return: none
    **/

    function removeAnnouncementsFromTable($id){
        $connexion = connexionDB();
        $id = $connexion->quote($id);
        $request = $connexion->prepare("DELETE FROM `announcements` WHERE `id`=$id");
        $request->execute();
        logoutDB($connexion);
    }

    /**
     ** PRICE PART
    **/


    /**
     * *brief: Add a Price in the Price Table 
     * @param title --> title of the price
     * @param category --> category of the price
     * @param content --> content of the price
     * @param date --> publish date of the price
     * @param username --> publisher of the price
     * *return: none
    **/

    function addPriceFromTable($title, $category, $content, $date, $username){
        $connexion = connexionDB();
        $title = $connexion->quote($title);
        $category = $connexion->quote($category);
        $content = $connexion->quote($content);
        $date = $connexion->quote($date);
        $username = $connexion->quote($username);
        $request = $connexion->prepare("INSERT INTO `price`(`title`, `category`, `content`, `publishTime`, `username`) VALUES ($title,$category,$content,$date,$username)");
        $request->execute();
        logoutDB($connexion);
    }

    /**
     * *brief: Update a Price in the Price Table 
     * @param id --> id of the price
     * @param title --> title of the price
     * @param category --> category of the price
     * @param content --> content of the price
     * @param date --> date of the modification of the price
     * @param username --> username of the modifier of the price
     * *return: none
    **/

    function updatePriceFromTable($id, $title, $category, $content, $date, $username){
        $connexion = connexionDB();
        $id = $connexion->quote($id);
        $title = $connexion->quote($title);
        $category = $connexion->quote($category);
        $content = $connexion->quote($content);
        $date = $connexion->quote($date);
        $username = $connexion->quote($username);
        $request = $connexion->prepare("UPDATE `price` SET `title`=$title,`category`=$category,`content`=$content,`publishTime`=$date,`username`=$username WHERE `id`=$id");
        $request->execute();
        logoutDB($connexion);
    }

    /**
     * *brief: Remove a Price in the Price Table
     * @param id --> id of the announcements
     * *return: none
    **/

    function removePriceFromTable($id){
        $connexion = connexionDB();
        $id = $connexion->quote($id);
        $request = $connexion->prepare("DELETE FROM `price` WHERE `id`=$id");
        $request->execute();
        logoutDB($connexion);
    }

    /**
     ** RESERVATION PART
    **/

    /**
     * *brief: Add a Reservation in the Reservation Table
     * @param mail --> The mail address of the client
     * @param tel --> The phone number of the client
     * @param date --> The date of the reservation
     * @param subject --> Le sujet
     * @param content --> Le contenu
     * *return: none
    **/

    function addReservationTable($mail, $tel, $date, $subject, $content){
        $connexion = connexionDB();
        $mail = $connexion->quote($mail);
        $tel = $connexion->quote($tel);
        $date = $connexion->quote($date);
        $subject = $connexion->quote($subject);
        $content = $connexion->quote($content);
        $request = $connexion->prepare("INSERT INTO `reservation`(`author`, `phone`, `date`, `reason`, `content`) VALUES ($mail,$tel,$date,$subject,$content)");
        $request->execute();
        logoutDB($connexion);
    }

    /**
     * *brief: Remove a Reservation in the Reservation Table
     * @param id --> The id of the reservation
     * *return: none
    **/

    function removeReservationFromTable($id){
        $connexion = connexionDB();
        $request = $connexion->prepare("DELETE FROM reservation WHERE id='$id'");
        $request->execute();
        logoutDB($connexion);
    }

    /**
     ** RESET PART 
    **/
    
    /**
     * *brief: Add a Reset into the Reset Table
     * @param mail --> The mail adress of the client
     * @param hash --> The hash to insert
     * *return: none
    **/

    function addResetIntoTable($mail, $hash){
        $connexion = connexionDB();
        $mail = $connexion->quote($mail);
        $hash = $connexion->quote($hash);
        $request = $connexion->prepare("INSERT INTO `reset`(`email`, `hash`) VALUES ($mail,$hash)");
        $request->execute();
        logoutDB($connexion);
    }

    /**
     * *brief: Remove a Reset in the Reset Table
     * @param mail --> The mail adress of the client
     * *return: none
    **/

    function removeResetFromTable($mail){
        $connexion = connexionDB();
        $mail = $connexion->quote($mail);
        $request = $connexion->prepare("DELETE FROM `reset` WHERE `email` = $mail");
        $request->execute();
        logoutDB($connexion);
    }

?>