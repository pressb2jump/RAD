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
?>
<?php
require 'header.php';
$closeBracket ="&#039) ";
$andGenre = "AND `Genre` IN (&#039";
$andRating = "AND `Rating` IN (&#039";
$yearBracket = ") ";
$andYear = "AND `Year` IN (";
require_once 'database.php';
$db = DB_connect();
$genres_set = Find_genres();
$ratings_set = Find_ratings();
$years_set = Find_years();
$genre = $_POST['genre'];
$year = $_POST['year'];
$rating = $_POST['rating'];
if (isset($_POST["btnSubmit"])) {
    if ($_POST['title'] =='') {
        $title = $_POST['title'];
    } else {
        $title = str_replace("'", "\'", $_POST['title']);
    }    
}
//echo $title.$genre.$year.$rating;
$movies_set = search($title, $rating, $genre, $year);
Update_Search_hits($title, $rating, $genre, $year);
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
<div class="row">
    <nav class="col-lg-2 bg-info">
        <h2 class="text-center">Page Links</h2>
        <ul class="nav nav-pills nav-stacked">
            <li><a href="search_Movie.php">Search Movies</a></li>
            <li><a href="top_Movies.php">Top 10</a></li>
        </ul> 
    </nav>
       
    <main class="col-lg-10">
        <h1>Search for Movies</h1>
        <form action="<?php echo htmlspecialchars(
            $_SERVER["PHP_SELF"]
        ); 
?>" method="post">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" 
                name="title" pattern= "[0-9a-zA-Z\-(): '/&,.*?]*|^$">
            </div>
            <div class="form-group">
                <label for="genre">Genre:</label>
                <select name="genre" id="genre">
                <option selected = "">
                <?php
                while ($row = mysqli_fetch_array($genres_set)) {
                    echo("<option value='".$andGenre.$row['Genre'].$closeBracket."'>
                    ".$row['Genre']."</option>");
                }?>
                </select>
            </div>
            <div class="form-group">
            <label for="rating">Rating:</label>
                <select name="rating" id="rating">
                <option selected = "">
                <?php
                while ($row = mysqli_fetch_array($ratings_set)) {
                    echo("<option value='".$andRating.$row['Rating'].$closeBracket."'>
                ".$row['Rating']."</option>");
                }?>
                </select>
            </div>
            <div class="form-group">
            <label for="year">Year:</label>
                <select name="year" id="year">
                <option selected = "">
                <?php
                while ($row = mysqli_fetch_array($years_set)) {
                    echo("<option value='".$andYear.$row['Year'].$yearBracket."'>
                ".$row['Year']."</option>");
                }?>
                </select>
            </div>
            <button type="submit" name="btnSubmit" 
            class="btn btn-default">Search</button>
        </form>
        <?php
        if (mysqli_num_rows($movies_set)==0) { 
            echo("<h1>0 Search Results</h1>");
        } else {
            $results = mysqli_num_rows($movies_set);
            echo("<h1>$results Search Results</h1>");
        }
        ?>
        <table>
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
        </tr>
        <?php while ($movies = mysqli_fetch_assoc($movies_set)) { ?>
        <tr>
          <td><?php echo $movies['Title']; ?></td>
          <td><?php echo $movies['Studio']; ?></td>
          <td><?php echo $movies['Status']; ?></td>
          <td><?php echo $movies['Sound']; ?></td>
          <td><?php echo $movies['Versions']; ?></td>
          <td><?php echo $movies['RecRetPrice']; ?></td>
          <td><?php echo $movies['Rating']; ?></td>
          <td><?php echo $movies['Year']; ?></td>
          <td><?php echo $movies['Genre']; ?></td>
          </tr>
        <?php } ?>
    </table>
    </main>
</div>
</body>
</html>
<?php
    require 'footer.php';
?>