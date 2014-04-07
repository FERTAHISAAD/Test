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
if (isset($_GET["delog"])) {

	session_unset();
	session_destroy();
	header("location:./login.php");
	exit; 
}

connexion();
$same_page = $_SERVER["PHP_SELF"];
$page_inc = './home.php';
$message = '<span class="warning_1">Veuillez remplir tous les champs</span>'; 
if (isset($_GET['page_id'])) {
	switch ($_GET['page_id']) {
		case 'employee':
			$page_inc = './gestion_employee.php';
			if ($authorization[1]==0) $page_inc = './access_denied.php';
			break;
		case 'document':
			$page_inc = './gestion_document.php';
			if ($authorization[13]==0) $page_inc = './access_denied.php';
			break;
		case 'user':
			$page_inc = './gestion_user.php';
			if ($authorization[17]==0) $page_inc = './access_denied.php';
			break;
		case 'group':
			$page_inc = './gestion_groupe.php';
			if ($authorization[21]==0) $page_inc = './access_denied.php';
			break;
		default:
			$page_inc = './home.php';
		
	}
}

$show = 'list';
if (isset($_GET['show'])) {
	$show = $_GET['show'];
	if (($_GET['page_id']=='employee') && ($authorization[2]==0) && ($show=='add')) $page_inc = './access_denied.php';
	if (($_GET['page_id']=='document') && ($authorization[14]==0) && ($show=='add')) $page_inc = './access_denied.php';
	if (($_GET['page_id']=='user') && ($authorization[18]==0) && ($show=='add')) $page_inc = './access_denied.php';
	if (($_GET['page_id']=='group') && ($authorization[22]==0) && ($show=='add')) $page_inc = './access_denied.php';
}

if (isset($_GET['emp_edit'])) {
	if ($authorization[3]==0) 
		$page_inc = './access_denied.php';
	else {
		$emp_edit = $_GET['emp_edit'];
		$show_employee = show_employee($emp_edit);
	}
}

if (isset($_GET['emp_del'])) {
       
	if ($authorization[4]==0) 
		$page_inc = './access_denied.php';
	else {
		$emp_del = $_GET['emp_del'];
		delete_employee($emp_del);
	}	
}
if (isset($_GET['doc_del'])) {
       
	if ($authorization[4]==0) 
		$page_inc = './access_denied.php';
	else {
		$doc_del = $_GET['doc_del'];
		delete_document($doc_del);
	}	
}

if (isset($_POST['sub_employee'])) {
	$title = $_POST['select_title'];
	$firstname = $_POST['txt_firstname'];
	$lastname = $_POST['txt_lastname'];
	$nationality = $_POST['select_nationality'];
	$designation = $_POST['txt_designation'];
	$email = $_POST['txt_email'];
	$tel = $_POST['txt_phone'];
	//$company = $_POST['select_company'];
	$group = $_POST['select_group'];
	$pass_num = $_POST['txt_num_pass'];
	$pass_file = $_POST['htxt_file'];
	if (!empty($firstname) && !empty($lastname) /*&& !empty($company)*/) {
		
		//////////////////////////////////upload
		
		$repertoire = '../fichiers/copie_cin/'; 
		
		if (isset($_FILES['fichier']))
		{
		   //$nom_fichier = $_FILES['fichier']['name'];
		   $extension = substr(strrchr($_FILES['fichier']['name'], "."), 0);
		   		   
		   // On v&eacute;rifit si le r&eacute;pertoire d'upload existe
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
				$nom_fichier = 'cin_'.$nom_emp.$extension;
				// On upload le fichier sur le serveur.
				if (move_uploaded_file($_FILES['fichier']['tmp_name'], $repertoire.$nom_fichier))
				{
					$message_up = 'Le fichier a &eacute;t&eacute; ajout&eacute; avec succes !';
					$pass_file = $nom_fichier;
				}
				else
				{
					$message_up = 'Le fichier ne peut pas etre ajout&eacute; !';
				}
		   }
		   
		}
	
		///////////////////////////////////////////////////////////////////////////////////
		
		if (isset($_POST['htxt_id']) && !empty($_POST['htxt_id'])) {
			//update
			$show = 'add';
			if (update_employee($_POST['htxt_id'],$firstname,$lastname,$title,$designation,$email,$tel,$nationality/*,$company*/,$group,$pass_num,$pass_file)) {
				$message = '<span class="txt_44">Les don&eacute;es ont &eacute;t&eacute; mis à jour avec succ&egrave;s</span>';
				$emp_edit = $_POST['htxt_id'];
				$show_employee = show_employee($emp_edit);
			}
			else {
				$message = '<span class="warning_1">Erreur de mis à jour</span>';
			}
		}
		else {
			// 'insertion';
			if (insert_employee($firstname,$lastname,$title,$designation,$email,$tel,$nationality/*,$company*/,$group,$pass_num,$pass_file)) {
				$message = '<span class="txt_44">Les donn&eacute;es ont &eacute;t&eacute; ajout&eacute;s avec succ&egrave;s</span>';
			}
			else {
				$message = '<span class="warning_1">Erreur d\'ajout</span>';
			}
		}
	}
}

