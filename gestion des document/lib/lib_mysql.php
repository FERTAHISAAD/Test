﻿<?php 
function connexion()
{
$srv = "localhost";
$usr = "root";
$pwd = "";
$db = "gestion";
$id_connex = mysql_connect($srv, $usr, $pwd)
	or die("Could not connect");
mysql_select_db($db) 
	or die("Could not select database");
}

function deconnexion() {
	mysql_close();
}



function requete_SQL($strSQL) {
	$result = mysql_query($strSQL) or die ("ggggggg".mysql_error());
	if (!$result) {
		$message = 'Une erreur s\'est produite, repartez sur menu principal ou contactez l\'administrateur';
		//die($message); 
	}
	return $result;
}

//date
function date_fr($date) {
	$date_en = substr($date,0,10);
	$aa = substr($date,0,4);
	$mm = substr($date,5,2);
	$jj = substr($date,8,2);
	$date_fr = $jj."-".$mm."-".$aa;
	
	return $date_fr;
}

function date_en($date) {
	$date_fr = substr($date,0,10);
	$aa = substr($date,6,4);
	$mm = substr($date,3,2);
	$jj = substr($date,0,2);
	$date_en = $aa."-".$mm."-".$jj;
	
	return $date_en;
}

function date_fr_2($date) {
	$date_en = substr($date,0,10);
	$jj = substr($date,8,2);
	$mm = substr($date,5,2);
	$aa = substr($date,0,4);
	
	//mois en lettre
	switch ($mm) {
		case "01":
			$mm = "Jan";
			break;
		case "02":
			$mm = "Feb";
			break;
		case "03":
			$mm = "Mar";
			break;
		case "04":
			$mm = "Apr";
			break;
		case "05":
			$mm = "May";
			break;
		case "06":
			$mm = "Jun";
			break;
		case "07":
			$mm = "Jul";
			break;
		case "08":
			$mm = "Aug";
			break;
		case "09":
			$mm = "Sept";
			break;
		case "10":
			$mm = "Oct";
			break;
		case "11":
			$mm = "Nov";
			break;
		case "12":
			$mm = "Dec";
			break;
	}
	////////////////
	$date_fr = $jj."-".$mm."-".$aa;
	
	return $date_fr;
}

//table nationalite
function insert_nationality($design,$country) {
	$strSQL = 'INSERT INTO `enationalite` ( `nat_design`, `nat_country` ) ';
	$strSQL .= 'VALUES ("'.$design.'", "'.$country.'") ';
	$resultat = requete_SQL($strSQL);
	return $resultat;	
}

function update_nationality($id,$design,$country) {
	$strSQL = 'UPDATE `enationalite` SET `nat_design` = "'.$design.'", `nat_country` = "'.$country.'" WHERE CONVERT( `nat_id` USING utf8 ) = '.$id.' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	return $resultat;
}

function delete_nationality($id) {
	$strSQL = 'DELETE FROM `enationalite` WHERE CONVERT( `nat_id` USING utf8 ) = '.$id.' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	return $resultat;
}

function desable_nationality($id) {
	$strSQL = 'SELECT `nat_statut` FROM `enationalite` WHERE `nat_id` = '.$id.' ';
	$resultat = requete_SQL($strSQL);
	$table_result = mysql_fetch_array($resultat);
	if ($table_result['nat_statut'] == 1) {
		$strSQL = 'UPDATE `enationalite` SET `nat_statut` = 0 WHERE CONVERT( `nat_id` USING utf8 ) = '.$id.' LIMIT 1 ;';
		$resultat = requete_SQL($strSQL);
	}
	else {
		$strSQL = 'UPDATE `enationalite` SET `nat_statut` = 1 WHERE CONVERT( `nat_id` USING utf8 ) = '.$id.' LIMIT 1 ;';
		$resultat = requete_SQL($strSQL); 
	}	
	return $resultat;
}

function numberof_nationality($keyword) {
	$strSQL = 'SELECT * FROM `enationalite` WHERE `nat_design` LIKE "%'.$keyword.'%" ;';
	$resultat = requete_SQL($strSQL);
	$retour = mysql_num_rows($resultat);
	return $retour ;
}

function list_nationality($keyword) {
	$strSQL = 'SELECT * FROM `enationalite` WHERE `nat_design` LIKE "%'.$keyword.'%" ORDER BY `nat_design` ;';
	$resultat = requete_SQL($strSQL);
	if (mysql_num_rows($resultat) == 0) {
		$retour = '<span class="warning">Aucun enregistrement !</span>';
	}
	else {
		$rg = 0;
		$retour = '';
		while ($table_result = mysql_fetch_array($resultat)) {
			$rg ++;
			
			if ($table_result['nat_statut'] == 1) {
				$important = 'important_2'; 
			}
			else {
				$important = 'txt_4'; 
			}
			
			$retour .= '
			<table width="98%" class="sab"height="30" border="0" cellpadding="0" cellspacing="0" class="line_2">
              <tr>
                <td width="6%" align="center">'.$rg.'</td>
                <td width="48%" align="left" class="'.$important.'">'.$table_result['nat_design'].'</td>
                <td width="34%" align="left">'.$table_result['nat_country'].'</td>
                <td width="12%" align="center">
					 
					<a href="#"><img src="../image/icon/color_line.png" alt="Edit" width="22" height="22" border="0" align="absmiddle" /></a>&nbsp; 
					<a href="./gestion_nationnalite.php?nat_del='.$table_result['nat_id'].'" onclick="return(confirm(\'Voulez-vous supprimer cette nationalité : '.$table_result['nat_design'].' ?\'));"><img src="../image/icon/cancel.png" alt="supprimer" width="22" height="22" border="0" align="absmiddle" /></a>&nbsp;
				</td>
              </tr>
            </table>';
				
		}
	}
	return $retour;
}

function show_nationality($id) {
	$strSQL = 'SELECT * FROM `enationalite` WHERE CONVERT( `nat_id` USING utf8 ) = '.$id.' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	$table_result = mysql_fetch_array($resultat);
	return $table_result;
}

function select_nationality($name,$id='',$sub=0, $class='line_4') {
	if ($sub==1) $onchange = 'onchange="javascript:submit();"'; else $onchange = '';
	if (!empty($id)) { $nationality = show_nationality($id); $design = $nationality['nat_design']; } else $design = '';
	$select_retour = '<select name="'.$name.'" class="'.$class.'" id="'.$name.'" '.$onchange.' >';
	$select_retour .= '<option value="'.$id.'" selected="selected">'.$design.'</option>';
	$strSQL = 'SELECT `nat_id`, `nat_design` FROM `enationalite` WHERE `nat_statut` = 1 AND `nat_id` <> "'.$id.'" ORDER BY `nat_design`';
	$resultat = requete_SQL($strSQL);
	if (mysql_num_rows($resultat) == 0) {
		$select_retour .= '';
	}
	else {
		
		while ($table_result = mysql_fetch_array($resultat)) {
			$select_retour .= '<option value="'.$table_result['nat_id'].'">'.$table_result['nat_design'].'</option>';	
		}
	
	}
	$select_retour .= '</select>';
	return $select_retour;
		
}

//table companie
function insert_company($nom,$contact,$mail,$tel) {
	$strSQL = 'INSERT INTO `ecompanie` ( `comp_nom`, `comp_contact`, `comp_contact_email`, `comp_contact_tel` ) ';
	$strSQL .= 'VALUES ("'.$nom.'", "'.$contact.'", "'.$mail.'", "'.$tel.'") ';
	$resultat = requete_SQL($strSQL);
	return $resultat;	
}

function update_company($id,$nom,$contact,$mail,$tel) {
	$strSQL = 'UPDATE `ecompanie` SET `comp_nom` = "'.$nom.'", `comp_contact` = "'.$contact.'", `comp_contact_email` = "'.$mail.'", `comp_contact_tel` = "'.$tel.'" WHERE CONVERT( `comp_id` USING utf8 ) = '.$id.' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	return $resultat;
}

