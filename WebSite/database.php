<?php
/**
 * Verify and Add User to Database
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   Database
 * @package    Project
 * @author     Bayley Wise <M210796@Tafe.wa.edu.au>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    SVN: $Id$
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      File available since Release 1.2.0
 * @deprecated File deprecated in Release 2.0.0
 */
define("DB_SERVER", "localhost"); //location of your server
define("DB_USER", "root"); //username (default)
define("DB_PASS", "usbw"); // password for db login
define("DB_NAME", "movies"); // database name
/**
 * Database Connection
 *
 * @return $connection
 */
function DB_connect() 
{
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    return $connection;
}
/**
 * Database Disconnection
 *
 * @return $connection
 */
function DB_disconnect() 
{
    if (isset($connection)) {
        mysqli_close($connection);
    }
}
/**
 * Find all movies query
 *
 * @return $result
 */
function Find_All_movies() 
{
    global $db; // must be on the top
    $sql = "SELECT * FROM movies ";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    return $result;
}

/**
 * Find top movies query
 *
 * @return $result
 */
function Find_Top_movies() 
{
    global $db; // must be on the top
    $sql = "SELECT `Title`,`Search_Hits` FROM `movies` ORDER BY Search_Hits DESC, `Title` ASC LIMIT 10";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    return $result;
}
/**
 * Find genres query
 *
 * @return $result
 */
function Find_genres() 
{
    global $db; // must be on the top
    $sql = "SELECT DISTINCT `Genre` FROM `movies` ORDER BY `Genre` ASC";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    return $result;
}
/**
 * Find rating query
 *
 * @return $result
 */
function Find_ratings() 
{
    global $db; // must be on the top
    $sql = "SELECT DISTINCT `Rating` FROM `movies` ORDER BY `Rating` ASC";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    return $result;
}
/**
 * Find years query
 *
 * @return $result
 */
function Find_years() 
{
    global $db; // must be on the top
    $sql = "SELECT DISTINCT `Year` FROM `movies` ORDER BY `Year` ASC";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    return $result;
}
/**
 * Search Movies Query
 * 
 * @param string $title  title for search
 * @param string $rating rating for search
 * @param string $genre  genre for search
 * @param string $year   year for search
 * 
 * @return $result
 */
function search($title, $rating, $genre, $year) 
{
    global $db; // must be on the top
    $sql = "SELECT * FROM `movies` ";
    $sql.= "WHERE `Title` LIKE ('%$title%') ";
    $sql.= "$year ";
    $sql.= "$genre ";
    $sql.= "$rating ";
    $sql.= "ORDER BY `Title` ASC";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    return $result;
}
/**
 * Update search hits
 * 
 * @param string $title  title for search
 * @param string $rating rating for search
 * @param string $genre  genre for search
 * @param string $year   year for search
 * 
 * @return $result
 */
function Update_Search_hits($title, $rating, $genre, $year) 
{
    global $db; // must be on the top
    $sql = "UPDATE `movies` SET `Search_Hits`=`Search_Hits`+1 ";
    $sql.= "WHERE `Title` LIKE ('%$title%') ";
    $sql.= "$year ";
    $sql.= "$genre ";
    $sql.= "$rating ";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    if ($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}
/**
 * Insert User query
 *
 * @param array $user anything
 * 
 * @return bool
 */
function Insert_user($user) 
{
    global $db;
    $sql = "INSERT INTO user ";
    $sql.= "(`first_name`, `last_name`, `email`, `news_letter`, `news_blast`) ";
    $sql.= "VALUES (";
    $sql.= "'" . $user['first_name'] . "',";
    $sql.= "'" . $user['last_name'] . "' ,";
    $sql.= "'" . $user['email'] . "' ,";
    $sql.= "'" . $user['news_letter'] . "' ,";
    $sql.= "'" . $user['news_blast'] . "' ";
    $sql.= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function Delete_user($user) 
{
    global $db;
    $sql = "DELETE FROM user WHERE user_id = ";
    $sql.= "(`first_name`, `last_name`, `email`) ";
    $sql.= "VALUES (";
    $sql.= "'" . $user['first_name'] . "',";
    $sql.= "'" . $user['last_name'] . "' ,";
    $sql.= "'" . $user['email'] . "' ";
    $sql.= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}
function Show_user($user)
{
    global $db;
    $sql = "SELECT * FROM user WHERE email LIKE ('%" .$user['email']."%')";
    $result = mysqli_query($db, $sql);    
    return $result;
    
}

function Get_Admin()
{
    global $db; // must be on the top
    $sql = "SELECT * FROM `admin`";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    return $result;
    
}

function User_Check()
{
    global $db;
    $sql = "SELECT `email` FROM user";
    $result = mysqli_query($db, $sql);    
    return $result;    
}

function Update_user($user) 
{
    global $db;
    $sql = "UPDATE `user` SET ";
    $sql.= " `first_name`= '" . $user['first_name'] . "',";
    $sql.= " `last_name`= '" . $user['last_name'] . "' ,";
    $sql.= " `news_letter`= '" . $user['news_letter'] . "' ,";
    $sql.= " `news_blast`= '" . $user['news_blast'] . "' ";
    $sql.= " WHERE `email` ='" . $user['email'] . "' ";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function Movie_Details($movieID)
{
    global $db; // must be on the top
    $sql = "SELECT * FROM `movies` ";
    $sql.= "WHERE `ID` = $movieID";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    return $result;
}

function Find_Title(){
    
}
?>