<?php
/**
 * Top 10 Movies Rated
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   Top_Rated
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
$current_results = array();
$last_results = array();
// Uses function from database to get top 10 rated movies
$current = Current_Top_rated();
$last = Compare_Last_rated();
$all_top_rated = All_Top_rated();
//gets current top 10 rated from movies table
while ($currentID = mysqli_fetch_assoc($current)) {
    $current_results[] = $currentID['ID'];
}
//print_r($current_results);
//gets last row of rating table
while ($lastrow = mysqli_fetch_assoc($last)) {
    $last_results = array($lastrow['1st']
    , $lastrow['2nd']
    , $lastrow['3rd']
    , $lastrow['4th']
    , $lastrow['5th']
    , $lastrow['6th']
    , $lastrow['7th']
    , $lastrow['8th']
    , $lastrow['9th']
    , $lastrow['10th']);
}
//print_r($last_results);
//compare 2 arrays and do an update if different
if (array_diff($current_results,$last_results) != null) //different
{
    //print_r(array_diff($current_results,$last_results));
    Insert_New_top10($current_results);
    //echo "Updated";
}
else //same
{
    //echo "same";
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
    <title>Top 10 Rated</title>
     
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
    <main class="col-lg-20">
        <h1>Top 10 Rated Movies</h1>
        <form action="<?php echo htmlspecialchars(
            $_SERVER["PHP_SELF"]
        ); 
?>" method="post">
        <div class="form-group">
                <label for="selection">Date of Ratings:</label>
                <select onChange= "this.form.submit()" name="selection" id="selection">
                <option  <?php ?>>
                <?php
                while ($row = mysqli_fetch_array($all_top_rated)) {
                    echo("<option value='".$row['rating_id']."|".$row['date']."'>
                    ".$row['date']." </option>");
                }?>
                </select>
                <script type="text/javascript">
                    document.getElementById('selection').value = "<?php echo $_GET['selection'];?>";
                </script>
            </div>
        </form>
        <?php
        if (isset($_POST['selection']))
        {
            $value = $_POST['selection'];
            //echo $value;
            $value_explode = explode('|', $value);
            $id = $value_explode[0];
            $date = $value_explode[1];
            //echo $id;
            getResults($id, $date);
        }
        function getResults($id, $date)
        {
            $row = Top_Rated_info($id);
            // unset($results);
            // $results = array();
            while ($movies = mysqli_fetch_assoc($row)) {
                // add to array with Title as index(Key) and Search_Hits as Value 
                $results[] = array("label" => $movies['Title'], "y" => $movies['Rating_Average']);
            }
            //print_r($results);
            build_chart($results, $date);
        }

        function build_chart($results, $date)
        {?>
        <script>
        window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        title: {
            text: "Top 10 rated movies"
        },
        subtitles:[
		{
			text: "<?php echo $date; ?>",
			//Uncomment properties below to see how they behave
			//fontColor: "red",
			fontSize: 30,
            fontWeight: "bold" 
		}
		],
        axisY: {
            title: "Rating Average"
        },
        data: [{
            //legendMarkerType: "square",
            type: "column",
            //showInLegend: true,
            dataPoints:<?php echo json_encode($results, JSON_NUMERIC_CHECK); ?>
            
        }]
        });
        chart.render(); }
        </script>
        <?php }
    ?>
        <div id="chartContainer" style="height: 370px; width: 80%;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </div>
    </main>
</div>
</body>
</html>
<?php
    require 'footer.php';
?>