function delete_company($id) {
	$strSQL = 'DELETE FROM `ecompanie` WHERE CONVERT( `comp_id` USING utf8 ) = '.$id.' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	return $resultat;
}

function desable_company($id) {
	$strSQL = 'SELECT `comp_statut` FROM `ecompanie` WHERE `comp_id` = '.$id.' ';
	$resultat = requete_SQL($strSQL);
	$table_result = mysql_fetch_array($resultat);
	if ($table_result['comp_statut'] == 1) {
		$strSQL = 'UPDATE `ecompanie` SET `comp_statut` = 0 WHERE CONVERT( `comp_id` USING utf8 ) = '.$id.' LIMIT 1 ;';
		$resultat = requete_SQL($strSQL);
	}
	else {
		$strSQL = 'UPDATE `ecompanie` SET `comp_statut` = 1 WHERE CONVERT( `comp_id` USING utf8 ) = '.$id.' LIMIT 1 ;';
		$resultat = requete_SQL($strSQL); 
	}	
	return $resultat;
}

function numberof_company($keyword) {
	$strSQL = 'SELECT * FROM `ecompanie` WHERE `comp_nom` LIKE "%'.$keyword.'%" ;';
	$resultat = requete_SQL($strSQL);
	$retour = mysql_num_rows($resultat);
	return $retour ;
}

function list_company($keyword) {
	$strSQL = 'SELECT * FROM `ecompanie` WHERE `comp_nom` LIKE "%'.$keyword.'%" ORDER BY `comp_nom` ;';
	$resultat = requete_SQL($strSQL);
	if (mysql_num_rows($resultat) == 0) {
		$retour = '<span class="warning">Aucun enregistrement !</span>';
	}
	else {
		$rg = 0;
		$retour = '';
		while ($table_result = mysql_fetch_array($resultat)) {
			$rg ++;
			
			if ($table_result['comp_statut'] == 1) {
				$important = 'important_2'; 
			}
			else {
				$important = 'txt_4'; 
			}
			
			$retour .= '
			<table width="98%" class="sab" height="30" border="0" cellpadding="0" cellspacing="0" class="line_2">
              <tr>
                <td width="6%" align="center">'.$rg.'</td>
                <td width="48%" align="left" class="'.$important.'">'.$table_result['comp_nom'].'</td>
                <td width="34%" align="left">'.$table_result['comp_contact'].'</td>
                <td width="12%" align="center">
					<a href="#"><img src="../image/icon/button_accept.png" width="22" height="22" border="0" align="absmiddle" /></a>&nbsp; 
					<a href="#"><img src="../image/icon/color_line.png" alt="Edit" width="22" height="22" border="0" align="absmiddle" /></a>&nbsp; 
					<a href="#" onclick="return(confirm(\'Voulez-vous supprimer cette company : '.$table_result['comp_name'].' ?\'));"><img src="../image/icon/cancel.png" alt="supprimer" width="22" height="22" border="0" align="absmiddle" /></a>&nbsp;
				</td>
              </tr>
            </table>';
				
		}
	}
	return $retour;
}

function show_company($id) {
	$strSQL = 'SELECT * FROM `ecompanie` WHERE CONVERT( `comp_id` USING utf8 ) = '.$id.' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	$table_result = mysql_fetch_array($resultat);
	return $table_result;
}

function select_company($name,$id='',$sub=0, $class='line_4') {
	if ($sub==1) $onchange = 'onchange="javascript:submit();"'; else $onchange = '';
	if (!empty($id)) { $company = show_company($id); $design = $company['comp_nom']; } else $design = 'Tous les Companies';
	$select_retour = '<select name="'.$name.'" class="'.$class.'" id="'.$name.'" '.$onchange.' >';
	$select_retour .= '<option value="'.$id.'" selected="selected">'.$design.'</option>';
	if ($sub==1 && !empty($id)) $select_retour .= '<option value="">Tous les Companies</option>';
	$strSQL = 'SELECT `comp_id`, `comp_nom` FROM `ecompanie` WHERE `comp_statut` = 1 AND `comp_id` <> "'.$id.'" ORDER BY `comp_nom`';
	$resultat = requete_SQL($strSQL);
	if (mysql_num_rows($resultat) == 0) {
		$select_retour .= '';
	}
	else {
		
		while ($table_result = mysql_fetch_array($resultat)) {
			$select_retour .= '<option value="'.$table_result['comp_id'].'">'.$table_result['comp_nom'].'</option>';	
		}
	
	}
	$select_retour .= '</select>';
	return $select_retour;
		
}

//table employee
function insert_employee($firstname,$lastname,$title,$designation,$email,$tel,$nationality/*,$company*/,$group,$pass_num,$pass_file) {
	$strSQL = 'INSERT INTO `eemploye` ( `emp_nom`, `emp_prenom`, `emp_titre`, `emp_designation`, `emp_email`, `emp_tel`, `nat_id`, `emp_groupe`, `emp_num_pass`, `emp_attach_pass` ) ';
	$strSQL .= 'VALUES ("'.$lastname.'", "'.$firstname.'", "'.$title.'", "'.$designation.'", "'.$email.'", "'.$tel.'", '.$nationality.', "'.$group.'", "'.$pass_num.'", "'.$pass_file.'") ';
	$resultat = requete_SQL($strSQL);
	return $resultat;	
}

function show_employee($id) {
	$strSQL = 'SELECT `emp_id`, `emp_nom`, `emp_prenom`, `emp_titre`, `emp_designation`, `emp_email`, `emp_tel`, E.`nat_id`, `nat_design`, `emp_num_pass`, `emp_attach_pass`, `emp_groupe`, `emp_statut` FROM `eemploye` E, `enationalite` N WHERE (E.`nat_id` = N.`nat_id`)  AND CONVERT( `emp_id` USING utf8 ) = '.$id.' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL) ;
	$table_result = mysql_fetch_array($resultat)or die ("ssssssssssssssssssss".mysql_error());
	return $table_result;
}

function update_employee($id,$firstname,$lastname,$title,$designation,$email,$tel,$nationality/*,$company*/,$group,$pass_num,$pass_file) {
	//echo $group;
	$strSQL = 'UPDATE `eemploye` SET `emp_nom` = "'.$lastname.'", `emp_prenom` = "'.$firstname.'", `emp_titre` = "'.$title.'", `emp_designation` = "'.$designation.'", `emp_email` = "'.$email.'", `emp_tel` = "'.$tel.'", `nat_id` = "'.$nationality.'",`emp_groupe` = "'.$group.'", `emp_num_pass` = "'.$pass_num.'", `emp_attach_pass` = "'.$pass_file.'" WHERE CONVERT( `emp_id` USING utf8 ) = '.$id.' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	return $resultat;
}

function delete_employee($id) {
	$strSQL = 'DELETE FROM `eemploye` WHERE CONVERT( `emp_id` USING utf8 ) = '.$id.' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	return $resultat;
}

function desable_employee($id) {
	$show_employee = show_employee($id);
	if ($show_employee['emp_statut'] == 1) $set_statut = 0; else $set_statut = 1;
	$strSQL = 'UPDATE `eemploye` SET `emp_statut` = '.$set_statut.' WHERE CONVERT( `emp_id` USING utf8 ) = '.$id.' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);	
	return $resultat;
}

function numberof_employee($keyword) {
	$strSQL = 'SELECT `emp_nom`, `emp_prenom`, `emp_titre`, `emp_designation`, `emp_email`, `emp_tel`, `nat_design`, `comp_nom` FROM `eemployee` E, `enationality` N, `ecompany` C WHERE (`emp_nom` LIKE "%'.$keyword.'%" OR `emp_prenom` LIKE "%'.$keyword.'%") AND (E.`nat_id` = N.`nat_id`) AND (E.`comp_id` = C.`comp_id`) ORDER BY `emp_nom`, `emp_prenom` ;';
	$resultat = requete_SQL($strSQL);
	$retour = mysql_num_rows($resultat);
	return $retour ;
}

