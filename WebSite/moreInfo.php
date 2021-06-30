<?php
    /**
     * Movie Search Page
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

    require 'header.php';
    require_once 'database.php';

    $movieID = $_REQUEST['id'];
    $updatingID = $movieID;

    $db = DB_connect();
    $movies_set =  Movie_Details($movieID);
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
    <title>Search Movies</title>
</head>
<body> 
<div id="data-body">       
    <main class="col-lg-10">
        <h1><?php echo $movies['Title']; ?></h1>
        <table>
        <?php echo "
            <tr>
                <th>Title</th>
                <th>Studio</th>
                <th>Status</th>
                <th>Sound</th>
                <th>Versions</th>
                <th>Retail Price</th>
                <th>Rating</th>
                <th>Year</th>
                <th>Genre</th>
                <th>Average Rating</th>
            </tr>
            ";
        while ($movies = mysqli_fetch_assoc($movies_set)) { 
                $ratingTotal = $movies['Rating_Total'];
                $ratingAmount = $movies['Rating_Amount'];
                echo "
                
            <tr>
                <td>".$movies['Title']."</td>
                <td>".$movies['Studio']."</td>
                <td>".$movies['Status']."</td>
                <td>".$movies['Sound']."</td> 
                <td>".$movies['Versions']."</td>
                <td>$".$movies['RecRetPrice']."</td>
                <td>".$movies['Rating']."</td>
                <td>".$movies['Year']."</td>
                <td>".$movies['Genre']."</td>
                <td>".$movies['Rating_Average']."</td>
            </tr>";
        } 
        ?>
    </table>
    <form action="moreInfo.php?id=<?php echo $movieID?>" 
        method="post">
        <div class="form-group">
            <label for="rated">Rate this film between 1 and 100:</label>
            <input type="number" id="rated" name="rated" min="1" max="100" required>
            <button type="submit" name="btnSubmit" class="btn btn-default">
            Submit Rating</button>
        </div>
    </form>
    <?php    
    if (isset($_POST["btnSubmit"])) {  

            $userMovieRating = $_POST['rated'];

            (int)$total = (int)$ratingTotal + (int)$userMovieRating;
            (int)$amount = (int)$ratingAmount + 1;
            (double)$average = (int)$total / (int)$amount;
            Updating_Database_Rating((int)$total, (int)$amount, (double)$average, (int)$updatingID);
            header('Location: search_Movie.php');
            exit;
    }
    ?>
    </main>
</div>
</body>
</html>
<?php
    require 'footer.php';
?>