$keyword='';
if (isset($_POST['sub_search']) or isset($_POST['txt_search'])) {
	$keyword = $_POST['txt_search'];
}

if (isset($_GET['sub_search_emp']) or isset($_GET['txt_search_emp'])) {
	$keyword = $_GET['txt_search_emp'];
	$show = 'list';
	$page_inc = './gestion_employee.php';
	if ($authorization[1]==0) $page_inc = './access_denied.php';	
}

if (isset($_GET['sub_search_doc']) or isset($_GET['txt_search_doc'])) {
	$keyword = $_GET['txt_search_doc'];
	$show = 'list';
	$page_inc = './gestion_document.php';
	if ($authorization[13]==0) $page_inc = './access_denied.php';	
}

if (isset($_GET['sub_search_folder']) or isset($_GET['txt_search_folder'])) {
	$keyword = $_GET['txt_search_folder'];
	$show = 'folder';
	$page_inc = './gestion_document.php';
	if ($authorization[13]==0) $page_inc = './access_denied.php';	
}


$sortby = '';
/*
if (isset($_POST['sortby_company']) && !empty($_POST['sortby_company'])) {
	$sortby = $_POST['sortby_company'];
}*/
if (isset($_POST['sortby_typdoc']) && !empty($_POST['sortby_typdoc'])) {
	$sortby = $_POST['sortby_typdoc'];
}
if (isset($_POST['sortby_group']) && !empty($_POST['sortby_group'])) {
	$sortby = $_POST['sortby_group'];
}