function list_employee($keyword,$edit=0,$del=0) {
	//if (!empty($company)) $comp_condition = 'AND E.`comp_id` = '.$company.' '; else $comp_condition = '';
	$strSQL = 'SELECT `emp_id`, `emp_nom`, `emp_prenom`, `emp_titre`, `emp_designation`, `emp_email`, `emp_tel`, `nat_design`, `emp_statut` FROM `eemploye` E, `enationalite` N WHERE (`emp_nom` LIKE "%'.$keyword.'%" OR `emp_prenom` LIKE "%'.$keyword.'%") AND (E.`nat_id` = N.`nat_id`) ORDER BY `emp_nom`, `emp_prenom` ;';
	$resultat = requete_SQL($strSQL);
	if (mysql_num_rows($resultat) == 0) {
		$retour = '<span class="warning">Aucun enregistrement !</span>';
	}
	else {
		$rg = 0;
		$retour = '';
		while ($table_result = mysql_fetch_array($resultat)) {
			$rg ++;
			
			if ($table_result['emp_statut'] == 1) {
				$important = 'important_2'; 
			}
			else {
				$important = 'txt_4'; 
			}
			
			$retour .= '
			<table width="98%"class="sab"  height="30" border="0" cellpadding="0" cellspacing="0" class="line_2">
				<tr ondblclick="window.open(\'./employee_information.php?emp_info='.$table_result['emp_id'].'\',\'Info\',\'width=800,height=580,scrollbars=1\').focus();">
				  <td width="6%" align="center">'.$rg.'</td>
				  <td width="45%" align="left" class="'.$important.'"><span class="txt_4">, '.$table_result['emp_titre'].'</span> '.$table_result['emp_nom'].' '.$table_result['emp_prenom'].'   </td>
				  <td width="34%" align="left"></td>
				  <td width="15%" align="center">';
				  	
					if ($edit==1)
					$retour .= '
				  	<a href="./?page_id=employee&show=add&emp_edit='.$table_result['emp_id'].'"><img src="../image/icon/color_line.png" alt="Edit" width="22" height="22" align="absmiddle" border="0" /></a>
					&nbsp;';
					
					if ($del==1)
					$retour .= '
					<a href="./?page_id=employee&show=list&emp_del='.$table_result['emp_id'].'"><img src="../image/icon/cancel.png" alt="supprimer" width="22" height="22" align="absmiddle" border="0" /></a>
					&nbsp;';
					
					$retour .= '
					<a href=" ./employee_information.php?emp_info='.$table_result['emp_id'].'&KeepThis=true&TB_iframe=true&height=400&width=890" class="thickbox" onkdfkdclick"window.open(\'./employee_information.php?emp_info='.$table_result['emp_id'].'\',\'Info\',\'width=800,height=480,scrollbars=0\').focus();">
					<img src="../image/icon/info.png" alt="Detail" width="22" height="22" align="absmiddle" border="0" />
					</a>
				  </td>
				</tr>
		    </table>';
				
		}
	}
	return $retour;
}

function list_employee_2($keyword) {
	//if (!empty($company)) $comp_condition = 'AND E.`comp_id` = '.$company.' '; else $comp_condition = '';
	$strSQL = 'SELECT `emp_id`, `emp_nom`, `emp_prenom`, `emp_titre`, `emp_designation`, `emp_email`, `emp_tel`, `nat_design`, `emp_statut` FROM `eemploye` E, `enationalite` N WHERE (`emp_nom` LIKE "%'.$keyword.'%" OR `emp_prenom` LIKE "%'.$keyword.'%") AND (E.`nat_id` = N.`nat_id`) AND (E.`emp_statut` = 1)  ORDER BY `emp_nom`, `emp_prenom` ;';
	$resultat = requete_SQL($strSQL);
	if (mysql_num_rows($resultat) == 0) {
		$retour = '<span class="warning">Aucun enregistrement !</span>';
	}
	else {
		$rg = 0;
		$retour = '';
		while ($table_result = mysql_fetch_array($resultat)) {
			$rg ++;
			
			if ($table_result['emp_statut'] == 1) {
				$important = 'important_2'; 
			}
			else {
				$important = 'txt_4'; 
			}
			
			$retour .= '
			<table width="100%" class="sab" height="30" border="0" cellpadding="0" cellspacing="0" class="line_2">
			  <tr>
				  <td width="6%" align="center">'.$rg.'</td>
				  <td width="36%" align="left" class="'.$important.'">
				  	<a href="./employee_list.php?show=list&emp_id='.$table_result['emp_id'].'&emp_name='.$table_result['emp_nom'].' '.$table_result['emp_prenom'].'&emp_design='.$table_result['emp_designation'].'">
				  	<span class="txt_4">, '.$table_result['emp_titre'].'</span>'.$table_result['emp_nom'].' '.$table_result['emp_prenom'].' 
				  </a>
				  </td>
				  <td width="32%" align="left">'.$table_result['emp_designation'].' </td>
				  <td width="26%" align="left"></td>
			  </tr>
			</table>
            <table width="100%" height="1" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td></td>
              </tr>
            </table>';
				
		}
	}
	return $retour;
}

function select_employee($name,$id='',$sub=0, $class='line_4') {
	if ($sub==1) $onchange = 'onchange="javascript:submit();"'; else $onchange = '';
	if (!empty($id)) { $nationality = show_nationality($id); $design = $nationality['nat_design']; } else $design = '';
	$select_retour = '<select name="'.$name.'" class="'.$class.'" id="'.$name.'" '.$onchange.' >';
	$select_retour .= '<option value="'.$id.'" selected="selected">'.$design.'</option>';
	$strSQL = 'SELECT `nat_id`, `nat_design` FROM `enationalite` WHERE `nat_statut` = 1 AND `nat_id` <> "'.$id.'" ORDER BY `nat_design`';
	$resultat = requete_SQL($strSQL);
	if (mysql_num_rows($resultat) == 0) {
		$select_retour .= '';
	}
	else {
		
		while ($table_result = mysql_fetch_array($resultat)) {
			$select_retour .= '<option value="'.$table_result['nat_id'].'">'.$table_result['nat_design'].'</option>';	
		}
	
	}
	$select_retour .= '</select>';
	return $select_retour;
		
}

//table user

function id_utilisateur($nom,$motdepasse) {
	$strSQL2 = 'SELECT * FROM `eutilisateur` WHERE `util_statut` = 1 AND `util_id` = "'.$nom.'" AND `util_pwd` = "'.$motdepasse.'" ;';
	$resultat2 = requete_SQL($strSQL2);
	$retour = mysql_num_rows($resultat2);
	return $retour;
}

function insert_user($employee,$login,$password,$group) {
	$strSQL = 'INSERT INTO `eutilisateur` ( `emp_id`, `util_id`, `util_pwd`, `dom_id` ) ';
	$strSQL .= 'VALUES (\''.$employee.'\', \''.$login.'\', \''.$password.'\', \''.$group.'\' ) ';
	$resultat = requete_SQL($strSQL);
	return $resultat;	
}

function show_user($id) {
	$strSQL = 'SELECT U.`emp_id`, `emp_nom`, `emp_prenom`, `emp_titre`, `emp_designation`, `emp_email`, `emp_tel`, `util_id`, `util_pwd`, `util_statut`, U.`dom_id`, `dom_nom`, `dom_autorisation`, `dom_niveau` FROM `eemploye` E, `eutilisateur` U, `edomaine` D WHERE (U.`emp_id` = E.`emp_id`) AND (U.`dom_id` = D.`dom_id`) AND CONVERT( `util_id` USING utf8 ) = \''.$id.'\' ;';
	$resultat = requete_SQL($strSQL);
	$table_result = mysql_fetch_array($resultat);
	return $table_result;
}

function update_user($id,$employee,$login,$password,$group) {
	$strSQL = 'UPDATE `eutilisateur` SET `emp_id` = \''.$employee.'\', `util_id` = \''.$login.'\', `util_pwd` = \''.$password.'\', `dom_id` = \''.$group.'\' WHERE CONVERT( `util_id` USING utf8 ) = \''.$id.'\' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	return $resultat;
}

