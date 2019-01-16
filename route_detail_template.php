<a id="detail">
<iframe width="100%" height="400" src="map.php?id=<?=$route["db_id"]?>"></iframe>
</a>
<span style="font-size: small">
<script>
window.location.href = "#detail";
</script>
</span><br>
		<div align="right">
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
		    <tbody>
		      <tr>
		        <td colspan="3" align="right" style="text-align: right"><strong>3D Street View:</strong> Drag the <img style="vertical-align: top" src="street_view_icon.png" width="20" height="18" alt=""/> icon (Pegman)  onto the map</td>
	          </tr>
		      <tr>
		        <td width="24%" style="text-align: center"><a href="javascript:window.history.back();">Back to Results</a> | <a href="#top">Search Again</a></td>
		        <td width="54%" align="center"><span style="font-size: medium">Route Details:</span></B><br>
		          <strong style="font-size: xx-large">
		        <?=$RouteName?>
		        </B></h3>
	            </strong></td>
		        <td width="22%" align="center"><b>DOWNLOAD:
                    <?=$kml_file_link?> | <?=$gpx_file_link?>
                </b></td>
	          </tr>
	        </tbody>
	      </table>
		</div>
<?php
	include ("insertform.php");
?>

		<center>
		  <a href="javascript:window.history.back();">Back to Results</a>
		</center>
		<br>