if (isset($_POST['sub_document'])) {
	$id = $_POST['htxt_id'];
	$typdoc = $_POST['select_typdoc'];
	$title = $_POST['txt_title'];
	$detail = $_POST['txt_descript'];
	$keyword = $_POST['txt_keyword'];
	$owner = $_POST['txt_owner'];
	$preparedby = $_POST['txt_preparedby'];
	$reviewedby = $_POST['txt_reviewedby'];
	$approvedby = $_POST['txt_approvedby'];
	$creat_date = date_en($_POST['txt_datecreat']);
	$sign_date = date_en($_POST['txt_datesign']);
	//$department = $_POST['select_department'];
	$nbr_page = $_POST['txt_nbr_page'];
		
	$folder = $_POST['select_folder'];
	$status = 1;
		
	if (!empty($typdoc) && !empty($title)) {
			
		if ((isset($_POST['htxt_op'])) && ($_POST['htxt_op'] == 'upd')) {
			//update
			$id_edit = $_POST['htxt_id'];
			$show = 'add';
			if (update_document($id_edit,$title,$detail,$keyword,$owner,$preparedby,$reviewedby,$approvedby,$creat_date,$sign_date,$nbr_page,$status,$typdoc)) {
				$message = '<span class="txt_44">Process done successfully</span>';
				$show_document = show_document($id_edit);
				
				if (isset($_POST['txt_nbr_folder'])) {
				
				$nbr_folder = $_POST['txt_nbr_folder'];
				
				for ($f=1; $f<=$nbr_folder; $f++) {
					$selec_folder = 'select_folder'.$f;
					$txt_precision = 'txt_precision'.$f;
					$htxt_folder = 'htxt_folder'.$f;
					$htxt_precision = 'htxt_precision'.$f;
					$fichier = 'fichier'.$f;
					if (isset($_POST[$selec_folder]) && !empty($_POST[$selec_folder])) {
						//////////////////////////////////upload
						$folder_id1 = $_POST[$selec_folder];
						$precision1 = $_POST[$txt_precision];
						$doc_file1 = NULL;
						
						$hfolder_id = $_POST[$htxt_folder];
						$hprecision = $_POST[$htxt_precision];
						
						$repertoire = '../fichiers/document/'; 
						
						if (isset($_FILES[$fichier]))
						{
						   $extension = substr(strrchr($_FILES[$fichier]['name'], "."), 0);
								   
						   // On v&eacute;rifit si le r&eacute;pertoire d'upload existe
						   if (!file_exists($repertoire))
						   {
							$erreur = '<span class="warning_1">Erreur, le dossier d\'upload n\'existe pas.</span>';     
						   }
						   
						   // Si il y a une erreur on l'affiche sinon on peut uploader
						   if(isset($erreur))
						   {
							  $message_up = $erreur ;
						   }
						   else
						   {
								$typ_doc = strtr($typdoc," ","_");
								$nom_fichier = $typ_doc.'_'.$id.'_'.$f.$extension;
								// On upload le fichier sur le serveur.
								if (move_uploaded_file($_FILES[$fichier]['tmp_name'], $repertoire.$nom_fichier))
								{
									$message_up = '<span class="txt_44">Votre fichier à &eacute;t&eacute; attach&eacute; avec succ&egrave;s !</span>';
									$doc_file1 = $nom_fichier;
								}
								else
								{
									$message_up = '<span class="warning_1">Le fichier n\'a pas pu etre attach&eacute; !</span>';
								}
						   }
						   
						}
						
						update_document_folder($id_edit,$hfolder_id,$id_edit,$folder_id1,$precision1,$doc_file1);
						
						///////////////////////////////////////////////////////////////////////////////////
					
					}
				}
				}
				
				//////////////////////////ajout de fichier attach&eacute;
				
				if (isset($_POST['select_folder']) && !empty($_POST['select_folder'])) {
					//////////////////////////////////upload
					$folder_id = $_POST['select_folder'];
					$precision = $_POST['txt_precision'];
					$doc_file = NULL;
					
					
					$repertoire = '../fichiers/document/'; //sur le web
					
					if (isset($_FILES['fichier']))
					{
					   $extension = substr(strrchr($_FILES['fichier']['name'], "."), 0);
							   
					   // On v&eacute;rifit si le r&eacute;pertoire d'upload existe
					   if (!file_exists($repertoire))
					   {
						  $erreur = '<span class="warning_1">Erreur, le dossier d\'upload n\'existe pas.</span>';     
					   }
					   
					   // Si il y a une erreur on l'affiche sinon on peut uploader
					   if(isset($erreur))
					   {
						  $message_up = $erreur ;
					   }
					   else
					   {
					   		$nbr_folder = nbr_document_folder($id_edit);
							$nbr_folder +=1;
							$typ_doc = strtr($typdoc," ","_");
							$nom_fichier = $typ_doc.'_'.$id_edit.'_'.$nbr_folder.$extension;
							// On upload le fichier sur le serveur.
							if (move_uploaded_file($_FILES['fichier']['tmp_name'], $repertoire.$nom_fichier))
							{
								$message_up = '<span class="txt_44">Votre fichier à &eacute;t&eacute; attach&eacute; avec succ&egrave;s !</span>';
								$doc_file = $nom_fichier;
							}
							else
							{
								$message_up = '<span class="warning_1">Le fichier n\'a pas pu etre attach&eacute; !</span>';
							}
					   }
					   
					}
					
					insert_document_folder($id_edit,$folder_id,$precision,$doc_file);
					
					///////////////////////////////////////////////////////////////////////////////////
				
				}
				
				//////////////////////////////////////////////////
			}
			else {
				$message = '<span class="warning_1">Erreur de l\'envoi </span>';
			}
		}
		else {
			
			if (insert_document($id,$title,$detail,$keyword,$owner,$preparedby,$reviewedby,$approvedby,$creat_date,$sign_date,$nbr_page,$status,$typdoc)) {
				//insert_document_folder($id,$folder,$precision=NULL);
				$message = '<span class="txt_44">Process done successfully</span>';
				
				if (isset($_POST['select_folder']) && !empty($_POST['select_folder'])) {
					//////////////////////////////////upload
					$folder_id = $_POST['select_folder'];
					$precision = $_POST['txt_precision'];
					$doc_file = NULL;
					
					
					$repertoire = '../fichiers/document/'; 
					
					if (isset($_FILES['fichier']))
					{
					  
					   $extension = substr(strrchr($_FILES['fichier']['name'], "."), 0);
							   
					   // On v&eacute;rifit si le r&eacute;pertoire d'upload existe
					   if (!file_exists($repertoire))
					   {
						  $erreur = '<span class="warning_1">Erreur, le dossier d\'upload n\'existe pas.</span>';     
					   }
					   
					   // Si il y a une erreur on l'affiche sinon on peut uploader
					   if(isset($erreur))
					   {
						  $message_up = $erreur ;
					   }
					   else
					   {
							$typ_doc = strtr($typdoc," ","_");
							$nom_fichier = $typ_doc.'_'.$id.'_1'.$extension;
							// On upload le fichier sur le serveur.
							if (move_uploaded_file($_FILES['fichier']['tmp_name'], $repertoire.$nom_fichier))
							{
								$message_up = '<span class="txt_44">Votre fichier à &eacute;t&eacute; attach&eacute; avec succ&egrave;s !</span>';
								$doc_file = $nom_fichier;
							}
							else
							{
								$message_up = '<span class="warning_1">Le fichier n\'a pas pu etre attach&eacute; !</span>';
							}
					   }
					   
					}
					
					insert_document_folder($id,$folder_id,$precision,$doc_file);
					
					///////////////////////////////////////////////////////////////////////////////////
				
				}
				
			}
			else {
				$message = '<span class="warning_1">Erreur de l\'envoi</span>';
			}
		} 
	}
}