function delete_user($id) {
	$strSQL = 'DELETE FROM `eutilisateur` WHERE CONVERT( `util_id` USING utf8 ) = \''.$id.'\' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	return $resultat;
}

function desable_user($id) {
	$show_user = show_user($id);
	if ($show_user['util_statut'] == 1) $set_statut = 0; else $set_statut = 1;
	$strSQL = 'UPDATE `eutilisateur` SET `util_statut` = '.$set_statut.' WHERE CONVERT( `util_id` USING utf8 ) = \''.$id.'\' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);	
	return $resultat;
}

function numberof_user($keyword) {
	$strSQL = 'SELECT `emp_nom`, `emp_prenom`, `emp_titre`, `emp_designation`, `emp_email`, `emp_tel`, `nat_design`, `comp_nom` FROM `eemployee` E, `enationality` N, `ecompany` C WHERE (`emp_nom` LIKE "%'.$keyword.'%" OR `emp_prenom` LIKE "%'.$keyword.'%") AND (E.`nat_id` = N.`nat_id`) AND (E.`comp_id` = C.`comp_id`) ORDER BY `emp_nom`, `emp_prenom` ;';
	$resultat = requete_SQL($strSQL);
	$retour = mysql_num_rows($resultat);
	return $retour ;
}

function list_user($keyword,$group='',$edit=0,$del=0) {
	if (!empty($group)) $comp_condition = 'AND U.`dom_id` = '.$group.' '; else $comp_condition = '';
	if (!empty($keyword)) $key_condition = 'AND (`emp_nom` LIKE \'%'.$keyword.'%\' OR `emp_prenom` LIKE \'%'.$keyword.'%\' OR `util_id` LIKE \'%'.$keyword.'%\') '; else $key_condition = '';
	$strSQL = 'SELECT U.`emp_id`, `emp_nom`, `emp_prenom`, `emp_titre`, `emp_designation`, `emp_email`, `emp_tel`, `util_id`, `util_pwd`, `util_statut`, U.`dom_id`, `dom_nom`, `dom_autorisation`, `dom_niveau` FROM `eemploye` E, `eutilisateur` U, `edomaine` D WHERE (U.`emp_id` = E.`emp_id`) AND (U.`dom_id` = D.`dom_id`) '.$comp_condition.' '.$key_condition.' ORDER BY `util_id` ;';
	$resultat = requete_SQL($strSQL);
	if (mysql_num_rows($resultat) == 0) {
		$retour = '<span class="warning">Aucun enregistrement !</span>';
	}
	else {
		$rg = 0;
		$retour = '';
		while ($table_result = mysql_fetch_array($resultat)) {
			$rg ++;
			
			if ($table_result['util_statut'] == 1) {
				$important = 'important_2'; 
			}
			else {
				$important = 'txt_4'; 
			}
			
			$retour .= '
			
			<table width="100%" height="30" class="sab" border="0" cellpadding="0" cellspacing="0" class="line_2">
				<tr ondblclick="window.open(\'./user_information.php?user_info='.$table_result['util_id'].'\',\'List\',\'width=800,height=580,scrollbars=1\').focus();">
				  <td width="4%" align="center">'.$rg.'</td>
				  <td width="22%" align="left" class="'.$important.'">'.$table_result['util_id'].'  </td>
				  <td width="40%" align="left">'.$table_result['emp_nom'].' '.$table_result['emp_prenom'].'</td>
				  <td width="23%" align="left">'.$table_result['dom_nom'].'</td>
				  <td width="11%" align="center">';
				  	
					if ($edit==1)
					$retour .= '
				    <a href="./?page_id=user&show=add&user_edit='.$table_result['util_id'].'"><img src="../image/icon/color_line.png" alt="Edit" width="22" height="22" align="absmiddle" border="0" /></a>
					&nbsp;';
					
					if ($del==1)
					$retour .= '
					<a href="./?page_id=user&show=list&user_del='.$table_result['util_id'].'"><img src="../image/icon/cancel.png" alt="supprimer" width="22" height="22" align="absmiddle" border="0" /></a>
					&nbsp;';
					
					$retour .= '
					<a href="./user_information.php?user_info='.$table_result['util_id'].'&KeepThis=true&TB_iframe=true&height=400&width=890" class="thickbox" onkjkclick="window.open(\'./user_information.php?user_info='.$table_result['util_id'].'&KeepThis=true&TB_iframe=true&height=400&width=650\',\'Info\',\'width=800,height=380,scrollbars=0\').focus();">
					<img src="../image/icon/info.png" alt="Detail" width="22" height="22" align="absmiddle" border="0" />
					</a>
				  </td>
				</tr>
			</table>
			
			<table width="100%" height="1" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td></td>
              </tr>
            </table>';
				
		}
	}
	return $retour;
}

function list_user_of_domain($group='') {
	if (!empty($group)) $comp_condition = 'AND U.`dom_id` = '.$group.' '; else $comp_condition = '';
	$strSQL = 'SELECT U.`emp_id`, `emp_nom`, `emp_prenom`, `emp_titre`, `emp_designation`, `emp_email`, `emp_tel`, `util_id`, `util_pwd`, `util_statut`, U.`dom_id`, `dom_nom`, `dom_autorisation`, `dom_niveau` FROM `eemploye` E, `eutilisateur` U, `edomaine` D WHERE (U.`emp_id` = E.`emp_id`) AND (U.`dom_id` = D.`dom_id`) '.$comp_condition.' ORDER BY `util_id` ;';
	$resultat = requete_SQL($strSQL);
	if (mysql_num_rows($resultat) == 0) {
		$retour = '<span class="warning">Aucun enregistrement !</span>';
	}
	else {
		$rg = 0;
		$retour = '';
		while ($table_result = mysql_fetch_array($resultat)) {
			$rg ++;
			
			if ($table_result['util_statut'] == 1) {
				$important = 'important_2'; 
			}
			else {
				$important = 'txt_4'; 
			}
			
			$retour .= '
			<table width="100%" height="28" class="sab" border="0" cellpadding="0" cellspacing="0" class="line_4">
				<tr>
				  <td width="4%" align="center">-</td>
				  <td width="96%" align="left"><span class="'.$important.'">'.$table_result['util_id'].'</span> <span class="txt_1">('.$table_result['emp_prenom'].' '.$table_result['emp_nom'].') </span> </td>
				</tr>
			</table>
			
			<table width="100%" height="1" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td></td>
              </tr>
            </table>';
				
		}
	}
	return $retour;
}


function show_domaine($id) {
	$strSQL = 'SELECT * FROM `edomaine` WHERE CONVERT( `dom_id` USING utf8 ) = '.$id.' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	$table_result = mysql_fetch_array($resultat);
	return $table_result;
}

function select_domaine($name,$id='',$sub=0, $class='line_4') {
	if ($sub==1) $onchange = 'onchange="javascript:submit();"'; else $onchange = '';
	if (!empty($id)) { $show_domaine = show_domaine($id); $design = $show_domaine['dom_nom']; } else $design = 'Tous les Groupes';
	$select_retour = '<select name="'.$name.'" class="'.$class.'" id="'.$name.'" '.$onchange.' >';
	$select_retour .= '<option value="'.$id.'" selected="selected">'.$design.'</option>';
	if ($sub==1 && !empty($id)) $select_retour .= '<option value="">Tous les Groupes</option>';
	$strSQL = 'SELECT `dom_id`, `dom_nom` FROM `edomaine` WHERE `dom_statut` = 1 AND `dom_id` <> "'.$id.'" ORDER BY `dom_nom`';
	$resultat = requete_SQL($strSQL);
	if (mysql_num_rows($resultat) == 0) {
		$select_retour .= '';
	}
	else {
		
		while ($table_result = mysql_fetch_array($resultat)) {
			$select_retour .= '<option value="'.$table_result['dom_id'].'">'.$table_result['dom_nom'].'</option>';	
		}
	
	}
	$select_retour .= '</select>';
	return $select_retour;
		
}

