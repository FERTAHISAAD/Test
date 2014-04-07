<?php 
session_start();

if(!isset($_SESSION["user"]) || !isset($_SESSION["authorization"])) {
	header("location:./login.php");
}
else {
	$user = $_SESSION['user'];
	$authorization = $_SESSION['authorization'];
	include_once '../lib/lib_mysql.php';
}
?>
<?php
connexion();
$page = $_SERVER["PHP_SELF"];
$show = 'list';
if (isset($_GET['show'])) {
	$show = $_GET['show'];
}

$keyword='';
$message = '<span class="txt_4">Enter the nationality and the country</span>'; 
if (isset($_POST['sub_nationality'])) {
	$nat_design = $_POST['txt_design'];
	$nat_country = $_POST['txt_country'];
	if (!empty($nat_design) && !empty($nat_country)) {
		insert_nationality($nat_design,$nat_country);
	}
	else {
		$message = '<span class="warning_1">You must fill all field !</span>';
	}
}

if (isset($_GET['sub_search']) or isset($_GET['txt_search'])) {
	$keyword = $_GET['txt_search'];
	$show = 'list';	
}

if (isset($_GET['nat_del'])) {

       
        
	if ($authorization[4]==0) 
	
		header('location: access_denied.php');
	else {
		$nat_del = $_GET['nat_del'];
		delete_nationality($nat_del);
	}	
}

?>

<link href="../style/default.css" rel="stylesheet" type="text/css" />
<title>AwaClid - DOC Manager</title>
<table width="100%" height="420" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><table width="100%" height="50" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center"><table width="98%" height="50" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="50%" align="left" class="big_1"><table width="98%" height="50" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="50%" align="left" class="big_1"><img src="../image/design/img_ppm_logo_mini.png" width="500" height="60" /></td>
                  <td width="50%" align="right">&nbsp;</td>
                </tr>
            </table></td>
            <td width="50%" align="right"></td>
          </tr>
        </table></td>
        </tr>
    </table>
      <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
        <tr>
          <td></td>
        </tr>
      </table>
      <table width="98%" height="680" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="82%" align="left" valign="top">
		<?php if ($show=='add') { ?>
		<table width="100%" height="80" border="0" cellpadding="0" cellspacing="0">
              <form id="form_add" name="form_add" method="post" action="">
			  <tr>
                <td align="left" valign="top"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="50%" align="left" class="big_3"><span class="txt_4g">G&egrave;rer Ressources | </span>Ajouter une nouvelle nationalit&eacute; </td>
                      <td width="50%" align="right"><span class="txt_4">|</span> <span class="important_2"><a href="<?php echo $page ?>?show=add">Ajouter une nouvelle nationalit&eacute; </a>&nbsp;&nbsp; <a href="<?php echo $page ?>?show=list"><span class="txt_4">|&nbsp;&nbsp; </span> List of Nationalities </a></span></td>
                    </tr>
                  </table>
                  <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
                    <tr>
                      <td></td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="center" valign="top"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                        <tr>
                          <td align="left">&nbsp;</td>
                        </tr>
                      </table>
                        <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td align="left"><?php //echo $message; ?></td>
                        </tr>
                      </table>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="14%" height="30" align="left" class="txt_1">Nationalit&eacute; <span class="txt_2g">*</span> </td>
                            <td width="36%" align="left"><label>
                              <input name="txt_design" type="text" class="line_3" id="txt_design" size="35" />
                            </label></td>
                            <td width="12%" align="left" class="txt_1">Pays <span class="txt_2g">*</span></td>
                            <td width="38%" align="left"><label>
                              <input name="txt_country" type="text" class="line_3" id="txt_country" size="30" />
                            </label></td>
                          </tr>
                          <tr>
                            <td height="30" align="left">&nbsp;</td>
                            <td align="left"><label>
                              <input name="sub_nationality" type="submit" class="sssabir" id="sub_nationality" value="Envoyer" />
                            </label></td>
                            <td align="left">&nbsp;</td>
                            <td align="left">&nbsp;</td>
                          </tr>
                        </table>
                        <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="14%">&nbsp;</td>
                            <td width="86%" align="left" class="txt_2"> </td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                  </td>
              </tr>
			  </form>
            </table>
			<?php } else { ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="top"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="left" class="title_1"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="50%" align="left" class="big_3"><span class="txt_4g">G&egrave;rer Ressources | </span>List of Nationalities </td>
                          <td width="50%" align="right"><span class="txt_4"> |</span> <span class="important_2"><a href="<?php echo $page ?>?show=add">Ajouter une nouvelle nationalit&eacute; </a>&nbsp;&nbsp; <a href="<?php echo $page ?>?show=list">Lister les  Nationalit&eacute;s </a></span></td>
                        </tr>
                      </table>
                      <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
                          <tr>
                            <td></td>
                          </tr>
                        </table>
                        <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="important_2">
                          <form id="form_search" name="form_search" method="get" action="">
                            <tr>
                              <td align="left" class="txt_2">Chercher :<span class="txt_1"> Par  Nom </span>
                                  <label>
                                  <input name="txt_search" type="text" id="txt_search" value="<?php if (!empty($keyword)) echo $keyword; ?>" onclick="this.value=''"/>
                                  <input name="sub_search" type="submit" class="sssabir" id="sub_search" value="Chercher" />
                                  </label>
                              </td>
                            </tr>
                          </form>
                        </table>
                        <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
                          <tr>
                            <td></td>
                          </tr>
                        </table></td>
                  </tr>
                </table>
                  <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_444">
                    <tr>
                      <td width="6%" align="center">N&deg;</td>
                      <td width="48%" align="left">Nationalit&eacute;</td>
                      <td width="34%" align="left">Pays</td>
                      <td width="12%" align="center">Options</td>
                    </tr>
                  </table>
                  <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
                    <tr>
                      <td></td>
                    </tr>
                  </table>
                  <table width="100%" height="1" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                    <tr>
                      <td></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
			
            <?php echo list_nationality($keyword); ?>
			<?php } ?>
			
			<table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td align="left" class="title_1">&nbsp;</td>
            </tr>
          </table></td>
      </tr>
    </table>
      <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
        <tr>
          <td></td>
        </tr>
      </table>
      <table width="100%" height="50" border="0" cellpadding="0" cellspacing="0" class="bg_menubar">
        <tr>
          <td height="43" align="center" valign="middle"><table width="98%" height="40" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left" class="detail_1">Ecole Superieure de Technologie,MEKNES</td>
              </tr>
          </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<?php deconnexion(); ?>
