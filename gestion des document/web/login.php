<?php 
session_start();
include_once '../lib/lib_mysql.php';
connexion();
$memePage = $_SERVER["PHP_SELF"];
$message = 'Enter le login et le password';
if (isset($_POST['btnConnexion']) && !empty($_POST['txtUtilisateur']) && !empty($_POST['txtMotdepasse'])) {
	$user = $_POST['txtUtilisateur'];
	$motdepasse = $_POST['txtMotdepasse'];	
	if (id_utilisateur($user,$motdepasse)==0) {
		$message = '<span class="txtRouge12b">Le login ou le mot de passe est incorrect !</span>';
	}
	else {
		$show_user = show_user($user);
		$authorization = $show_user['dom_autorisation'];

		$_SESSION['user'] = $user;
		$_SESSION['authorization'] = $authorization;
		header("Location:./");
		exit();
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gestion Documents et Ressources FLO</title>
<link rel="icon" type="image/png" href="favicon.png" />
<link href="../style/default.css" rel="stylesheet" type="text/css" />
<link href="../style/menu.css" rel="stylesheet" type="text/css" />
<style>
table.Form_sabir{
-webkit-box-shadow: 0px 0px 10px #555050;
  box-shadow: 0px 0px 10px #555050;
   margin-top: 200px;
background-color: #807372;
background-image: -webkit-linear-gradient(top,#5f4d4e,#5f4d4e);
background-image: -moz-linear-gradient(top,#5f4d4e,#5f4d4e);
background-image: -ms-linear-gradient(top,#5f4d4e,#5f4d4e);
background-image: -o-linear-gradient(top,#5f4d4e,#5f4d4e);
background-image: linear-gradient(top,#5f4d4e,#5f4d4e);
border: 1px solid transparent;
text-shadow: 0 1px rgba(0, 0, 0, 0.1);
text-transform: uppercase;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
 /* padding: 4px 20px ;*/
  color: #fff ;
  font: bold 13px "Trebuchet MS",Arial,sans-serif ;
  line-height: 1em ;
  text-align: center ;
  text-decoration: none ;


}
</style>
</head>

<body>
<table width="100%" height="759" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="759" align="center" valign="top"><table width="100%" height="751" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="751" align="center" valign="top"><table width="100%" height="80" border="0" cellpadding="0" cellspacing="0" background="../image/design/bg_head_2.png">
          <tr>
            <td width="22%" align="left" valign="top"><img src="../image/design/img_ppm_logo_2.png" width="220" height="80" /></td>
            <td width="78%" align="right" valign="top"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="right"><span class="txt_2"><span class="txt_3">Aujourd'huit <?php echo date_fr_2(date("Y-m-d")); ?></span></span>&nbsp;&nbsp;</td>
                </tr>
              </table>
                <table width="100%" height="50" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="48" align="right" valign="top">&nbsp;</td>
                  </tr>
              </table></td>
          </tr>
        </table>
        <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
            <tr>
              <td></td>
            </tr>
          </table>
          <table width="100%" height="1" border="0" cellspacing="0" cellpadding="0" class="bg_menubar">
            <tr>
              <td></td>
            </tr>
          </table>
          <table width="100%" height="565" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="565" align="center" valign="top"><table width="98%" height="30" border="0" cellpadding="0" cellspacing="0" class="bg_submenubar">
                <tr>
                  <td width="36%" height="27" align="left">&nbsp;</td>
                  <td width="64%" align="right" class="txt_4">
				  </td>
                </tr>
              </table>
                <table class="Form_sabir" width="504" height="240" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="center" valign="middle"><table width="98%" height="121" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="100%" align="center"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="100%" align="center" class="message"><?php echo $message  ?></td>
                          </tr>
                        </table>
                          <table width="80%" border="0" cellpadding="0" cellspacing="0">
                            <form id="form1" name="form1" method="post" action="">
                              <tr>
                                <td width="29%" height="30" align="left" >Login</td>
                                <td width="3%">&nbsp;</td>
                                <td width="68%" align="left"><label>
                                  <input name="txtUtilisateur" type="text" id="txtUtilisateur" />
                                </label></td>
                              </tr>
                              <tr>
                                <td height="30" align="left" >Mot de passe</td>
                                <td>&nbsp;</td>
                                <td align="left"><label>
                                  <input name="txtMotdepasse" type="password" id="txtMotdepasse" />
                                </label></td>
                              </tr>
                              <tr height="40">
                                <td height="30" align="left" class="token_1">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td align="left">
                                <label>
                                  <input name="btnConnexion" class="sssabir"type="submit" id="btnConnexion" value="Connexion" />
                                </label></td>
                              </tr>
                            </form>
                          </table></td>
                      </tr>
                    </table>
                      <table width="100%" height="32" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td align="center" class="txt_4g"></td>
                        </tr>
                      </table></td>
                  </tr>
                </table></td>
            </tr>
          </table>
          </td>
      </tr>
    </table>
      <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter_0.png">
        <tr>
          <td></td>
        </tr>
      </table></td>
  </tr>
</table>

<table width="100%" height="32" border="0" cellpadding="0" cellspacing="0" class="bg_menubar">
  <tr>
    <td align="center">Ecole Superieur de Technologie</td>
  </tr>
</table>
</body>
</html>