function insert_group($name,$description,$status,$authorization) {
	$strSQL = 'INSERT INTO `edomaine` ( `dom_nom`, `dom_description`, `dom_statut`, `dom_autorisation` ) ';
	$strSQL .= 'VALUES (\''.$name.'\', \''.$description.'\', \''.$status.'\', \''.$authorization.'\' ) ';
	$resultat = requete_SQL($strSQL);
	return $resultat;	
}

function update_group($id,$name,$description,$status,$authorization) {
	$strSQL = 'UPDATE `edomaine` SET `dom_nom` = \''.$name.'\', `dom_description` = \''.$description.'\', `dom_statut` = \''.$status.'\', `dom_autorisation` = \''.$authorization.'\' WHERE CONVERT( `dom_id` USING utf8 ) = \''.$id.'\' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	return $resultat;
}

function delete_group($id) {
	$strSQL = 'DELETE FROM `edomaine` WHERE CONVERT( `dom_id` USING utf8 ) = \''.$id.'\' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	return $resultat;
}

function desable_group($id) {
	$show_domaine = show_domaine($id);
	if ($show_domaine['dom_statut'] == 1) $set_statut = 0; else $set_statut = 1;
	$strSQL = 'UPDATE `edomaine` SET `dom_statut` = '.$set_statut.' WHERE CONVERT( `dom_id` USING utf8 ) = \''.$id.'\' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);	
	return $resultat;
}

function list_group($keyword='',$edit=0,$del=0) {
	$strSQL = 'SELECT * FROM `edomaine` WHERE (`dom_nom` LIKE \'%'.$keyword.'%\' OR `dom_description` LIKE \'%'.$keyword.'%\') ORDER BY `dom_nom` ;';
	$resultat = requete_SQL($strSQL);
	if (mysql_num_rows($resultat) == 0) {
		$retour = '<span class="warning">Aucun enregistrement !</span>';
	}
	else {
		$rg = 0;
		$retour = '';
		while ($table_result = mysql_fetch_array($resultat)) {
			$rg ++;
			
			if ($table_result['dom_statut'] == 1) {
				$important = 'important_2'; 
			}
			else {
				$important = 'txt_4'; 
			}
			
			$retour .= '
			<table width="100%" height="30" class="sab" border="0" cellpadding="0" cellspacing="0" class="line_2">
			<tr>
			  <td width="4%" align="center">
				  <table width="22" height="22" border="0" cellpadding="0" cellspacing="0"><tr><td>
				  <div id="img_'.$table_result['dom_id'].'" style="background:url(../image/icon/treeview_p.png)" onclick="javascript:change_icone(\'a_'.$table_result['dom_id'].'\',\'img_'.$table_result['dom_id'].'\');visibilite(\'a_'.$table_result['dom_id'].'\');" >
					<table width="22" height="22" border="0" cellpadding="0" cellspacing="0">
					  <tr>
						<td>&nbsp;</td>
					  </tr>
					</table>
				  </div>
				  </td></tr></table>
			  </td>
			  <td width="22%" align="left" class="'.$important.'">'.$table_result['dom_nom'].' </td>
			  <td align="left">'.$table_result['dom_description'].' </td>
			  <td width="11%" align="center">';
			  
			  if ($edit==1)
				$retour .= '
			  	<a href="./?page_id=group&show=add&group_edit='.$table_result['dom_id'].'"><img src="../image/icon/color_line.png" alt="Edit" width="22" height="22" align="absmiddle" border="0" /></a>
				&nbsp;';
				
				if ($del==1)
				$retour .= '
				<a href="./?page_id=group&show=list&group_del='.$table_result['dom_id'].'"><img src="../image/icon/cancel.png" alt="supprimer" width="22" height="22" align="absmiddle" border="0" /></a>
				&nbsp;';
				
				$retour .= '
			  </td>
			</tr>
		    </table>
			
			<table width="100%" height="1" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td></td>
              </tr>
            </table>';
			
			$retour .= '<div id="a_'.$table_result['dom_id'].'" style="display:none">'.list_user_of_domain($table_result['dom_id']).'</div>';
				
		}
	}
	return $retour;
}

//typedoc
function show_typdoc($id) {
	$strSQL = 'SELECT * FROM `etypdoc` WHERE CONVERT( `typdoc_id` USING utf8 ) = '.$id.' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	$table_result = mysql_fetch_array($resultat);
	return $table_result;
}

function insert_typdoc($nom,$descript,$statut) {
	$strSQL = 'INSERT INTO `etypdoc` ( `typdoc_title`, `typdoc_descript`, `typdoc_status` ) ';
	$strSQL .= 'VALUES ("'.$nom.'", "'.$descript.'", "'.$statut.'") ';
	$resultat = requete_SQL($strSQL);
	return $resultat;	
}

function update_typdoc($id,$nom,$descript,$statut) {
	$strSQL = 'UPDATE `etypdoc` SET `typdoc_title` = "'.$nom.'", `typdoc_descript` = "'.$descript.'", `typdoc_status` = "'.$statut.'" WHERE CONVERT( `typdoc_id` USING utf8 ) = '.$id.' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	return $resultat;
}

function delete_typdoc($id) {
	$strSQL = 'DELETE FROM `etypdoc` WHERE CONVERT( `typdoc_id` USING utf8 ) = '.$id.' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	return $resultat;
}

function desable_typdoc($id) {
	$show_typdoc = show_typdoc($id);
	if ($show_typdoc['typdoc_status'] == 1) $set_statut = 0; else $set_statut = 1;
	$strSQL = 'UPDATE `etypdoc` SET `typdoc_status` = '.$set_statut.' WHERE CONVERT( `typdoc_id` USING utf8 ) = '.$id.' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL); 
	return $resultat;
}

function numberof_typdoc($keyword) {
	$strSQL = 'SELECT * FROM `etypdoc` WHERE `typdoc_title` LIKE "%'.$keyword.'%" ;';
	$resultat = requete_SQL($strSQL);
	$retour = mysql_num_rows($resultat);
	return $retour ;
}

function list_typdoc($keyword) {
	$strSQL = 'SELECT * FROM `etypdoc` WHERE `typdoc_title` LIKE "%'.$keyword.'%" ORDER BY `typdoc_title` ;';
	$resultat = requete_SQL($strSQL);
	if (mysql_num_rows($resultat) == 0) {
		$retour = '<span class="warning">Aucun enregistrement !</span>';
	}
	else {
		$rg = 0;
		$retour = '';
		while ($table_result = mysql_fetch_array($resultat)) {
			$rg ++;
			
			if ($table_result['typdoc_status'] == 1) {
				$important = 'important_2'; 
			}
			else {
				$important = 'txt_4'; 
			}
			
			$retour .= '
			<table width="98%" height="30" class="sab" border="0" cellpadding="0" cellspacing="0" class="line_2">
				<tr>
				  <td width="4%" align="center">'.$rg.'</td>
				  <td width="28%" align="left" class="'.$important.'">'.$table_result['typdoc_title'].'</td>
				  <td width="56%" align="left">'.$table_result['typdoc_descript'].'</td>
				  <td width="12%" align="center">
					<a href="gestion_doctype.php?show=add&typdoc_edit='.$table_result['typdoc_id'].'"><img src="../image/icon/color_line.png" alt="Edit" width="22" height="22" border="0" align="absmiddle" /></a>&nbsp; 
					<a href="gestion_doctype.php?show=lis&typdoc_del='.$table_result['typdoc_id'].'" onclick="return(confirm(\'Voulez-vous supprimer ce type de document  : '.$table_result['typdoc_title'].' ?\'));"><img src="../image/icon/cancel.png" alt="supprimer" width="22" height="22" border="0" align="absmiddle" /></a>&nbsp;
				  </td>
				</tr>
			</table>';
				
		}
	}
	return $retour;
}