if (isset($_GET['user_edit'])) {
	if ($authorization[19]==0) 
		$page_inc = './access_denied.php';
	else {
		$user_edit = $_GET['user_edit'];
		$show_user = show_user($user_edit);
	}
}

if (isset($_GET['user_del'])) {
	if ($authorization[20]==0) 
		$page_inc = './access_denied.php';
	else {
		$user_del = $_GET['user_del'];
		delete_user($user_del);
	}
}

if (isset($_POST['sub_user'])) {
	$employee = $_POST['htxt_employee'];
	$login = $_POST['txt_login'];
	$password = $_POST['txt_password'];
	$confirmation = $_POST['txt_confirm'];
	$group = $_POST['select_group'];
	if (!empty($employee) && !empty($login) && !empty($password) && ($password == $confirmation)) {
		if (isset($_POST['htxt_id']) && !empty($_POST['htxt_id'])) {
			//update
			if (update_user($_POST['htxt_id'],$employee,$login,$password,$group)) {
				$message = '<span class="txt_44">Process done successfully</span>';
				$user_edit = $_POST['htxt_id'];
				$show_user = show_user($user_edit);
			}
			else {
				$message = '<span class="warning_1">Erreur de l\'envoi</span>';
			}
		}
		else {
			// 'insertion';
			if (insert_user($employee,$login,$password_c,$group)) {
				$message = '<span class="txt_44">Process done successfully</span>';
			}
			else {
				$message = '<span class="warning_1">Erreur de l\'envoi</span>';
			}
		}
		
	}
}

if (isset($_GET['group_edit'])) {
	
	if ($authorization[23]==0) 
		$page_inc = './access_denied.php';
	else {
		$group_edit = $_GET['group_edit'];
		$show_domaine = show_domaine($group_edit);
	}
}

if (isset($_GET['group_del'])) {
	
	if ($authorization[24]==0) 
		$page_inc = './access_denied.php';
	else {
		$group_del = $_GET['group_del'];
		delete_group($group_del);
	}
}

