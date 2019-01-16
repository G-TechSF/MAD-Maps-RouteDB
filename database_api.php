<?php
/*
* MAD Maps KML Database API
* Designed by Bill Griffith
* Created July 25, 2018

TODO:
	MULTIPLE MAP LAYERS AND SELECTION UI

	POI display and entry

	modify tracks

	create master KML / kmz file without network links

	master kml structure:
	Country -> Region -> State -> City -> Route -> POIs

	create database table specifically for map data
	store kml in broken-down format - coords & places
	
	custom print map templates

*/
// Connect to MySQL
require ("db.inc.php");

// Define public URL of this file
$public_url = "https://hosted.madmaps.com/routedb/database_api.php";

$login_password = "got maps?";

// read command line arguments, if they exist
if(isset($argv))
    foreach ($argv as $arg) {
        $e=explode("=",$arg);
        if(count($e)==2)
            $_GET[$e[0]]=$e[1];
        else    
            $_GET[$e[0]]=0;
    }
// Ask for a password - defined above
function authenticate_basic () {
	global $login_password;
	if (isset($_POST["password"]) && $_POST["password"] == $login_password) {
		header ("Location: ?action=route_list");
	} else {
		include("login.php");
	}
}
// Displays a javascript alert window with script output then returns to page
function js_alert_then_redirect ($message, $url) {
?>
<html>
<head>
<script language="javascript">
alert("<?=$message?>")
document.location = '<?=$url?>'
</script>
</head>
<body></body>
</html>
<?
}
// Insert a row into routes table with a KML file - in progress
function insert_route () {
	global $link;
    // Format form data to MySQL INSERT syntax
	$filedata = file_get_contents($_FILES["KML_file"]["tmp_name"]);
	$formdata = "'${_POST["name"]}', '${_POST["routes_id"]}', '${_POST["Map_Code"]}', '${_POST["Map_Name"]}', '${_POST["Associated_Cities"]}', '${_POST["SeriesID"]}', '${_POST["Ride_Code"]}', '${_POST["Ride_Number"]}', '${_POST["City"]}', '${_POST["State"]}', '${_POST["Ride_length"]}', '${_POST["intro"]}', '${_POST["teaser"]}', '${_POST["road_warnings"]}', '${_POST["side_trips"]}', '${_POST["suggested_stops"]}', '${_POST["mad_world"]}', '".addslashes($filedata)."'";

	$sql = "INSERT INTO `routes` (`name`, `routes_id`, `Map_Code`, `Map_Name`, `Associated_Cities`, `SeriesID`, `Ride_Code`, `Ride_Number`, `City`, `State`, `Ride_length`, `intro`, `teaser`, `road_warnings`, `side_trips`, `suggested_stops`, `mad_world`, `KML_file`) VALUES (${formdata})";
//	mysqli_query ($link, $sql);
	//echo $sql."<br>";
	mysqli_query($link, $sql);
	//echo mysqli_error($link);
	//print_r ($_FILES);
    $insertid = mysqli_insert_id($link);
    js_alert_then_redirect("New Route Inserted!\\n- Redirecting -","?action=route_detail&id=".$insertid);
}
// UPDATE an existing route if a db_id is set"
function update_route_details() {
	global $link;
    // Format form data to MySQL UPDATE syntax
    if (isset($_POST["db_id"])) {
        $formdata = "name = '${_POST["name"]}', routes_id = '${_POST["routes_id"]}', Map_Code = '${_POST["Map_Code"]}', Map_Name = '${_POST["Map_Name"]}', Associated_Cities = '${_POST["Associated_Cities"]}', SeriesID = '${_POST["SeriesID"]}', Ride_Code = '${_POST["Ride_Code"]}', Ride_Number = '${_POST["Ride_Number"]}', City = '${_POST["City"]}', State = '${_POST["State"]}', Ride_length = '${_POST["Ride_length"]}', intro = '". addslashes($_POST["intro"]) . "', teaser = '". addslashes($_POST["teaser"])."', road_warnings = '". addslashes($_POST["road_warnings"]) . "', side_trips = '". addslashes($_POST["side_trips"]) . "', suggested_stops = '". addslashes($_POST["suggested_stops"]) ."', mad_world = '". addslashes($_POST["mad_world"]) . "'";
        // UPDATE query and output
        $query = "UPDATE routes SET ${formdata} WHERE db_id = '${_POST["db_id"]}'";
        //echo $query;
        mysqli_query($link,$query);
        //echo mysqli_error($link);
        //$output = $query . "<br><br>" . mysqli_query($link,$query)."<br>";
        // Upload KML file separately 
        if ($_FILES["KML_file"]["tmp_name"] !== "") {
            $filedata = file_get_contents($_FILES["KML_file"]["tmp_name"]);
            $fileReplace = "UPDATE routes SET KML_file = '" . addslashes($filedata) . "' WHERE db_id = '".$_POST["db_id"]."'";
            mysqli_query($link,$fileReplace);
            //$output = $output.$fileReplace;
        }
    } elseif ($_POST["db_id"] == "") {
        // Output and Defer to insert_route()
        // $output = "<b>New route, using INSERT instead of UPDATE</b><br>";
        insert_route();
    }
    // diagnostic output
    //echo $output;
    $message = "Route Updated!\\nIf you wish to UNDO this change:\\nClick 'Cancel Changes'\\nNOTE: This will only work NOW, and ONCE";
    $url = "javascript:history.back();";
    js_alert_then_redirect($message,$url);
}
/*
open directory, list KML files, update corresponding row in routes table with contents of KML file:
 example: Filename = LN1091.KML -> Query (UPDATE routes set KML_FILE = $contents_of_kml_file)
 action = import_KML & source = $specified_folder
 KML MIME type: application/vnd.google-earth.kml+xml
*/


