<?php
/**
 * Add User Page
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   Add_User
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
?>
<?php
require 'header.php';
require_once 'database.php';
$db = DB_connect();
$result = Get_Admin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="keywords" content="basic, html" />
    <meta name="author" content="Bayley Wise" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="StyleSheet.css" />
    <title>User signup</title>
</head>
<body> 
<div id="data-body" class="row">
    <nav id="data-nav-bar" class="col-lg-2 bg-info">
        <h2 class="text-center">Page Links</h2>
        <ul class="nav nav-pills nav-stacked">
            <li><a href="search_Movie.php">Search Movies</a></li>
            <li><a href="top_Searched.php">Top 10 Searched Movies</a></li>
            <li><a href="top_Rated.php">Top 10 Rated Movies</a></li>
            <li><a href="userSignUp.php">User Signup</a></li>
            <li><a href="showUsers.php">View All Users</a></li>
            <li><a href="adminLogIn.php">Administrator Section</a></li>
        </ul> 
    </nav>
       
    <main class="col-lg-10">
        <h1>Log-In</h1>
        <form action="<?php echo htmlspecialchars(
            $_SERVER["PHP_SELF"]
        ); ?>" method="post">
            <div class="form-group">
                <label for="user_name">Username:</label>
                <input type="text" class="form-control" id="user_name" 
                name="user_name" pattern= "[a-zA-Z\- '\d]*" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" 
                name="password" pattern= "^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[\W])(?=\S*[A-Z])(?=\S*[\d])\S*$" required>
            </div>
            <button type="submit" name="btnSubmit" 
            class="btn btn-default">Log-In</button>
        </form>
        <?php
    if (isset($_POST["btnSubmit"])) {
        $login['user_name'] = $_POST['user_name'];
        $login['password'] = $_POST['password'];
        
        while ($row = mysqli_fetch_assoc($result)) {
            $userName = $row["username"];
            $password = $row["password"];

            if(strcmp($userName, $login['user_name']) == 0){
                if(strcmp($password, $login['password']) == 0) {
                    header('Location: showUsers.php');
                    exit;
                }
            } 
        }
        echo "<h1>Username OR Password Incorrect.</h1>";
    }
    ?>
    </main>
</div>
</body>
</html>
<?php
    require 'footer.php';
?>