if (isset($_POST['sub_group'])) {
	$name = $_POST['txt_name'];
	$description = $_POST['txt_description'];
	$status = $_POST['check_status'];
	$authorization = 0;
	for ($i=1; $i<=24; $i++) {
		$auth_check = "c$i";
		if (isset($_POST[$auth_check]))
			$auth_val = 1;
		else 
			$auth_val = 0;
		$authorization .= $auth_val;
	}
	//echo $authorization;
	if (!empty($name)) {
		if (isset($_POST['htxt_id']) && !empty($_POST['htxt_id'])) {
			//update
			if (update_group($_POST['htxt_id'],$name,$description,$status,$authorization)) {
				$message = '<span class="txt_44">Process done successfully</span>';
				$group_edit = $_POST['htxt_id'];
				$show_domaine = show_domaine($group_edit);
			}
			else {
				$message = '<span class="warning_1">Erreur de l\'envoi</span>';
			}
		}
		else {
			// 'insertion';
			if (insert_group($name,$description,$status,$authorization)) {
				$message = '<span class="txt_44">Process done successfully</span>';
			}
			else {
				$message = '<span class="warning_1">Erreur de l\'envoi</span>';
			}
		}
		
	}
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>Gestion Documents et Ressources FLO</title>
<link rel="icon" type="image/png" href="favicon.png" />
<script type="text/javascript" src="../script/jquery.js"></script> 
<script type="text/javascript" src="../script/thickbox.js"></script>
<link href="../style/thickbox.css" rel="stylesheet" type="text/css" />
<link href="../style/default.css" rel="stylesheet" type="text/css" />
</head>

<body>
	
<table width="100%" height="670" border="0" cellpadding="0" cellspacing="0">
  <tr>
	<td height="670" align="center" valign="top">
	  <table width="100%" height="80" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center" valign="top"><table width="100%" height="180" border="0" cellpadding="0" cellspacing="0" background="../image/design/bg_head_2.png">
              <tr>
                <td width="22%" align="left" valign="top"><img src="../image/design/img_ppm_logo_2.png" width="220" height="80" /></td>
                <td width="78%" align="right" valign="top"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="right"><span class="txt_3">Bienvenue <span class="txt_3g"><?php echo $user ?></span>, Aujourd'huit <?php echo date_fr_2(date("Y-m-d")); ?>&nbsp;&nbsp;|</span>&nbsp;&nbsp;<span  ><a  class="sssabir" href="./?delog=1">D&eacute;connexion</a></span>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                  </tr>
                </table>
                  <table width="100%" height="50" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="150" align="right" valign="bottom">
		      <table width="100%" height="36" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="72%" align="left" valign="middle" ><a class="sssabir1" href="./">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  class="sssabir1" href="./?page_id=document">Gestion de Documents</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="sssabir1" href="./?page_id=employee">Gestion de Ressources</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="sssabir1" href="./?page_id=user">Gestions des utilisateurs</a></td>
                          <!--  <td  align="left" valign="middle"><span class="txt_4g"></span><span ><a class="sssabir" href="./?page_id=user">Gestions des utilisateurs</a></span>&nbsp;&nbsp;&nbsp;&nbsp;</td>-->
                          </tr>
                      </table>
					  </td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
        </tr>
      </table>
	  <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter_0.png">
		<tr>
		  <td></td>
		</tr>
	  </table>
	  <table width="100%" height="1" border="0" cellspacing="0" cellpadding="0" class="bg_menubar">
		<tr>
		  <td></td>
		</tr>
	  </table>
	  <table width="100%" height="583" border="0" cellpadding="0" cellspacing="0">
		<tr>
		  <td height="583" align="center" valign="top"><?php include($page_inc); ?></td>
	    </tr>
	  </table>
	  
    </td>
  </tr>
</table>
	

<table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter_0.png">
  <tr>
    <td></td>
  </tr>
</table>
<table width="100%" height="32" border="0" cellpadding="0" cellspacing="0" class="bg_menubar">
  <tr>
    <td height="32" align="center" valign="middle"><table width="98%" height="32" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="32" align="center">Ecole Superieur de Technologie,MEKNES</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