function select_typedoc($name,$id='',$sub=0, $class='line_4') {
	if ($sub==1) $onchange = 'onchange="javascript:submit();"'; else $onchange = '';
	if (!empty($id)) { $typdoc = show_typdoc($id); $design = $typdoc['typdoc_title']; } else $design = 'Tous les Types';
	$select_retour = '<select name="'.$name.'" class="'.$class.'" id="'.$name.'" '.$onchange.' >';
	$select_retour .= '<option value="'.$id.'" selected="selected">'.$design.'</option>';
	if ($sub==1 && !empty($id)) $select_retour .= '<option value="">Tous les Types</option>';
	$strSQL = 'SELECT `typdoc_id`, `typdoc_title` FROM `etypdoc` WHERE `typdoc_status` = 1 AND `typdoc_id` <> "'.$id.'" ORDER BY `typdoc_title`';
	$resultat = requete_SQL($strSQL);
	if (mysql_num_rows($resultat) == 0) {
		$select_retour .= '';
	}
	else {
		
		while ($table_result = mysql_fetch_array($resultat)) {
			$select_retour .= '<option value="'.$table_result['typdoc_id'].'">'.$table_result['typdoc_title'].'</option>';	
		}
	
	}
	$select_retour .= '</select>';
	return $select_retour;
		
}

//Dossier
function show_folder($id) {
	$strSQL = 'SELECT * FROM `efolder` WHERE CONVERT( `folder_id` USING utf8 ) = '.$id.' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	$table_result = mysql_fetch_array($resultat);
	return $table_result;
}

function insert_folder($nom,$descript,$statut) {
	$strSQL = 'INSERT INTO `efolder` ( `folder_name`, `folder_descript`, `folder_status` ) ';
	$strSQL .= 'VALUES ("'.$nom.'", "'.$descript.'", "'.$statut.'") ';
	$resultat = requete_SQL($strSQL);
	return $resultat;	
}

function update_folder($id,$nom,$descript,$statut) {
	$strSQL = 'UPDATE `efolder` SET `folder_name` = "'.$nom.'", `folder_descript` = "'.$descript.'", `folder_status` = "'.$statut.'" WHERE CONVERT( `folder_id` USING utf8 ) = '.$id.' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	return $resultat;
}

function delete_folder($id) {
	$strSQL = 'DELETE FROM `efolder` WHERE CONVERT( `folder_id` USING utf8 ) = '.$id.' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	return $resultat;
}

function desable_folder($id) {
	$show_folder = show_folder($id);
	if ($show_folder['folder_status'] == 1) $set_statut = 0; else $set_statut = 1;
	$strSQL = 'UPDATE `efolder` SET `folder_status` = '.$set_statut.' WHERE CONVERT( `folder_id` USING utf8 ) = '.$id.' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL); 
	return $resultat;
}

function numberof_folder($keyword) {
	$strSQL = 'SELECT * FROM `efolder` WHERE `comp_nom` LIKE "%'.$keyword.'%" ;';
	$resultat = requete_SQL($strSQL);
	$retour = mysql_num_rows($resultat);
	return $retour ;
}

function list_folder($keyword) {
	$strSQL = 'SELECT * FROM `efolder` WHERE `folder_name` LIKE "%'.$keyword.'%" ORDER BY `folder_name` ;';
	$resultat = requete_SQL($strSQL);
	if (mysql_num_rows($resultat) == 0) {
		$retour = '<span class="warning">Aucun enregistrement !</span>';
	}
	else {
		$rg = 0;
		$retour = '';
		while ($table_result = mysql_fetch_array($resultat)) {
			$rg ++;
			
			if ($table_result['folder_status'] == 1) {
				$important = 'important_2'; 
			}
			else {
				$important = 'txt_4'; 
			}
			
			$retour .= '
			<table width="98%" height="30" class="sab" border="0" cellpadding="0" cellspacing="0" class="line_2">
				<tr>
				  <td width="4%" align="center">'.$rg.'</td>
				  <td width="28%" align="left" class="'.$important.'">'.$table_result['folder_name'].'</td>
				  <td width="56%" align="left">'.$table_result['folder_descript'].'</td>
				  <td width="12%" align="center">
					<a href="gestion_dossier.php?show=add&folder_edit='.$table_result['folder_id'].'"><img src="../image/icon/color_line.png" alt="Edit" width="22" height="22" border="0" align="absmiddle" /></a>&nbsp; 
					<a href="gestion_dossier.php?show=lis&folder_del='.$table_result['folder_id'].'" onclick="return(confirm(\'Voulez-vous supprimer ce Dossier : '.$table_result['folder_name'].' ?\'));"><img src="../image/icon/cancel.png" alt="supprimer" width="22" height="22" border="0" align="absmiddle" /></a>&nbsp;
				  </td>
				</tr>
			</table>';
				
		}
	}
	return $retour;
}

function select_folder($name,$id='',$sub=0, $class='line_4') {
	if ($sub==1) $onchange = 'onchange="javascript:submit();"'; else $onchange = '';
	if (!empty($id)) { $folder = show_folder($id); $design = $folder['folder_name']; } else $design = 'Tous les Dossiers';
	$select_retour = '<select name="'.$name.'" class="'.$class.'" id="'.$name.'" '.$onchange.' >';
	$select_retour .= '<option value="'.$id.'" selected="selected">'.$design.'</option>';
	if ($sub==1 && !empty($id)) $select_retour .= '<option value="">Tous les Folder</option>';
	$strSQL = 'SELECT `folder_id`, `folder_name` FROM `efolder` WHERE `folder_status` = 1 AND `folder_id` <> "'.$id.'" ORDER BY `folder_name`';
	$resultat = requete_SQL($strSQL);
	if (mysql_num_rows($resultat) == 0) {
		$select_retour .= '';
	}
	else {
		
		while ($table_result = mysql_fetch_array($resultat)) {
			$select_retour .= '<option value="'.$table_result['folder_id'].'">'.$table_result['folder_name'].'</option>';	
		}
	
	}
	$select_retour .= '</select>';
	return $select_retour;
		
}

//document
function insert_document($id,$title,$detail=NULL,$keyword=NULL,$owner=NULL,$preparedby=NULL,$reviewedby=NULL,$approvedby=NULL,$creat_date=NULL,$sign_date=NULL,$nbr_page=NULL,$status=1,$typdoc=NULL) {
	$strSQL = 'INSERT INTO `edocument` (`doc_id`, `doc_title`, `doc_detail`, `doc_keyword`, `doc_owner`, `doc_prepared_by`, `doc_reviewed_by`, `doc_approved_by`, `doc_creat_date`, `doc_sign_date`, `doc_nbr_page`, `doc_status`, `typdoc_id`) VALUES (\''.$id.'\', \''.$title.'\', \''.$detail.'\', \''.$keyword.'\', \''.$owner.'\', \''.$preparedby.'\', \''.$reviewedby.'\', \''.$approvedby.'\', \''.$creat_date.'\', \''.$sign_date.'\', \''.$nbr_page.'\', \''.$status.'\', \''.$typdoc.'\');';
	$resultat = requete_SQL($strSQL);
	return $resultat;	
} 

function show_document($id) {
	$strSQL = 'SELECT `doc_id`, `doc_title`, `doc_detail`, `doc_owner`, `doc_prepared_by`, `doc_reviewed_by`, `doc_approved_by`, `doc_creat_date`, `doc_sign_date`, `doc_nbr_page`, `doc_status`, `typdoc_title`, D.`typdoc_id` FROM `edocument` D, `etypdoc` T WHERE (D.`typdoc_id` = T.`typdoc_id`) AND CONVERT( `doc_id` USING utf8 ) = "'.$id.'" LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	$table_result = mysql_fetch_array($resultat);
	return $table_result;
}

function update_document($id,$title,$detail,$keyword,$owner,$preparedby,$reviewedby,$approvedby,$creat_date,$sign_date,$nbr_page,$status,$typdoc) {
	$strSQL = 'UPDATE `edocument` SET `doc_title` = \''.$title.'\', `doc_detail` = \''.$detail.'\', `doc_keyword` = \''.$keyword.'\', `doc_owner` = \''.$owner.'\', `doc_prepared_by` = \''.$preparedby.'\', `doc_reviewed_by` = \''.$reviewedby.'\', `doc_approved_by` = \''.$approvedby.'\', `doc_creat_date` = \''.$creat_date.'\', `doc_sign_date` = \''.$sign_date.'\', `doc_nbr_page` = \''.$nbr_page.'\', `doc_status` = \''.$status.'\', `typdoc_id` = \''.$typdoc.'\' WHERE CONVERT( `doc_id` USING utf8 ) = \''.$id.'\' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	return $resultat;
}

