﻿<?php 
include_once '../lib/lib_mysql.php';
?>
<?php
connexion();
$page = $_SERVER["PHP_SELF"];
$show = 'list';
if (isset($_GET['show'])) {
	$show = $_GET['show'];
}

$keyword='';
$message = '<span class="txt_4">Enter fodler name and decription</span>'; 
if (isset($_POST['sub_folder'])) {
	$folder_name = $_POST['txt_name'];
	$folder_descrip = $_POST['txt_description'];
	if (!empty($folder_name) && !empty($folder_descrip)) {
		if (isset($_POST['hfield_id']) && !empty($_POST['hfield_id'])) {
			update_folder($_POST['hfield_id'],$folder_name,$folder_descrip,$folder_status=1);
		}
		else {
			insert_folder($folder_name,$folder_descrip,$folder_status=1);
		}
	}
	else {
		$message = '<span class="warning_1">Veuillez remplir tous les champs !</span>';
	}
}

if (isset($_GET['sub_search']) or isset($_GET['txt_search'])) {
	$keyword = $_GET['txt_search'];
	$show = 'list';	
}

if (isset($_GET['folder_edit'])) {
	$folder_edit = $_GET['folder_edit'];
	$show_folder = show_folder($folder_edit);
}

if (isset($_GET['folder_del'])) {
	$folder_del = $_GET['folder_del'];
	delete_folder($folder_del);
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
            <td width="50%" align="right"><span class="txt_4"> </td>
          </tr>
        </table></td>
        </tr>
    </table>
      <table width="98%" height="680" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="82%" align="left" valign="top">
		<?php if ($show=='add') { ?>
		<table width="100%" height="80" border="0" cellpadding="0" cellspacing="0">
              <form id="form_add" name="form_add" method="post" action="">
			  <tr>
                <td align="left" valign="top"><table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
                  <tr>
                    <td></td>
                  </tr>
                </table>
                  <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="50%" align="left" class="big_3"><span class="txt_4g">G&egrave;rer les Dossiers | </span>Ajouter un dossier </td>
                      <td width="50%" align="right"><span class="txt_4">  |</span> <span class="important_2"><a href="<?php echo $page ?>?show=add">Ajouter un dossier </a>&nbsp;&nbsp; <a href="<?php echo $page ?>?show=list">Lister les Dossiers </a></span></td>
                    </tr>
                  </table>
                  <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
                    <tr>
                      <td></td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="center" valign="top"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td align="left"><?php echo $message; ?></td>
                        </tr>
                      </table>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="14%" height="30" align="left" class="txt_1">Nom du Dossier  <span class="txt_2g">*</span> </td>
                            <td width="65%" align="left"><label>
                              <input name="txt_name" type="text" class="line_3" id="txt_name" size="35" value="<?php if (isset($show_folder)) echo $show_folder['folder_name']; ?>"/>
                              <input name="hfield_id" type="hidden" id="hfield_id" value="<?php if (isset($show_folder)) echo $show_folder['folder_id']; ?>"/>
                            </label></td>
                            <td width="5%" align="left" class="txt_1">&nbsp;</td>
                            <td width="16%" align="left"><label></label></td>
                          </tr>
                          <tr>
                            <td height="54" align="left" class="txt_1">Description <span class="txt_2g">*</span></td>
                            <td align="left"><textarea name="txt_description" cols="45" rows="3" class="line_3" id="txt_description"><?php if (isset($show_folder)) echo $show_folder['folder_descript']; ?></textarea></td>
                            <td align="left" class="txt_1">&nbsp;</td>
                            <td align="left">&nbsp;</td>
                          </tr>
                          <tr>
                            <td height="30" align="left">&nbsp;</td>
                            <td align="left"><label>
                              <input name="sub_folder" type="submit" class="sssabir" id="sub_folder" value="Mettre à jour" />
                            </label></td>
                            <td align="left">&nbsp;</td>
                            <td align="left">&nbsp;</td>
                          </tr>
                        </table>
                        <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="14%">&nbsp;</td>
                            <td width="86%" align="left" class="txt_2"></td>
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
                    <td align="left" class="title_1"><table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
                      <tr>
                        <td></td>
                      </tr>
                    </table>
                      <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="50%" align="left" class="big_3"><span class="txt_4g">G&egrave;rer les Dossiers | </span>Liste des Dossiers </td>
                          <td width="50%" align="right"><span class="txt_4">  |</span> <span class="important_2"><a href="<?php echo $page ?>?show=add">Ajouter un dossier </a>&nbsp;&nbsp; <a href="<?php echo $page ?>?show=list">Lister les Dossiers </a></span></td>
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
                              <td align="left" class="txt_2">Chercher :<span class="txt_1"> Par Nom </span>
                                  <label>
                                  <input name="txt_search" type="text" id="txt_search" value="<?php if (!empty($keyword)) echo $keyword; ?>" onclick="this.value=''"/>
                                  <input name="sub_search" type="submit" class="sssabir" id="sub_search" value="Chercher" />
                                  </label>
                              </td>
                            </tr>
                          </form>
                        </table></td>
                  </tr>
                </table>
                  <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_444">
                    <tr>
                      <td width="4%" align="center">N&deg;</td>
                      <td width="28%" align="left">Nom du Dossier </td>
                      <td width="56%" align="left">Description</td>
                      <td width="12%" align="center">Options</td>
                    </tr>
                  </table>
                  <table width="100%" height="1" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                    <tr>
                      <td></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
			
            <?php echo list_folder($keyword); ?>
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
                <td align="center" class="bg_menubar">Ecole Superieure de Technologie,MEKNES</td>
              </tr>
          </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<?php deconnexion(); ?>
