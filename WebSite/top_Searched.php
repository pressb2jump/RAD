<?php
/**
 * Top 10 Movies Searched
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   Top_Movies
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
//Require database php for sql statements
require_once 'database.php';
// Require header page
require 'header.php';
//Connect to database
$db = DB_connect();
// declare arrays that will be used below
$results = array();
// Uses function from database to get top 10 movies
$movies_set = Find_Top_movies();
// returns the array as movie_set objects
while ($movies = mysqli_fetch_assoc($movies_set)) {
    // add to array with Title as index(Key) and Search_Hits as Value 
    $results[] = array("label" => $movies['Title'], "y" => $movies['Search_Hits']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="keywords" content="basic, html" />
    <meta name="author" content="Bayley Wise" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!---Style sheets -->
    <link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="StyleSheet.css" />
    <title>Top 10</title>
    <script>
    window.onload = function () {
 
    var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    theme: "light2", // "light1", "light2", "dark1", "dark2"
    title: {
        text: "Top 10 Searched Movies"
    },
    axisY: {
        title: "Number of Searches"
    },
    data: [{
        type: "column",
        dataPoints: <?php echo json_encode($results, JSON_NUMERIC_CHECK); ?>
    }]
    });
    chart.render(); }
    </script> 
</head>
<body>
<div id="data-body" aria-label="Top 10 Searched Movies">      
    <main class="col-lg-12">
        <h1>Top 10 most Searched Movies</h1>
        <div id="chartContainer" style="height: 370px; width: 80%;" 
        aria-label="Chart" role="img"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </div>
    </main>
</div>
</body>
</html>
<?php
    require 'footer.php';
?>