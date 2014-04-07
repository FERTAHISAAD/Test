<?php 
include_once '../lib/lib_mysql.php';
$user = 'Clid'; 
?>
<?php
connexion();
$page = $_SERVER["PHP_SELF"];

$list = 'all';
if (isset($_GET['list'])) {
	$list = $_GET['list'];
}

$show = 'list';
if (isset($_GET['show'])) {
	$show = $_GET['show'];
}

$keyword='';
$message = '<span class="txt_4">Enter the company and the contact</span>'; 
if (isset($_POST['sub_employee'])) {
	$title = $_POST['select_title'];
	$firstname = $_POST['txt_firstname'];
	$lastname = $_POST['txt_lastname'];
	$nationality = $_POST['select_nationality'];
	$designation = $_POST['txt_designation'];
	$email = $_POST['txt_email'];
	$tel = $_POST['txt_phone'];
	$company = $_POST['select_company'];
	$group = $_POST['select_group'];
	$pass_num = $_POST['txt_num_pass'];
	$pass_file = NULL;
	if (!empty($firstname) && !empty($lastname) && !empty($company)) {
		//////////////////////////////////upload
		
		$up_image = 0;
		$poids_max = 51200000; // Poids max de l'image en octets (1Ko = 1024 octets)
		//$repertoire = '../web/fr/img/puce/'; // Repertoire d'upload en local
		$repertoire = '../fichiers/'; //sur le web
		
		if (isset($_FILES['fichier']))
		{
		   //$nom_fichier = $_FILES['fichier']['name'];
		   $extension = substr(strrchr($_FILES['fichier']['name'], "."), 0);
		   		   
		   // On v�rifit si le r�pertoire d'upload existe
		   if (!file_exists($repertoire))
		   {
			  $erreur = 'Erreur, le dossier d\'upload n\'existe pas.';     
		   }
		   
		   // Si il y a une erreur on l'affiche sinon on peut uploader
		   if(isset($erreur))
		   {
			  $message_up = $erreur ;
		   }
		   else
		   {
				$nom_emp = strtr($firstname," ","_").strtr($lastname," ","_");
				$nom_fichier = 'Pass_'.$nom_emp.$extension;
				// On upload le fichier sur le serveur.
				if (move_uploaded_file($_FILES['fichier']['tmp_name'], $repertoire.$nom_fichier))
				{
					$message_up = 'Votre fichier � �t� attach� avec succ�s !';
					$pass_file = $nom_fichier;
				}
				else
				{
					$message_up = 'Le fichier n\'a pas pu etre attach� !';
				}
		   }
		   
		}
	
		///////////////////////////////////////////////////////////////////////////////////
		
		if (insert_employee($firstname,$lastname,$title,$designation,$email,$tel,$nationality,$company,$group,$pass_num,$pass_file)) {
			$message = '<span class="txt_4">Process done successfully</span>';
		}
		else {
			$message = '<span class="warning_1">Process failed</span>';
		}
		
	}
}

if (isset($_POST['sub_search']) && !empty($_POST['txt_search'])) {
	$keyword = $_POST['txt_search'];
}

$sortby = '';
if (isset($_POST['sortby_company']) && !empty($_POST['sortby_company'])) {
	$sortby = $_POST['sortby_company'];
}

if ((isset($_GET["emp_id"])) /*&& (isset($_GET["emp_name"]))*/) {
	
	  $id = $_GET["emp_id"];
	  $name = $_GET["emp_name"];
	  $designation = $_GET["emp_design"];
	  //$company = $_GET["emp_comp"];
	  
	  
	  echo '<script type="text/javascript">';
	  echo 'window.opener.document.form_add.reset();';
	  echo 'window.opener.document.form_add.elements[\'htxt_employee\'].value=\''.$id.'\';';
	  echo 'window.opener.document.form_add.elements[\'txt_employee\'].value=\''.$name.'\';';
	  echo 'window.opener.document.form_add.elements[\'txt_designation\'].value=\''.$designation.'\';';
	 // echo 'window.opener.document.form_add.elements[\'txt_company\'].value=\''.$company.'\';';
	  
	  echo 'window.close();';
	  echo '</script>';
  
}

?>