function delete_document($id) {
	$strSQL = 'DELETE FROM `edocument` WHERE CONVERT( `doc_id` USING utf8 ) = "'.$id.'" LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	return $resultat;
}

function desable_document($id) {
	$show_document = show_document($id);
	if ($show_document['doc_status'] == 1) $set_statut = 0; else $set_statut = 1;
	$strSQL = 'UPDATE `edocument` SET `doc_status` = '.$set_statut.' WHERE CONVERT( `doc_id` USING utf8 ) = "'.$id.'" LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);	
	return $resultat;
}

function numberof_document($keyword,$document='') {
	if (!empty($document)) $doc_condition = 'AND E.`typdoc_id` = '.$document.' '; else $doc_condition = '';
	$strSQL = 'SELECT `doc_id`, `doc_title`, `doc_detail`, `doc_creat_date`, `doc_sign_date`, `doc_status`, `typdoc_title` FROM `edoc` D, `etypdoc` T WHERE (`doc_title` LIKE "%'.$keyword.'%" OR `doc_detail` LIKE "%'.$keyword.'%") AND (D.`typdoc_id` = T.`typdoc_id`) '.$doc_condition.' ORDER BY `doc_creat_date` ;';
	$resultat = requete_SQL($strSQL);
	$retour = mysql_num_rows($resultat);
	return $retour;
}

function list_document($keyword,$typdoc='',$edit=0,$del=0) {
	if (!empty($typdoc)) $doc_condition = 'AND D.`typdoc_id` = '.$typdoc.' '; else $doc_condition = '';
	$strSQL = 'SELECT D.`doc_id`, `doc_title`, `doc_detail`, `doc_creat_date`, `doc_sign_date`, `doc_status`, `typdoc_title` FROM `edocument` D, `etypdoc` T WHERE (`doc_title` LIKE "%'.$keyword.'%" OR `doc_detail` LIKE "%'.$keyword.'%") AND (D.`typdoc_id` = T.`typdoc_id`) '.$doc_condition.' ORDER BY `doc_creat_date` DESC ;';
	$resultat = requete_SQL($strSQL);
	if (mysql_num_rows($resultat) == 0) {
		$retour = '<span class="warning">Aucun enregistrement !</span>';
	}
	else {
		$rg = 0;
		$retour = '';
		while ($table_result = mysql_fetch_array($resultat)) {
			$rg ++;
			
			if ($table_result['doc_status'] == 1) {
				$important = 'important_2'; 
			}
			else {
				$important = 'txt_4';
			}
			
			$retour .= '
			<table width="98%" height="40"class="sab" border="0" cellpadding="0" cellspacing="0" class="line_2">
				<tr ondblclick="window.open(\'./document_information.php?doc_info='.$table_result['doc_id'].'\',\'Info\',\'width=800,height=380,scrollbars=0\').focus();">
				  <td width="4%" align="center">'.$rg.'</td>
				  <td width="44%" align="left" class="'.$important.'">'.$table_result['doc_title'].' <br /><span class="txt_4">'.$table_result['doc_detail'].'</span></td>
				  <td width="16%" align="left">'.date_fr_2($table_result['doc_creat_date']).'</td>
				  <td width="24%" align="left">'.$table_result['typdoc_title'].'</td>
				  <td width="10%" align="center">';
				  	
					if ($edit==1)
					$retour .= '
				  	<a href="./?page_id=document&show=add&doc_edit='.$table_result['doc_id'].'"><img src="../image/icon/color_line.png" alt="Edit" width="22" height="22" align="absmiddle" border="0" /></a>
					&nbsp;';
					
					if ($del==1)
					$retour .= '
					<a href="./?page_id=document&show=list&doc_del='.$table_result['doc_id'].'"><img src="../image/icon/cancel.png" alt="supprimer" width="22" height="22" align="absmiddle" border="0" /></a>
					&nbsp;';
					
					$retour .= '
					<a href=" ./document_information.php?doc_info='.$table_result['doc_id'].'&KeepThis=true&TB_iframe=true&height=400&width=890" class="thickbox" onkdfkdclick"window.open(\'./document_information.php?doc_info='.$table_result['doc_id'].'\',\'Info\',\'width=800,height=380,scrollbars=0\').focus();">
					<img src="../image/icon/info.png" alt="Detail" width="22" height="22" align="absmiddle" border="0" />
					</a>';
					
				  $retour .= '
				  </td>
				</tr>
		    </table>';
				
		}
	}
	return $retour;
}

function nbr_document_folder($id) {
	$strSQL = 'SELECT `folder_id` FROM `adocumentfolder` WHERE CONVERT( `doc_id` USING utf8 ) = \''.$id.'\' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	$nbr = mysql_num_rows($resultat);
	return $nbr;
} 

function insert_document_folder($id_doc,$id_folder,$precision=NULL,$file_attached=NULL) {
	$strSQL = 'INSERT INTO `adocumentfolder` (`doc_id`, `folder_id`, `precision`, `file_attached`) VALUES (\''.$id_doc.'\', \''.$id_folder.'\', \''.$precision.'\', \''.$file_attached.'\');';
	$resultat = requete_SQL($strSQL);
	return $resultat;	
} 

function update_document_folder($hid_doc,$hid_folder,$id_doc,$id_folder,$precision=NULL,$file_attached=NULL) {
	if (!empty($file_attached)) $edit_file = ', `file_attached` = \''.$file_attached.'\''; else $edit_file = '';
	$strSQL = 'UPDATE `adocumentfolder` SET `doc_id` = \''.$id_doc.'\', `folder_id` = \''.$id_folder.'\', `precision` = \''.$precision.'\' '.$edit_file.' WHERE CONVERT( `doc_id` USING utf8 ) = \''.$hid_doc.'\' AND CONVERT( `folder_id` USING utf8 ) = \''.$hid_folder.'\' LIMIT 1 ;';
	$resultat = requete_SQL($strSQL);
	return $resultat;
} 

function show_document_folder($id) {
	$strSQL = 'SELECT D.`doc_id`, D.`folder_id`, `folder_name`, `precision`, `file_attached` FROM `adocumentfolder` D, `efolder` F WHERE (D.`folder_id` = F.`folder_id`) AND CONVERT( D.`doc_id` USING utf8 ) = "'.$id.'"  ORDER BY `precision` ;';
	$resultat = requete_SQL($strSQL);
	$retour = '';
	while ($table_result = mysql_fetch_array($resultat)) {
		
		$retour .= '
		<table width="100%"  class="sab" height="30" border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td width="20%" align="left" class="txt_4">Nom du Dossier </td>
				<td width="30%" align="left" class="important_2"><span class="txt_4">|</span>'.$table_result['folder_name'].'</td>
				<td width="20%" align="left" class="txt_4">Fichier Attaché</td>
				<td width="30%" align="left" class="important_2"><span class="txt_4">|</span>';
				
				if (!empty($table_result['file_attached']))
					$retour .= '
					<a href="#" onclick="window.open(\'../fichiers/document/'.$table_result['file_attached'].'\',\'List\',\'width=580,height=680,scrollbars=1\').focus();"><img src="../image/icon/kget_list.png" alt="Show the file" width="22" height="22" align="absmiddle" border="0"/></a> ('.$table_result['precision'].')'; 
				$retour .= '
				</td>
			  </tr>
		  </table>';
		  
		/* <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="20%" align="left" class="txt_1g">'.$table_result['folder_name'].'</td>
				<td width="80%" align="left" class="txt_1">'; 
				
				if (!empty($table_result['file_attached']))
					$retour .= '
					<a href=" ../fichiers/document/'.$table_result['file_attached'].'&KeepThis=true&TB_iframe=true&height=400&width=890" class="thickbox" onkdfkdclick" window.open(\'../file/document/'.$table_result['file_attached'].'\',\'List\',\'width=580,height=680,scrollbars=1\').focus();"><img src="../image/icon/kget_list.png" alt="Show the file" width="22" height="22" align="absmiddle" border="0"/></a> ('.$table_result['precision'].')'; 
				
				$retour .= '
				</td>
			</tr>
		</table> */
	
	}
	return $retour;
}