function import_KML_folder ($kml_path) {
	global $link;	
	//get corrupted files list
	//$query = "SELECT routes_id FROM routes WHERE KML_file NOT LIKE '%</kml>%'";
	$files = array_slice(scandir($kml_path), 2);
	foreach ($files as $filename) {
		$route_id = substr($filename,0,-4);
		$full_path = $kml_path."/".$filename;
		$file_contents = addslashes(file_get_contents($full_path));
		$file_contents = substr($file_contents, strpos($file_contents, "\n")+1);
		$update_query = "UPDATE routes SET KML_file = '${file_contents}' WHERE routes_id = '${route_id}'";
		mysqli_query($link,$update_query);
		echo "${full_path} was added to routes successfully \n";
		echo mysqli_error($link);
	}
}
/*
list all routes from database with KML download link
 action = route_list
*/
function list_routes () {
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
			$col_list = array ('db_id', 'name', 'routes_id', 'Map_Code', 'Map_Name', 'Associated_Cities', 'SeriesID', 'Ride_Code', 'City', 'State');
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
?>
<!--<iframe src="maplayers.php?<?=$_SERVER['QUERY_STRING']?>" width="100%" height="200"></iframe>-->
<table cellpadding="3" cellspacing="0" border="1" width="100%" bordercolor="#ADADAD">
  <tbody>
<?
	// Do not query or display table unless show_all = yes or filter or search
	if ($_GET["show_all"] == "yes" || isset($_GET["filter_col"]) || isset($_GET["search"])) {
?>
	  <tr>
		  <td align="center" colspan="7" bgcolor="#F7F7F7"><span style="font-size:large; font-weight: bold"></span><?=$note?> - <a href="?action=route_list">Clear Results</a></td>
	  </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center"><strong>Serial</strong></td>
      <td align="center"><strong>Name</strong></td>
      <td align="center"><strong>City/State</strong></td>
      <td align="center"><strong>Series</strong></td>
      <td align="center"><strong>Map Name</strong></td>
      <td align="center"><strong>Code</strong></td>
</tr>
<?
        // output table of result data
        while ($d = mysqli_fetch_array($select_query)) {
        //$kml_file_link = "<a href='?action=route_detail&route_id=${d["routes_id"]}'>${d["routes_id"]}</a>";
        //$links_list .= "${kml_file_link} - ${d['name']} <br>\n";
?>
	<tr>
      <td height="25" align="center"><a href="?action=route_detail&id=<?=$d['db_id']?>"><img src="view_edit_icon_60.png" width="30" height="30" alt=""/></a></td>
      <td align="center"><?=$d['routes_id']?></td>
      <td>&nbsp<?=$d['name']?></td>
      <td>&nbsp<?=$d['City']?>, <?=$d['State']?></td>
      <td align="center"><?=$d['SeriesID']?></td>
      <td>&nbsp<?=$d['Map_Name']?></td>
      <td align="center"><?=$d['Map_Code']?></td>
    </tr>
<?
		}
	}
	echo "</tbody></table>";
}
/*
list all data for a specific route
 action = route_detail & route_id = LN1091
*/
function route_details ($route_id) {
	global $link;
	$select_query = "SELECT * from routes where db_id = '${route_id}'";
	$result = mysqli_query($link,$select_query);
	$row = mysqli_fetch_assoc($result);
	$RouteName = $row["name"];
	$RouteLength = $row["Ride_length"];
	$RouteDesc = $row["intro"];
	$kml_file_link = "<a href='?action=route_KML&id=${route_id}'>.KML</a>";
	$gpx_file_link = "<a href='gpx.php?id=${route_id}'>.GPX</a>";
    $route = $row;
	// Load HTML template for Route Detail
	include ("route_detail_template.php");
}
function table_content () {
	if ($_GET["id"]) {
		route_details($_GET["id"]);
	}
}
// Send HTTP headers to browser to force download of file instead of display
function send_download_headers ($filename) {
	header('Content-Description: File Transfer');
    header('Content-Type: application/vnd.google-earth.kml+xml');
    header('Content-Disposition: attachment; filename="'.$filename.'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    flush(); // Flush system output buffer
}
/*
create KML file from row in database, download to client
 action = route_KML & route_id = LN1091
*/
function kml_file_download ($route_id) {
	global $link;
	$select_query = "SELECT name,KML_file from routes where db_id = '${route_id}'";
	$result = mysqli_query($link,$select_query);
	$confirm = mysqli_fetch_assoc($result);
	$file_content =  $confirm["KML_file"];
	$filename = $route_id." - ".$confirm["name"].".kml";
	send_download_headers($filename);
	echo $file_content;
	if ($file_content == NULL){
		echo "ERROR: NO SUCH ROUTE IN DATABASE!\n";
	}
}
// Connector for Google Earth - Combines all routes into one network link
function kml_file_bundle_master () {
	global $public_url,$link;
	send_download_headers("MADmaps_Master_KML_Network.kml");
	// beginning of KML file output
	echo '<?xml version="1.0" encoding="UTF-8"?><kml xmlns="http://www.opengis.net/kml/2.2"><Document>';
	// fetch list of KML file links and create content of KML file
	$query = mysqli_query($link,"SELECT db_id,routes_id,name,KML_file FROM routes ORDER BY name");
	while ($result = mysqli_fetch_array($query)){
		$kml_file = $public_url."?action=route_KML&amp;id=".$result["db_id"];
		//$tquery = "update MM_Rides set KML_file = \"${result["KML_file"]}\" where Ride_Serial = '${result["routes_id"]}'";
		//mysqli_query($link,$tquery);
?>
		<NetworkLink>
		<name><?=$result["name"]?></name>
		<Link>
		<href><?=$kml_file?></href>
		</Link>
		</NetworkLink>
<?php
	}
	echo "</Document></kml>";
	// end of KML file output
}


// display a drop down menu with a list of unique entries of specified field in database ($col)
function loadSelectBox ($col) {
	global $link;
	echo "<select name='${col}' id='${col}' style='width:100px;' onChange=\"javascript:refineByCol('${col}',this.value)\">\n<option value=\"${col}\" SELECTED>${col}</option>\n<option>-----</option>";
	$q = mysqli_query($link, "SELECT ${col} FROM routes WHERE ${col} IS NOT NULL AND ${col} != '' GROUP BY ${col}");
	while ($d = mysqli_fetch_array ($q)) {
		echo "<option value='${d[$col]}'>${d[$col]}</option>";
	}
	echo "</select>";       
}
function top_ten ($col) {
	global $link;
		$q = mysqli_query($link,"SELECT ${col},COUNT(*) AS count FROM routes GROUP BY ${col} ORDER BY count DESC LIMIT 10;");
		while ($d = mysqli_fetch_array($q)) {
			echo "<a href='?action=route_list&filter_col=State&filter_val=${d[${col}]}'>${d[${col}]}</a> - ${d["count"]}<BR>";
		}
}

/*
function merge_tables () {
	global $link;
	$q = mysqli_query($link, "SELECT * FROM MM_Rides");
	while ($d = mysqli_fetch_array($q)) {
		$uq = "UPDATE routes SET Map_Code = '${d["Map_Code"]}', Map_Name = '${d["Map_Name"]}', Associated_Cities = '${d["Associated_Cities"]}', SeriesID = '${d["SeriesID"]}', Ride_Code = '${d["Ride_Code"]}', Ride_Number = '${d["Ride_Number"]}' WHERE routes_id = '${d["Ride_Serial"]}';";
		mysqli_query($link, $uq);
		echo $uq . "<br>";
	}
}
*/


/*
Delete a route by route_id (Added Dec 2018)
First ask if user is sure, then confirm deletion or error.

TODO: Integrate confirmation into main interface
Add more route details to confirmation
*/
function delete_route () {
	global $link;
	if ($_GET["confirm"] == "1") {
		mysqli_query($link,"DELETE FROM routes WHERE db_id = '${_GET["id"]}'");
		if (mysqli_affected_rows ($link) == 0) {
			echo "Error: Route ${_GET["route_id"]} not found. No routes were deleted";
			echo mysqli_error($link);
		} ELSE {
			echo "Route ${_GET["route_id"]} has been deleted.";	
		}
	} ELSE {
		echo "<span style='font-size: xx-large; color: red;'>Are you sure you want to delete record ${_GET["id"]} from the database? This can not be undone.</span> - <a href=\"?action=delete&id=${_GET["id"]}&confirm=1\">YES</a> - <span style=\"font-size: x-large;\"><a href=\"javascript:history.back()\">CANCEL</a></span>";
	}
}


/*
Choose a function to execute based on $_GET["action"]
*/
if (isset($_GET["action"])){
	switch ($_GET["action"]) {
		case "route_list":
			// Display list template / interface with Clickable US MAP from file
			include("clickable_us_map.php");
			break;
		case "route_KML":
			kml_file_download($_GET["id"]);
			break;
		case "route_detail":
			include("clickable_us_map.php");
			break;
		case "kml_net_file":
			kml_file_bundle_master ();
			break;
		case "import_kml":
			import_KML_folder ($_GET["kml_path"]);
			break;
		case "insert_form":
			include("insertform.php");
            //include("clickable_us_map.php");
			break;
		case "insert":
			insert_route();
			break;
        case "update_route":
            update_route_details();
            break;
		case "html_dropdown":
			loadSelectBox ($_GET["col"]);
			break;
		case "delete":
			delete_route();
			break;
	//	case "merge_tables":
	//		merge_tables ();
	//		break;
	}
} else {
	authenticate_basic ();
}
//close the mySQL connection
mysqli_close($link);
?>