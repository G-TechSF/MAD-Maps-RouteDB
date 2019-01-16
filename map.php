<?
include("db.inc.php");
if (isset($_GET["ifttt"])){
    $q = mysqli_query($link,"SELECT url FROM ifttt WHERE id = '".$_GET["ifttt"]."'");
    $d = mysqli_fetch_row($q);
    $url =  $d[0];
} else {
    $url = "https://hosted.madmaps.com/routedb/?action=route_KML&id=".$_GET["id"]."&rnd=".mt_rand('1','1000');
}
?>

<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <title>KML Layers</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 11,
          center: {lat: 41.876, lng: -87.624}
        });
        var ctaLayer = new google.maps.KmlLayer({
          url: '<?=$url?>',
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQS8HiXQigS9BkN2AvolBPWNC8t2txI4Q&callback=initMap">
    </script>
  </body>
</html>