<link href="../style/default.css" rel="stylesheet" type="text/css" />
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
            <td width="50%" align="right">&nbsp;</td>
          </tr>
        </table></td>
        </tr>
    </table>
      <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
        <tr>
          <td></td>
        </tr>
      </table>
      <table width="98%" height="30" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left" class="title_1">&nbsp;</td>
        </tr>
      </table>
      <table width="98%" height="30" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left" class="title_1">G&egrave;rer le Employ&eacute;s</td>
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
                    <td width="50%" align="left" class="title_1">Ajout des  Employ&eacute; | <span class="txt_4">Action :</span> <span class="txt_1g">&nbsp;&nbsp;<img src="../image/design/puce_list.png"  width="22" height="22" align="absmiddle" /> <a href="<?php echo $page ?>?show=list">List of Employee </a> </span></td>
                    <td width="50%" align="right" class="txt_1g">&nbsp;</td>
                  </tr>
                </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="left" valign="top"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                          <tr>
                            <td width="14%" align="left"><input name="htxt_id" type="hidden" id="htxt_id" value="<?php if (isset($show_employee)) echo $show_employee['emp_id']; ?>" /></td>
                            <td width="86%" align="left"><?php echo $message; ?></td>
                          </tr>
                        </table>
                          <table width="100%" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                            <tr>
                              <td height="30" align="left" class="txt_1">Titre</td>
                              <td align="left"><label>
                                <select name="select_title" class="line_3" id="select_title">
                                  <?php if (isset($show_employee)) echo '<option value="'.$show_employee['emp_titre'].'" selected="selected">'.$show_employee['emp_titre'].'</option>'; ?>
                                  <option value="Mr." <?php if (!isset($show_employee)) echo 'selected="selected"'; ?> >Mr.</option>
                                  <option value="Mrs.">Mrs.</option>
                                  <option value="Miss">Miss</option>
                                </select>
                                </label>
                              </td>
                            </tr>
                            <tr>
                              <td width="14%" height="30" align="left" class="txt_1">Nom </td>
                              <td width="86%" align="left"><label>
                                <input name="txt_firstname" type="text" class="line_3" id="txt_firstname" size="35"  value="<?php if (isset($show_employee)) echo $show_employee['emp_prenom']; ?>"/>
                              </label></td>
                            </tr>
                            <tr>
                              <td height="30" align="left" class="txt_1">Prenom </td>
                              <td align="left"><label>
                                <input name="txt_lastname" type="text" class="line_3" id="txt_lastname" size="35"  value="<?php if (isset($show_employee)) echo $show_employee['emp_nom']; ?>"/>
                              </label></td>
                            </tr>
                            <tr>
                              <td height="30" align="left" class="txt_1">Nationalit&eacute;</td>
                              <td align="left"><label>
                                <?php if (isset($show_employee)) $id = $show_employee['nat_id']; else $id=''; echo select_nationality($name='select_nationality',$id,$sub=0); ?>
                              </label></td>
                            </tr>
                          </table>
                        <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                            <tr>
                              <td width="14%" align="left">&nbsp;</td>
                              <td width="86%" align="left">&nbsp;</td>
                            </tr>
                          </table>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                            <tr>
                              <td width="14%" height="30" align="left" class="txt_1">D&eacute;signation </td>
                              <td width="86%" align="left"><label>
                                <input name="txt_designation" type="text" class="line_4" id="txt_designation" size="45"  value="<?php if (isset($show_employee)) echo $show_employee['emp_designation']; ?>"/>
                              </label></td>
                            </tr>
                            <tr>
                              <td height="30" align="left" class="txt_1">E-mail </td>
                              <td align="left"><label>
                                <input name="txt_email" type="text" class="line_4" id="txt_email" size="35" value="<?php if (isset($show_employee)) echo $show_employee['emp_email']; ?>"/>
                              </label></td>
                            </tr>
                            <tr>
                              <td height="30" align="left" class="txt_1">GSM </td>
                              <td align="left"><label>
                                <input name="txt_phone" type="text" class="line_4" id="txt_phone" size="35" value="<?php if (isset($show_employee)) echo $show_employee['emp_tel']; ?>"/>
                              </label></td>
                            </tr>
                            <tr>
                              <!--<td height="30" align="left" class="txt_1">Company</td>-->
                              <td align="left"><label>
                                <?php if (isset($show_employee)) $id = $show_employee['comp_id']; else $id=''; echo select_company($name='select_company',$id,$sub=0, 'line_3'); ?>
                              </label></td>
                            </tr>
                            <tr>
                              <td height="30" align="left" class="txt_1">Department</td>
                              <td align="left"><select name="select_group" id="select_group">
                                <?php if (isset($show_employee)) echo '<option value="'.$show_employee['emp_groupe'].'" selected="selected">'.$show_employee['emp_groupe'].'</option>'; ?>
                                <option value="Commercial" selected="selected">Commercial</option>
                                <option value="Finance">Finance</option>
                                <option value="HRA">HRA</option>
                                <option value="Ingineering">Ingineering</option>
                                <option value="IT" <?php if (!isset($show_employee)) echo 'selected="selected"'; ?>>IT</option>
                              </select></td>
                            </tr>
                          </table>
                        <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                          <tr>
                            <td width="14%" align="left">&nbsp;</td>
                            <td width="86%" align="left">&nbsp;</td>
                          </tr>
                        </table>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                          <tr>
                            <td height="30" align="left" class="txt_1">N&deg; CIN </td>
                            <td align="left"><label>
                              <input name="txt_num_pass" type="text" class="line_4" id="txt_num_pass" size="35" value="<?php if (isset($show_employee)) echo $show_employee['emp_num_pass']; ?>"/>
                            </label></td>
                          </tr>
                          <tr>
                            <td width="14%" height="30" align="left" class="txt_1">Copie CIN </td>
                            <td width="86%" align="left"><?php if (isset($show_employee) && !empty($show_employee['emp_attach_pass'])) echo '<a href="#" onclick=" window.open(\'../fichiers/copie_cin/'.$show_employee['emp_attach_pass'].'\',\'List\',\'width=580,height=680,scrollbars=1\').focus();"><img src="../image/icon/kget_list.png" alt="Show the file" width="22" height="22" align="absmiddle" border="0"/></a> -- Update &gt;&gt; '; ?>
                                <input name="fichier" type="file" class="line_4" id="fichier" size="50"/></td>
                          </tr>
                        </table>
                        <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                            <tr>
                              <td width="14%" align="left">&nbsp;</td>
                              <td width="86%" align="left" class="token_1"> </td>
                            </tr>
                          </table>
                        <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                            <tr>
                              <td width="14%" align="left">&nbsp;</td>
                              <td width="86%" align="left"><label>
                                <input name="sub_employee" type="submit" class="btn_link_2" id="sub_employee" value="Submit Employee" />
                              </label></td>
                            </tr>
                        </table></td>
                    </tr>
                  </table></td>
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
                          <td width="50%" align="left" class="title_1">Liste des Employ�s | <span class="txt_4">Action :</span> <span class="txt_1g"><img src="../image/design/puce_add.png"  width="22" height="22" align="absmiddle" /> <a href="<?php echo $page ?>?show=add">Ajouter un nouveau Employe </a></span></td>
                          <td width="50%" align="right" class="title_1">&nbsp;</td>
                        </tr>
                      </table>
                        <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="important_2">
                          <form id="form_search" name="form_search" method="post" action="">
                            <tr>
                              <td align="left" class="txt_2">Chercher :<span class="txt_1"> Par  Nom </span>
                                  <label>
                                  <input name="txt_search" type="text" id="txt_search" value="<?php if (!empty($keyword)) echo $keyword; ?>" onclick="this.value=''"/>
                                  <input name="sub_search" type="submit" class="sssabir"id="sub_search" value="Chercher" />
                                  </label>
                              </td>
                            </tr>
                          </form>
                        </table></td>
                  </tr>
                </table>
                  <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                    <tr>
                      <td width="6%" align="center">N&deg;</td>
                      <td width="36%" align="left">Nom</td>
                      <td width="32%" align="left">Designation </td>
                      <td width="26%" align="left"><table width="100%" height="28" border="0" cellpadding="0" cellspacing="0">
                        <form id="form2" name="form2" method="post" action="">
                          <tr>
                            <td align="left"><?php //echo select_company($name='sortby_company',$sortby,$sub=1, 'line_4'); ?></td>
                          </tr>
                        </form>
                      </table></td>
                    </tr>
                  </table>
                  <table width="100%" height="1" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                    <tr>
                      <td></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
			
            <?php echo list_employee_2($keyword,$sortby); ?>
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
                <td align="left" class="detail_1">Ecole Superieure de Technologie Meknes</td>
              </tr>
          </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<?php deconnexion(); ?>
