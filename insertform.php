<style type="text/css">
input[type="text"]
    {
        font-size:20px;
        width:250px;
    }
    textarea {
        font-size:20px;
    }
</style>

<form action="?action=update_route" method="post" enctype="multipart/form-data">

<?
    // Check if this is an insert or an update
        if ($route["db_id"]) {
?>
<input type="hidden" id="db_id" name="db_id" value="<?=$route["db_id"]?>">
<?
        }
    // end check
?>
<br>
	
<TABLE width="1034" align="center">
   <TR>
     <TD width="391" rowspan="6" valign="top"><p><strong>Route Name:</strong>
         <br>
         <input name="name" type="text" value="<?=$route["name"]?>">
     </p>
       <p><strong>Route Serial:</strong>
         <br>
         <input name="routes_id" type="text" value="<?=$route["routes_id"]?>">
       </p>
       <p><strong>Map Code:</strong>
         <br>
         <input name="Map_Code" type="text" value="<?=$route["Map_Code"]?>">
       </p>
       <p><strong>Map Name:</strong>
         <br>
         <input name="Map_Name" type="text" value="<?=$route["Map_Name"]?>">
       </p>
       <p><strong>Associated Cities:</strong>
         <br>
         <input name="Associated_Cities" type="text" value="<?=$route["Associated_Cities"]?>">
       </p>
       <p><strong>Series ID:</strong><br>
         <input name="SeriesID" type="text" value="<?=$route["SeriesID"]?>">
       </p>
       <p><strong>Ride Code:</strong>
         <br>
         <input name="Ride_Code" type="text" value="<?=$route["Ride_Code"]?>">
       </p>
       <p><strong>Ride Number:</strong>
         <br>
         <input name="Ride_Number" type="text" value="<?=$route["Ride_Number"]?>">
       </p>
       <p><strong>City:</strong>
         <br>
         <input name="City" type="text" value="<?=$route["City"]?>">
       </p>
       <p><strong>State: <br>
       </strong>
         <input name="State" type="text" value="<?=$route["State"]?>">
       </p>
       <p><strong>Ride Length (Miles):</strong>
         <br>
         <input name="Ride_length" type="text" value="<?=$route["Ride_length"]?>">
       </p>
       <p><strong>KML File:</strong>
         <br>
         <input type="file" id="KML_file" name="KML_file">
        </p>
       <hr>
       <p style="text-align: center">
         <input type="submit" name="submit" id="submit" value="- Save Changes - ">
         <br>
     </p>
       <p style="text-align: center">Reload original text:<br>
         <input type="reset" name="reset" id="reset" value="- Cancel Changes, Revert -"><br>
           (From last save)
       </p>
      <p style="text-align: center">
       <!-- <input type="submit" name="submit2" id="submit2" value="- Clone Route -"> -->
      </p>
         <hr>
      <p style="text-align: center"><B><span style="font-size: x-small;"> <a href="?action=delete&id=<?=$route["db_id"]?>">Delete</a></span></B></p></TD>
     <TD width="8">&nbsp;</TD>
     <TD width="637"><strong>Description Intro:</strong><br>       
      <textarea name="intro" cols="75" rows="8" id="intro"><?=$route["intro"]?></textarea>
    </TD>
    </TR>
   <TR>
     <TD>&nbsp;</TD>
     <TD><strong>Description Teaser:</strong><br>       
      <textarea name="teaser" cols="75" rows="6" id="teaser"><?=$route["teaser"]?></textarea>
    </TD>
    </TR>
   <TR>
     <TD>&nbsp;</TD>
     <TD><strong>Road Warnings:</strong><br>       
      <textarea name="road_warnings" cols="75" rows="5" id="road_warnings"><?=$route["road_warnings"]?></textarea>
    </TD>
    </TR>
   <TR>
     <TD>&nbsp;</TD>
     <TD><strong>Side Trips:</strong><br>       
      <textarea name="side_trips" cols="75" rows="6" id="side_trips"><?=$route["side_trips"]?></textarea>
    </TD>
    </TR>
   <TR>
     <TD>&nbsp;</TD>
     <TD><strong>Suggested Stops:</strong><br><textarea name="suggested_stops" cols="75" rows="6" id="suggested_stops"><?=$route["suggested_stops"]?></textarea>
    </TD>
    </TR>
   <TR>
     <TD>&nbsp;</TD>
     <TD><strong>Mad World:</strong><br>       
      <textarea name="mad_world" cols="75" rows="6" id="mad_world"><?=$route["mad_world"]?></textarea>
    </TD>
   </TR>
   <TR>
     <TD colspan="3" align="center"><br></TD>
   </TR>
</TABLE>
</form>