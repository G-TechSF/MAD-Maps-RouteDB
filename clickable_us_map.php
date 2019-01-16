<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>MAD Maps Ride / Route / KML Database</title>
<link rel="icon" href="MM_logo.png">
	
<script language="javascript">
	function refineByCol (col,val) {
		location.href = "?action=route_list&filter_col="+col+"&filter_val="+val;
	}
    // copy URL for Google Earth Pro 
    function copylink() {
          var copyText = document.getElementById("earthURL");
          copyText.select();
          document.execCommand("copy");
          alert("Link has been copied to clipboard.\nPlease paste into Google Earth Pro.");
    }
</script>
	
<style type="text/css">
html {
  scroll-behavior: smooth;
}
body {
	background-image: url('silver-geometric-repeating-pattern.png');
	background-repeat: repeat;
}
</style>
<map NAME="usamapMap">
            <area SHAPE=RECT COORDS="244,49,317,90" HREF="?action=route_list&filter_col=State&filter_val=ND"  ALT="North Dakota"  OnMouseOut="window.status=''; return true"  OnMouseOver="window.status='North Dakota'; return true">
            <area SHAPE=RECT COORDS="239,92,318,141" HREF="?action=route_list&filter_col=State&filter_val=SD"  ALT="South Dakota"  OnMouseOut="window.status=''; return true"  OnMouseOver="window.status='South Dakota'; return true">
            <area SHAPE=RECT COORDS="252,188,339,232" HREF="?action=route_list&filter_col=State&filter_val=KS"  ALT="Kansas"  OnMouseOut="window.status=''; return true"  OnMouseOver="window.status='Kansas'; return true">
            <area shape="poly" coords="14,110,59,120,41,162,92,243,84,276,56,271,23,238,-4,131" href="?action=route_list&filter_col=State&filter_val=CA">
            <area shape="poly" coords="59,122,123,140,106,225,92,224,95,241,41,168" href="?action=route_list&filter_col=State&filter_val=NV">
            <area shape="poly" coords="121,141,155,150,151,159,172,165,168,222,109,213" href="?action=route_list&filter_col=State&filter_val=UT">
            <area shape="poly" coords="109,218" href="#">
            <area shape="poly" coords="110,216,165,227,154,303,128,303,90,275,98,229" href="?action=route_list&filter_col=State&filter_val=AZ">
            <area shape="poly" coords="176,160,254,172" href="#">
            <area shape="poly" coords="174,166,236,171,233,184,254,183,252,232,169,225" href="?action=route_list&filter_col=State&filter_val=CO">
            <area shape="poly" coords="168,226,239,232,232,307,191,301,171,304,153,304" href="?action=route_list&filter_col=State&filter_val=NM">
            <area shape="poly" coords="164,97,238,110,234,167,179,167,151,154" href="?action=route_list&filter_col=State&filter_val=WY">
            <area shape="poly" coords="124,29,242,49,239,109,164,99,136,103,131,81,122,50,119,39" href="?action=route_list&filter_col=State&filter_val=MT">
            <area shape="poly" coords="110,27,125,27,118,49,136,91,138,105,161,105,153,147,90,129" href="?action=route_list&filter_col=State&filter_val=ID">
            <area shape="poly" coords="14,109,86,128,101,71,33,58" href="?action=route_list&filter_col=State&filter_val=OR">
            <area shape="poly" coords="-57,87" href="#">
            <area shape="poly" coords="99,69,109,29,60,18,44,2,44,30,32,53" href="?action=route_list&filter_col=State&filter_val=WA">
            <area shape="poly" coords="237,140,318,137,334,188,259,187,249,170,238,169" href="?action=route_list&filter_col=State&filter_val=NE">
            <area shape="poly" coords="321,134,378,131,384,160,384,175,332,178" href="?action=route_list&filter_col=State&filter_val=IA">
            <area shape="poly" coords="318,53,336,45,391,67,358,91,358,114,374,128,321,132" href="?action=route_list&filter_col=State&filter_val=MN">
            <area shape="poly" coords="377,85,412,98,420,140,385,147,373,123,356,102,363,87" href="?action=route_list&filter_col=State&filter_val=WI">
            <area shape="poly" coords="420,62,501,63,482,150,430,158" href="?action=route_list&filter_col=State&filter_val=MI">
            <area shape="poly" coords="457,199,481,199,498,217,476,229,426,235,412,239,415,227" href="?action=route_list&filter_col=State&filter_val=KY">
            <area shape="poly" coords="416,238,480,233,498,219,483,203,456,197,455,212,425,215,410,230" href="#">
            <area shape="poly" coords="504,169,511,177,524,179,526,191,514,209,500,217,487,203" href="?action=route_list&filter_col=State&filter_val=WV">
            <area shape="poly" coords="454,156,472,153,481,155,499,144,504,168,500,180,490,192,488,200,477,196,464,193,456,180" href="?action=route_list&filter_col=State&filter_val=OH">
            <area shape="poly" coords="503,143,559,132,567,139,564,147,570,156,567,163,509,175" href="?action=route_list&filter_col=State&filter_val=PA">
            <area shape="poly" coords="506,142,557,131,567,139,585,150,596,143,583,140,582,125,574,100,569,80,555,80,515,119" href="?action=route_list&filter_col=State&filter_val=NY">
            <area shape="poly" coords="583,126,598,121,607,126,583,140" href="?action=route_list&filter_col=State&filter_val=CT">
            <area shape="poly" coords="580,115,606,105,621,124,607,125,597,121,582,126" href="?action=route_list&filter_col=State&filter_val=MA">
            <area shape="poly" coords="590,30,615,30,626,53,640,68,610,95,607,104,592,68" href="?action=route_list&filter_col=State&filter_val=ME">
            <area shape="poly" coords="588,69,592,68,607,104,586,112" href="?action=route_list&filter_col=State&filter_val=NH">
            <area shape="poly" coords="569,79,588,70,586,113,579,115" href="?action=route_list&filter_col=State&filter_val=VT">
            <area shape="poly" coords="567,139,588,153,580,175,568,171" href="?action=route_list&filter_col=State&filter_val=NJ">
            <area shape="poly" coords="560,166,568,164,568,171,579,175,569,187" href="?action=route_list&filter_col=State&filter_val=DE">
            <area shape="poly" coords="519,174,560,167,569,186,576,191,558,192,549,191,550,184,540,176,523,179" href="?action=route_list&filter_col=State&filter_val=MD">
            <area shape="poly" coords="535,179,543,178,550,185,548,191,557,194,571,215,487,228,502,217,511,213" href="?action=route_list&filter_col=State&filter_val=VA">
            <area shape="poly" coords="499,227,571,216,576,231,550,264,529,250,514,250,507,248,495,250,485,256,468,256,472,249" href="?action=route_list&filter_col=State&filter_val=NC">
            <area shape="poly" coords="485,257,497,248,530,251,547,263,521,292" href="?action=route_list&filter_col=State&filter_val=SC">
            <area shape="poly" coords="457,260,467,256,487,257,521,294,516,315,510,316,511,320,474,322,469,314" href="?action=route_list&filter_col=State&filter_val=GA">
            <area shape="poly" coords="424,260,457,258,470,318,436,322,427,328,425,311" href="?action=route_list&filter_col=State&filter_val=AL">
            <area shape="poly" coords="432,325,442,322,471,318,478,322,511,320,512,316,517,315,553,376,551,392,544,400,524,386,505,362,498,342,476,340,437,331" href="?action=route_list&filter_col=State&filter_val=FL">
            <area shape="poly" coords="399,262,423,260,427,328,409,331,408,324,384,324,390,297,388,284,393,273" href="?action=route_list&filter_col=State&filter_val=MS">
            <area shape="poly" coords="351,294,389,294,385,323,408,324,410,332,423,352,399,355,373,349,358,344" href="?action=route_list&filter_col=State&filter_val=LA">
            <area shape="poly" coords="342,241,401,240,403,249,386,283,391,293,352,293,351,284,345,284" href="?action=route_list&filter_col=State&filter_val=AR">
            <area shape="poly" coords="388,146,418,144,426,207,421,219,406,229,404,217,393,212,397,202,390,199,380,183" href="?action=route_list&filter_col=State&filter_val=IL">
            <area shape="poly" coords="332,180,376,177,398,206,393,214,405,220,410,233,403,247,401,238,344,242,343,202" href="?action=route_list&filter_col=State&filter_val=MO">
            <area shape="poly" coords="241,231,343,234,344,283,332,280,320,283,305,279,289,275,277,270,277,242,240,239" href="?action=route_list&filter_col=State&filter_val=OK">
            <area shape="poly" coords="238,237,278,241,277,270,304,282,344,285,351,285,356,342,321,369,310,382,313,398,310,407,283,399,271,377,264,358,252,346,236,355,212,347,199,323,191,304,234,308" href="?action=route_list&filter_col=State&filter_val=TX">
            <area shape="poly" coords="423,160,452,154,457,197,434,213,424,214,427,197" href="?action=route_list&filter_col=State&filter_val=IA">
            <area shape="rect" coords="617,130,663,165" href="?action=route_list&filter_col=State&filter_val=RI">
            <area shape="rect" coords="598,184,669,206" href="?action=route_list&filter_col=State&filter_val=CT">
            <area shape="rect" coords="599,215,674,238" href="?action=route_list&filter_col=State&filter_val=NJ">
            <area shape="rect" coords="590,240,665,260" href="?action=route_list&filter_col=State&filter_val=DE">
            <area shape="rect" coords="583,264,656,286" href="?action=route_list&filter_col=State&filter_val=MD">
            <area shape="rect" coords="548,292,632,320" href="?action=route_list&filter_col=State&filter_val=SC">
            <area shape="rect" coords="564,348,614,372" href="?action=route_list&filter_col=State&filter_val=FL">
            <area shape="rect" coords="101,368,161,396" href="?action=route_list&filter_col=State&filter_val=HI">
            <area shape="rect" coords="21,344,94,371" href="?action=route_list&filter_col=State&filter_val=AK">
            <area shape="rect" coords="492,15,586,39" href="?action=route_list&filter_col=State&filter_val=NH">
            <area shape="rect" coords="517,44,569,72" href="?action=route_list&filter_col=State&filter_val=VT">
            <area shape="poly" coords="405,240,494,228,466,255,398,262" href="?action=route_list&filter_col=State&filter_val=TN">
