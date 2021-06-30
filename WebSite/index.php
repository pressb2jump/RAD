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
    <script src="textAnimation.js" defer></script>

    <title>Search Movies</title>
</head>
<body id="index-body"> 
<div id="data-body">       
    <main class="col-lg-10">
        <a id="title" href="search_Movie.php">Search For Movies</a>
       

        <h1 class="ml1">
            <span class="text-wrapper">
                <span class="line line1"></span>
                <span class="letters">ACME Entertainment pty. ltd.</span>
                <span class="line line2"></span>
            </span>
        </h1>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

         
    </main>
</div>
</body>
</html>
<?php
    require 'footer.php';
?>