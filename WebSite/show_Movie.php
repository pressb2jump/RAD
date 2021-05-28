<?php
/**
 * Movie Page
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   Show_Movie
 * @package    PQ6
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
$movies_set = Find_All_movies();
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
    <title>Movies</title>
</head>
<body> 
<div class="row">
    <nav class="col-lg-2 bg-info">
        <h2 class="text-center">Page Links</h2>
        <ul class="nav nav-pills nav-stacked">
            <li><a href="show_Movie.php">Show Movies</a></li>
            <li><a href="search_Movie.php">Search Movies</a></li>
            <li><a href="top_Movies.php">Top 10</a></li>
        </ul> 
    </nav>
       
    <main class="col-lg-20">
        <h1>All Movies</h1>
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