</map>
</head>

<body>
<table width="1228" border="0" align="center" cellpadding="0" cellspacing="0">
  <tbody>
      <tr>
        <td align="left" valign="top" bgcolor="#FFFFFF"><h2> &nbsp;<a href="<?=$public_url?>?action=route_list"><img src="MM_logo.png" alt="" width="60" height="59" align="absmiddle"/></a> <strong>RouteDB</strong> <span style="font-size: small; color: #FF0004;">ALPHA</span><br>
        </h2></td>
        <td width="60%" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><p>&nbsp;</p>
        <p><b><font face="Arial,Helvetica"><font color="#3333FF"><font size=+1 style="color: #9D9D9D">CLICK A STATE TO VIEW MAPS: <br>
        </font></font></font></b><img src="usamap.GIF" border=0 usemap="#usamapMap" height=419 width=666></p></td>
        <td width="19%" rowspan="2" align="left" valign="middle" bgcolor="#FFFFFF"><strong>View routes in Google Earth:</strong><br>
          <span style="font-size: small">1: <a href="https://www.google.com/earth/download/gep/agree.html" target="new">Download Google Earth Pro</a><br>
2: Open Google Earth<br>
3: Right Click on &quot;My Places&quot;<br>
4:
            Add a  Network Link<br>
5: Name the link &quot;MAD Maps&quot;<br>
6: <a href="javascript:copylink();">Copy</a> the following URL: <br>
<input name="earthURL" type="text" id="earthURL" style="width:90%;" value="<?=$public_url?>?action=kml_net_file">
<br>
7: Paste the URL into &quot;Link&quot;<br>
8: Click OK to view routes</span></td>
      </tr>
    <tr>
        <td width="21%" align="left" valign="top" bgcolor="#FFFFFF">
          
          <table width="93%" align="center" cellpadding="0" cellspacing="0" style="">
            <tbody>
              <tr>
                <th colspan="2" align="left"><h3><em><strong>Find Routes:</strong></em></h3></th>
              </tr>
              <tr>
                <td colspan="2">
					<form method="get" action="?">
					  <input name="search" type="text" id="search" placeholder="Search Routes" size="30">
					  <input name="action" type="hidden" id="action" value="route_list">
					  <input type="submit" value="Go">
				  </form>
				</td>
              </tr>
              <tr>
                <td width="50%">State:                </td>
                <td width="50%"><?=loadSelectBox ("State")?></td>
              </tr>
              <tr>
                <td width="50%">City:</td>
                <td width="50%"><?=loadSelectBox ("City")?></td>
              </tr>
              <tr>
                <td width="50%">Map Name:</td>
                <td width="50%"><?=loadSelectBox ("Map_Name")?></td>
              </tr>
              <tr>
                <td width="50%">Ride Series:</td>
                <td width="50%"><?=loadSelectBox ("SeriesID")?></td>
              </tr>
              <tr>
                <td width="50%">Map Code:</td>
                <td width="50%"><?=loadSelectBox ("Map_Code")?></td>
              </tr>
              <tr>
                <td width="50%">Route Serial:                </td>
                <td width="50%"><?=loadSelectBox ("routes_id")?></td>
              </tr>
              <tr>
                <td>Ride Code:</td>
                <td><?=loadSelectBox ("Ride_Code")?></td>
              </tr>
              <tr>
				<td colspan="2" align="left">

				</td>
              </tr>
              <tr>
                <td colspan="2" align="center">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" align="center"><a href="?action=route_list&show_all=yes">Show ALL routes</a> | <a href="?action=insert_form">Add New Route</a></td>
              </tr>
              <tr>
                <td colspan="2" align="center">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" align="left">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" align="center">&nbsp;</td>
              </tr>
              <tr>
                <td height="46" colspan="2" align="center"><a href="?action=insert_form"></a></td>
              </tr>
            </tbody>
          </table>
         </td>
      </tr>
      <tr>
        <td colspan="3" valign="top" bgcolor="#FFFFFF">
			<?=table_content();?>
		</td>
      </tr>
	  <tr>
	  	 <td colspan="3" valign="top" bgcolor="#FFFFFF"><?=list_routes()?></td>
	  </tr>
      <tr bgcolor="#F7F7F7">
        <td colspan="3" align="center" valign="middle" bgcolor="#F1F1F1"> <br>
          <em>- Designed by <a href="http://gtechsf.com" target="new">G-Tech SF</a> for <a href="https://madmaps.com" target="new">MADmaps.com</a> in 2018 -</em><br>        
        <br></td>
      </tr>
    </tbody>
  </table>
  <p><br>
</body>
</html>