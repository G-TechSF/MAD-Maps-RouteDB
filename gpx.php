<?php
    //enter location of KML file here
	$url_pre = "https://hosted.madmaps.com/routedb/database_api.php?action=route_KML&id=";
	$u = $url_pre.$_GET["id"];

	//$quoted = sprintf('"%s"', addcslashes(basename($file), '"\\'));
	//$size   = filesize($file);

	header('Content-Description: File Transfer');
	header('Content-Type: application/gpx+xml');
	header('Content-Disposition: attachment; filename=MAD_Maps-' . $_GET["id"] . '.gpx'); 
	header('Content-Transfer-Encoding: binary');
	header('Connection: Keep-Alive');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	//header('Content-Length: ' . $size);
     
     
    function utcdate() {
        return gmdate("Y-m-d\Th:i:s\Z");
    }
 
     
    $u_parts = pathinfo($u); //array of url parts
    $u_ext = strtoupper($u_parts['extension']);
	$u_ext = "KML";
    if ($u_ext== "KML") {
 
        $dom_kml = new DOMDocument();
        $dom_kml->load($u);
 
        $dom_gpx = new DOMDocument('1.0', 'UTF-8');
        $dom_gpx->formatOutput = true;
         
        //root node
        $gpx = $dom_gpx->createElement('gpx');
        $gpx = $dom_gpx->appendChild($gpx);
         
        $gpx_version = $dom_gpx->createAttribute('version');
        $gpx->appendChild($gpx_version);
        $gpx_version_text = $dom_gpx->createTextNode('1.0');
        $gpx_version->appendChild($gpx_version_text);
         
        $gpx_creator = $dom_gpx->createAttribute('creator');
        $gpx->appendChild($gpx_creator);
        $gpx_creator_text = $dom_gpx->createTextNode('http://thydzik.com');
        $gpx_creator->appendChild($gpx_creator_text);
         
        $gpx_xmlns_xsi = $dom_gpx->createAttribute('xmlns:xsi');
        $gpx->appendChild($gpx_xmlns_xsi);
        $gpx_xmlns_xsi_text = $dom_gpx->createTextNode('http://www.w3.org/2001/XMLSchema-instance');
        $gpx_xmlns_xsi->appendChild($gpx_xmlns_xsi_text);
         
        $gpx_xmlns = $dom_gpx->createAttribute('xmlns');
        $gpx->appendChild($gpx_xmlns);
        $gpx_xmlns_text = $dom_gpx->createTextNode('http://www.topografix.com/GPX/1/0');
        $gpx_xmlns->appendChild($gpx_xmlns_text);
         
        $gpx_xsi_schemaLocation = $dom_gpx->createAttribute('xsi:schemaLocation');
        $gpx->appendChild($gpx_xsi_schemaLocation);
        $gpx_xsi_schemaLocation_text = $dom_gpx->createTextNode('http://www.topografix.com/GPX/1/0 http://www.topografix.com/GPX/1/0/gpx.xsd');
        $gpx_xsi_schemaLocation->appendChild($gpx_xsi_schemaLocation_text);
         
        $gpx_url = $dom_gpx->createElement('url');
        $gpx_url = $gpx->appendChild($gpx_url);
        $gpx_url_text = $dom_gpx->createTextNode($u_parts['dirname']);
        $gpx_url->appendChild($gpx_url_text);
         
        $gpx_time = $dom_gpx->createElement('time');
        $gpx_time = $gpx->appendChild($gpx_time);
        $gpx_time_text = $dom_gpx->createTextNode(utcdate());
        $gpx_time->appendChild($gpx_time_text);
         
        // placemarks
        $names = array();
        foreach ($dom_kml->getElementsByTagName('Placemark') as $placemark) {
            //name
            foreach ($placemark->getElementsByTagName('name') as $name) {
                $name  = $name->nodeValue;
                //check if the key exists
                if (array_key_exists($name, $names)) {
                    //increment the value
                    ++$names[$name];
                    $name = $name." ({$names[$name]})";
                } else {
                    $names[$name] = 0;
                }
            }
            //description
            foreach ($placemark->getElementsByTagName('description') as $description) {
                $description  = $description->nodeValue;
            }
            foreach ($placemark->getElementsByTagName('Point') as $point) {
                foreach ($point->getElementsByTagName('coordinates') as $coordinates) {
                    //add the marker
                    $coordinate = $coordinates->nodeValue;
                    $coordinate = str_replace(" ", "", $coordinate);//trim white space
                    $latlng = explode(",", $coordinate);
                     
                    if (($lat = $latlng[1]) && ($lng = $latlng[0])) {
                        $gpx_wpt = $dom_gpx->createElement('wpt');
                        $gpx_wpt = $gpx->appendChild($gpx_wpt);
 
                        $gpx_wpt_lat = $dom_gpx->createAttribute('lat');
                        $gpx_wpt->appendChild($gpx_wpt_lat);
                        $gpx_wpt_lat_text = $dom_gpx->createTextNode($lat);
                        $gpx_wpt_lat->appendChild($gpx_wpt_lat_text);
                         
                        $gpx_wpt_lon = $dom_gpx->createAttribute('lon');
                        $gpx_wpt->appendChild($gpx_wpt_lon);
                        $gpx_wpt_lon_text = $dom_gpx->createTextNode($lng);
                        $gpx_wpt_lon->appendChild($gpx_wpt_lon_text);
                         
                        $gpx_time = $dom_gpx->createElement('time');
                        $gpx_time = $gpx_wpt->appendChild($gpx_time);
                        $gpx_time_text = $dom_gpx->createTextNode(utcdate());
                        $gpx_time->appendChild($gpx_time_text);
                         
                        $gpx_name = $dom_gpx->createElement('name');
                        $gpx_name = $gpx_wpt->appendChild($gpx_name);
                        $gpx_name_text = $dom_gpx->createTextNode($name);
                        $gpx_name->appendChild($gpx_name_text);
                         
                        $gpx_desc = $dom_gpx->createElement('desc');
                        $gpx_desc = $gpx_wpt->appendChild($gpx_desc);
                        $gpx_desc_text = $dom_gpx->createTextNode($description);
                        $gpx_desc->appendChild($gpx_desc_text);
                         
                        //$gpx_url = $dom_gpx->createElement('url');
                        //$gpx_url = $gpx_wpt->appendChild($gpx_url);
                        //$gpx_url_text = $dom_gpx->createTextNode($ref);
                        //$gpx_url->appendChild($gpx_url_text);
                         
                        $gpx_sym = $dom_gpx->createElement('sym');
                        $gpx_sym = $gpx_wpt->appendChild($gpx_sym);
                        $gpx_sym_text = $dom_gpx->createTextNode('Waypoint');
                        $gpx_sym->appendChild($gpx_sym_text);
                    }
                }
            }
            foreach ($placemark->getElementsByTagName('LineString') as $lineString) {
                foreach ($lineString->getElementsByTagName('coordinates') as $coordinates) {
                    //add the new track
                    $gpx_trk = $dom_gpx->createElement('trk');
                    $gpx_trk = $gpx->appendChild($gpx_trk);
                     
                    $gpx_name = $dom_gpx->createElement('name');
                    $gpx_name = $gpx_trk->appendChild($gpx_name);
                    $gpx_name_text = $dom_gpx->createTextNode($name);
                    $gpx_name->appendChild($gpx_name_text);
                     
                    $gpx_trkseg = $dom_gpx->createElement('trkseg');
                    $gpx_trkseg = $gpx_trk->appendChild($gpx_trkseg);
                 
                    $coordinates = $coordinates->nodeValue;
                    $coordinates = preg_split("/[\s\r\n]+/", $coordinates); //split the coords by new line
                    foreach ($coordinates as $coordinate) {
                        $latlng = explode(",", $coordinate);
                         
                        if (($lat = $latlng[1]) && ($lng = $latlng[0])) {
                            $gpx_trkpt = $dom_gpx->createElement('trkpt');
                            $gpx_trkpt = $gpx_trkseg->appendChild($gpx_trkpt);
 
                            $gpx_trkpt_lat = $dom_gpx->createAttribute('lat');
                            $gpx_trkpt->appendChild($gpx_trkpt_lat);
                            $gpx_trkpt_lat_text = $dom_gpx->createTextNode($lat);
                            $gpx_trkpt_lat->appendChild($gpx_trkpt_lat_text);
                             
                            $gpx_trkpt_lon = $dom_gpx->createAttribute('lon');
                            $gpx_trkpt->appendChild($gpx_trkpt_lon);
                            $gpx_trkpt_lon_text = $dom_gpx->createTextNode($lng);
                            $gpx_trkpt_lon->appendChild($gpx_trkpt_lon_text);
                             
                            $gpx_time = $dom_gpx->createElement('time');
                            $gpx_time = $gpx_trkpt->appendChild($gpx_time);
                            $gpx_time_text = $dom_gpx->createTextNode(utcdate());
                            $gpx_time->appendChild($gpx_time_text);
                        }
                    }
                }
            }
        }
        header("Content-Type: text/xml");
        echo $dom_gpx->saveXML();
    }