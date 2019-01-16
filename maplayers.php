<?
include("db.inc.php");
function list_routes_layers () {
	global $link, $public_url;
		// filter results by $val of $col
		if (isset($_GET["filter_col"])){
			$col = $_GET["filter_col"];
			$val = $_GET["filter_val"];
			$where = "WHERE ${col} = '{$val}'";
			$note = "Criteria: '<i>${col}</i>' = '<i>${val}</i>'";
		}
		// search fields listed in $col_list in table 'routes' for $_GET["search"] and modify the SELECT query below
		if (isset($_GET["search"])){
			$search = $_GET["search"];
			$col_list = array ('db_id','name', 'routes_id', 'Map_Code', 'Map_Name', 'Associated_Cities', 'SeriesID', 'Ride_Code', 'City', 'State');
			$sql = "WHERE ".$col_list[0]." LIKE '%".$search."%'";
			array_shift($col_list);
			foreach ($col_list as $c) {
				$sql = $sql." OR ".$c." LIKE '%".$search."%'";
			}
			//echo $sql;
			$where = $sql;
			$note = "Searching all fields for: '${search}'";
		}
	// select routes with or without filter or search
	$select_query = mysqli_query($link,"SELECT db_id, name, routes_id, City, State, SeriesID, Map_Name, Map_Code FROM routes ${where} ORDER BY name");
	$qty = mysqli_num_rows($select_query);
	// set default note for unfiltered results
	if (!isset($where)) {
		$note = "Displaying all ${qty} routes. Choose criteria above or search to filter.";
	} else {
		$note = "${qty} results - ".$note;
	}

	// Do not query or display table unless show_all = yes or filter or search
	if ($_GET["show_all"] == "yes" || isset($_GET["filter_col"]) || isset($_GET["search"])) {

			// output table of result data
			while ($d = mysqli_fetch_array($select_query)) {
				//$kml_file_link = "<a href='?action=route_detail&route_id=${d["routes_id"]}'>${d["routes_id"]}</a>";
				//$links_list .= "${kml_file_link} - ${d['name']} <br>\n";
		?>		
		var ctaLayer<?=$d['db_id']?> = new google.maps.KmlLayer({
          url: 'https://hosted.madmaps.com/routedb/database_api.php?action=route_KML&id=<?=$d['db_id']?>&',
          map: map
        });
		<?
		}
	}
}
?>

<!DOCTYPE html>
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
          zoom: 5,
          center: {lat: 35.876, lng: -90.624}
        });

<?=list_routes_layers()?>
      }
    </script>	
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCHS23-X1ykwEmygaJGrIHSD7WX1RDPaI&callback=initMap">
    </script>
  </body>
</html>