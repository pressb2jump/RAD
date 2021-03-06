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
    <nav class="col-lg-2 bg-info">
        <h2 class="text-center">Page Links</h2>
        <ul class="nav nav-pills nav-stacked">
            <li><a href="search_Movie.php">Search Movies</a></li>
            <li><a href="top_Movies.php">Top 10</a></li>
            <li><a href="user.php">User Signup</a></li>
            <li><a href="showUsers.php">View All Users</a></li>
        </ul> 
    </nav>
       
    <main class="col-lg-10">
        <h1>User Signup</h1>
        <form action="<?php echo htmlspecialchars(
            $_SERVER["PHP_SELF"]
        ); ?>" method="post">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" id="first_name" 
                name="first_name" pattern= "[a-zA-Z\- ']*" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" id="last_name" 
                name="last_name" pattern= "[a-zA-Z\- ']*" required>
            </div>
            <div class="form-group">
                <label for="emailAddress">Email:</label>
                <input type="text" class="form-control" id="emailAddress" 
                name="emailAddress" 
                pattern="[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*" required>
            </div>
            <button type="submit" name="btnSubmit" 
            class="btn btn-default">Sign Up</button>
        </form>
        <?php
    if (isset($_POST["btnSubmit"])) {
        $user['first_name'] = $_POST['first_name'];
        $user['last_name'] = $_POST['last_name'];
        $user['email'] = $_POST['emailAddress'];
        Insert_user($user);
        header('Location: unsubscribe.php');
        exit;
    }
    ?>
        <a href="unsubscribe.php">Unsubscribe</a>
    </main>
</div>
</body>
</html>
<?php
    require 'footer.php';
?>