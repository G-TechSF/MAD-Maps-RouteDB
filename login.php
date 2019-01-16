<?

//require_once('google-api-php-client-master/src/Google/autoload.php');
/*
session_start();

$client = new Google_Client();
$client->setAuthConfig('client_secrets.json');
$client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
  $drive = new Google_Service_Drive($client);
  $files = $drive->files->listFiles(array())->getItems();
  echo json_encode($files);
} else {
  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php';
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}
*/

?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>MAD Maps Route Database</title>
<style type="text/css">
body {
	background-color: #F0F0F0;
	background-image: url(silver-geometric-repeating-pattern.png);
	background-repeat: repeat;
}
</style>
</head>

<body>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0;">
  <tbody>
    <tr>
      <td height="40%"></td>
      <td height="40%"></td>
      <td height="40%"></td>
    </tr>
    <tr style="opacity: 0.8">
      <td height="20%" bgcolor="#D9D9D9">&nbsp;</td>
      <td bgcolor="#D9D9D9">
		<center>
   		  <form action="?authenticate=yes" method="post">
   		    <img src="MM_logo.png" alt="" width="60" height="59" align="absmiddle"/> <span style="font-size: x-large;font-weight: bold">Route Database Login</span><br>
  		    Password:
			<input type="password" id="password" name="password" maxlength="20">
	        <input type="submit" value="Login">
	        <br>
          </form>
        </center>
		</td>
      <td bgcolor="#D9D9D9">&nbsp;</td>
    </tr>
    <tr>
      <td height="40%"></td>
      <td height="40%"></td>
      <td height="40%"></td>
    </tr>
  </tbody>
</table>
</body>
</html>