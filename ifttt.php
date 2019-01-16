<?
include("db.inc.php");

$url = $_GET["url"];
$filename = $_GET["name"];
$extension = substr($filename, -4);

if ($extension == ".kml") {
    $filedata = file_get_contents($url);
    $kml = addslashes($filedata);
    if (isset($url)) {
        mysqli_query ($link, "INSERT INTO ifttt VALUES (NULL,'".$filename."','".$url."')");
        $iftttID = mysqli_insert_id($link);
        $query = "INSERT INTO routes (name, routes_id, SeriesID, KML_file) VALUES ('".$filename."','IFTTT".$iftttID."','IFTTT','".$kml."')";
        mysqli_query ($link, $query);
    //    echo $query;
    //    echo mysqli_error($link);
    }
}
?>