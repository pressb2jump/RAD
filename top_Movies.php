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
require_once 'database.php';
require 'header.php';
$db = DB_connect();
$results = array();
$titleArray = array();
$movies_set = Find_Top_movies();
while ($obj = $movies_set->fetch_object()) {
    for ($i=1; $i <=10; $i++) {
        $results[$obj->Title] = $obj->Search_Hits; 
    }
}
foreach($results as $key => $value)
{
    $titleArray[] = $key;
}
$maxResults = (int)max($results);
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
    <title>Top 10</title>
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
        <h1>Top 10 most Searched Movies</h1>
        <div id= 'chart'>      
        <?php

        /*
        * Chart data
        */
        $data = $results;
        /*
        * Chart settings and create image
        */

        // Image dimensions
        $imageWidth = 700;
        $imageHeight = 1000;
      
        // Grid dimensions and placement within image
        $gridTop = 40;
        $gridLeft = 50;
        $gridBottom = 340;
        $gridRight = 650;
        $gridHeight = $gridBottom - $gridTop;
        $gridWidth = $gridRight - $gridLeft;
        // Bar and line width
        $lineWidth = 1;
        $barWidth = 25;
        // Font settings
        $font = 'Font/arial.ttf';
        $fontSize = 10;
        // Margin between label and axis
        $labelMargin = 8;
        // Max value on y-axis
        $yMaxValue = (int)$maxResults +5;
        // Distance between grid lines on y-axis
        $yLabelSpan = (int)$yMaxValue / 5;
        // Init image
        $chart = imagecreate($imageWidth, $imageHeight);
        // Setup colors
        $backgroundColor = imagecolorallocate($chart, 255, 255, 255);
        $axisColor = imagecolorallocate($chart, 85, 85, 85);
        $labelColor = $axisColor;
        $gridColor = imagecolorallocate($chart, 212, 212, 212);
        //color array
        $red = imagecolorallocate($chart, 255, 0, 0);
        $green = imagecolorallocate($chart, 0, 255, 0);
        $blue = imagecolorallocate($chart, 0, 0, 255);
        $purple = imagecolorallocate($chart, 148, 0, 211);
        $orange = imagecolorallocate($chart, 255,165,0);
        $yellow = imagecolorallocate($chart, 255, 255, 0);
        $brown = imagecolorallocate($chart, 139, 69, 19);
        $pink = imagecolorallocate($chart, 255, 192, 203);
        $lightgrey = imagecolorallocate($chart, 170, 170, 170);
        $darkgrey = imagecolorallocate($chart, 25, 25, 25);
        $colorArray = array();
        $colorArray[1] = $red;
        $colorArray[2] = $green;
        $colorArray[3] = $blue;
        $colorArray[4] = $purple;
        $colorArray[5] = $orange;
        $colorArray[6] = $yellow;
        $colorArray[7] = $brown;
        $colorArray[8] = $pink;
        $colorArray[9] = $lightgrey;
        $colorArray[10] = $darkgrey;
        //$barColor = imagecolorallocate($chart, 255, 195, 0);
        imagefill($chart, 0, 0, $backgroundColor);
        imagesetthickness($chart, $lineWidth);
        /*
        * Print grid lines bottom up
        */
        for ($i = 0; $i <= $yMaxValue; $i += (int)$yLabelSpan) {
            $y = $gridBottom - $i * $gridHeight / $yMaxValue;

            // draw the line
            imageline($chart, $gridLeft, $y, $gridRight, $y, $gridColor);

            // draw right aligned label
            $labelBox = imagettfbbox($fontSize, 0, $font, strval($i));
            $labelWidth = $labelBox[4] - $labelBox[0];

            $labelX = $gridLeft - $labelWidth - $labelMargin;
            $labelY = $y + $fontSize / 2;

            imagettftext(
                $chart, $fontSize, 0, $labelX, $labelY, $labelColor, $font, strval($i)
            );
        }
        /*
        * Draw x- and y-axis
        */
        imageline($chart, $gridLeft, $gridTop, $gridLeft, $gridBottom, $axisColor);
        imageline(
            $chart, $gridLeft, $gridBottom, $gridRight, $gridBottom, $axisColor
        );
        /*
        * Draw the bars with labels
        */
        $barSpacing = $gridWidth / count($data);
        $itemX = $gridLeft + $barSpacing / 2;
        $count = (int)1;
        foreach ($data as $key => $value) {
            // Draw the bar
            $x1 = $itemX - $barWidth / 2;
            $y1 = $gridBottom - $value / $yMaxValue * $gridHeight;
            $x2 = $itemX + $barWidth / 2;
            $y2 = $gridBottom - 1;

            imagefilledrectangle($chart, $x1, $y1, $x2, $y2, $colorArray[$count]);
            $count++;

            // Draw the label
            $labelBox = imagettfbbox($fontSize, 0, $font, $key);
            $labelWidth = $labelBox[5] - $labelBox[1];

            $labelX = $itemX - $labelWidth / 2;
            $labelY = $gridBottom + $labelMargin + $fontSize;

            imagettftext(
                $chart, $fontSize, 270, $labelX, $labelY, $labelColor, $font, $key
            );

            $itemX += $barSpacing;
        }
        /*
        * Output image
        */
        imagepng($chart, "outputimage.png");
        imagedestroy($chart);
        echo "<img src='outputimage.png'><p></p>";
        ?>
    </div>
    <div id = 'top10_table'> 
       <table>
                <tr><th>COLOR</th><th>TITLE</th></tr>
                <tr><td style='background-color: red'>
                </td><td><?php echo $titleArray[0]; ?></td></tr>
                <tr><td style='background-color: limegreen'>
                </td><td><?php echo $titleArray[1]; ?></td></tr>
                <tr><td style='background-color: blue'>
                </td><td><?php echo $titleArray[2]; ?></td></tr>
                <tr><td style='background-color: purple'>
                </td><td><?php echo $titleArray[3]; ?></td></tr>
                <tr><td style='background-color: orange'>
                </td><td><?php echo $titleArray[4]; ?></td></tr>
                <tr><td style='background-color: yellow'>
                </td><td><?php echo $titleArray[5]; ?></td></tr>
                <tr><td style='background-color: saddlebrown'>
                </td><td><?php echo $titleArray[6]; ?></td></tr>
                <tr><td style='background-color: pink'></td>
                <td><?php echo $titleArray[7]; ?></td></tr>
                <tr><td style='background-color: darkgray'></td>
                <td><?php echo $titleArray[8]; ?></td></tr>
                <tr><td style='background-color: black'></td>
                <td><?php echo $titleArray[9]; ?></td></tr>
                
        </table>
     </div>
    </main>
</div>
</body>
</html>
<?php
    require 'footer.php';
?>