function show_document_folder_edit($id) {
	$strSQL = 'SELECT D.`doc_id`, D.`folder_id`, `folder_name`, `precision`, `file_attached` FROM `adocumentfolder` D, `efolder` F WHERE (D.`folder_id` = F.`folder_id`) AND CONVERT( D.`doc_id` USING utf8 ) = "'.$id.'" ORDER BY `precision` ;';
	$resultat = requete_SQL($strSQL);
	$retour = '
	<table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
		<tr>
		  <td></td>
		</tr>
	</table>';
	$rg = 0;
	while ($table_result = mysql_fetch_array($resultat)) {
		$rg++;
		$retour .= '
		<table width="100%" class="sab" border="0" cellpadding="0" cellspacing="0" class="line_2">
			<tr>
			  <td height="31" align="left" class="txt_1">Folder  </td>
			  <td align="left">
			  	<label>'.select_folder($name='select_folder'.$rg,$table_result['folder_id'],$sub=0, 'line_4').'</label>
				<input name="htxt_folder'.$rg.'" type="hidden" id="htxt_folder'.$rg.'" size="45" value="'.$table_result['folder_id'].'"/>                              </td>
			</tr>
			<tr>
			  <td height="31" align="left" class="txt_1">Detail</td>
			  <td align="left">
			  	<label>
			  	<input name="htxt_precision'.$rg.'" type="hidden" id="htxt_precision'.$rg.'" size="45" value="'.$table_result['precision'].'"/>
				</label>
				<input name="txt_precision'.$rg.'" type="text" id="txt_precision'.$rg.'" size="45" value="'.$table_result['precision'].'"/>
			  </td>
			</tr>
			<tr>
			  <td width="14%" height="30" align="left" class="txt_1">Fichier Attach&eacute; </td>
			  <td width="86%" align="left"><label>';
			  	
				if (!empty($table_result['file_attached']))
					$retour .= '<a href=" ../fichiers/document/'.$table_result['file_attached'].'&KeepThis=true&TB_iframe=true&height=400&width=890" class="thickbox" onkdfkdclick" window.open(\'../fichiers/document/'.$table_result['file_attached'].'\',\'List\',\'width=580,height=680,scrollbars=1\').focus();"><img src="../image/icon/kget_list.png" alt="Afficher le fichier" width="22" height="22" align="absmiddle" border="0"/></a> -- Update &gt;&gt;';
				
				$retour .= '	
				<input name="fichier'.$rg.'" type="file" class="line_4" id="fichier'.$rg.'" size="50"/>
			  </label>
			  </td>
			</tr>
		  </table>';
		
	}
	$retour .= '
	<input name="txt_nbr_folder" type="hidden" id="txt_nbr_folder" size="10" value="'.$rg.'"/>';
	
	return $retour;
}

function list_folder_docs($keyword) {
	$strSQL = 'SELECT * FROM `efolder` WHERE `folder_name` LIKE "%'.$keyword.'%" ORDER BY `folder_name` ;';
	$resultat = requete_SQL($strSQL);
	if (mysql_num_rows($resultat) == 0) {
		$retour = '<span class="warning">Aucun enregistrement !</span>';
	}
	else {
		$rg = 0;
		$retour = '';
		while ($table_result = mysql_fetch_array($resultat)) {
			$rg ++;
			
			if ($table_result['folder_status'] == 1) {
				$important = 'important_2'; 
			}
			else {
				$important = 'txt_4'; 
			}
			
			$retour .= '
			<table width="98%" class="sab" height="30" border="0" cellpadding="0" cellspacing="0" class="line_2">
				<tr ondblclick="window.open(\'./folder_documents.php?folder_id='.$table_result['folder_id'].'\',\'Info\',\'width=920,height=710,scrollbars=1\').focus();">
				  <td width="4%" align="center">'.$rg.'</td>
				  <td width="28%" align="left" class="'.$important.'">'.$table_result['folder_name'].'</td>
				  <td width="56%" align="left">'.$table_result['folder_descript'].'</td>
				  <td width="12%" align="center">';
				  
				  $retour .= '
					<a href=" ./folder_documents.php?folder_id='.$table_result['folder_id'].'&KeepThis=true&TB_iframe=true&height=400&width=890" class="thickbox" onkdfkdclick"window.open(\'./folder_documents.php?folder_id='.$table_result['folder_id'].'\',\'Info\',\'width=920,height=710,scrollbars=1\').focus();">
					<img src="../image/icon/folder_open.png" alt="Open folder" width="22" height="22" align="absmiddle" border="0" />
					</a>';
					
				  $retour .= '
				  </td>
				</tr>
			</table>';
				
		}
	}
	return $retour;
}

function list_documents_of_folder($keyword,$folder='',$edit=0,$del=0) {
	if (!empty($folder)) $folder_condition = 'AND (D.`doc_id` = F.`doc_id`) AND F.`folder_id` = '.$folder.' '; else $folder_condition = '';
	$strSQL = 'SELECT D.`doc_id`, `doc_title`, `doc_detail`, `doc_creat_date`, `doc_sign_date`, `doc_status`, `typdoc_title` FROM `edocument` D, `etypdoc` T, `adocumentfolder` F WHERE (`doc_title` LIKE "%'.$keyword.'%" OR `doc_detail` LIKE "%'.$keyword.'%") AND (D.`typdoc_id` = T.`typdoc_id`) '.$folder_condition.' ORDER BY `doc_creat_date` DESC ;';
	$resultat = requete_SQL($strSQL);
	if (mysql_num_rows($resultat) == 0) {
		$retour = '<span class="warning">Aucun enregistrement !</span>';
	}
	else {
		$rg = 0;
		$retour = '';
		while ($table_result = mysql_fetch_array($resultat)) {
			$rg ++;
			
			if ($table_result['doc_status'] == 1) {
				$important = 'important_2'; 
			}
			else {
				$important = 'txt_4';
			}
			
			$retour .= '
			<table width="98%" class="sab" height="40" border="0" cellpadding="0" cellspacing="0" class="line_2">
				<tr ondblclick="window.open(\'./folder_documents_details.php?doc_info='.$table_result['doc_id'].'&folder_id='.$folder.'\',\'Info\',\'width=800,height=580,scrollbars=1\').focus();">
				  <td width="4%" align="center">'.$rg.'</td>
				  <td width="44%" align="left" class="'.$important.'">'.$table_result['doc_title'].' <br /><span class="txt_4">'.$table_result['doc_detail'].'</span></td>
				  <td width="16%" align="left">'.date_fr_2($table_result['doc_creat_date']).'</td>
				  <td width="24%" align="left">'.$table_result['typdoc_title'].'</td>
				  <td width="10%" align="center">';
				  	
					if ($edit==1)
					$retour .= '
				  	<a href="./?page_id=document&show=add&doc_edit='.$table_result['doc_id'].'"><img src="../image/icon/color_line.png" alt="Edit" width="22" height="22" align="absmiddle" border="0" /></a>
					&nbsp;';
					
					if ($del==1)
					$retour .= '
					<a href="./?page_id=document&show=list&doc_del='.$table_result['doc_id'].'"><img src="../image/icon/cancel.png" alt="supprimer" width="22" height="22" align="absmiddle" border="0" /></a>
					&nbsp;';
					
					$retour .= '
					<a href="folder_documents_details.php?doc_info='.$table_result['doc_id'].'&folder_id='.$folder.'">
					<img src="../image/icon/info.png" alt="Detail" width="22" height="22" align="absmiddle" border="0" />
					</a>';
					
				  $retour .= '
				  </td>
				</tr>
		    </table>';
				
		}
	}
	return $retour;
}


?>
