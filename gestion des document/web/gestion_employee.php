<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Document sans titre</title>
<link href="../style/default.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top"><table width="98%" height="680" border="0" cellpadding="0" cellspacing="25">
      <tr>
        <td width="18%" align="center" valign="top"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left"><span class="title_1"><span class="big_3"><h2>Gestion des Ressources </h2></span></span></td>
          </tr>
        </table>
        <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
            <tr>
              <td></td>
            </tr>
          </table>
          <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="30" align="left" class="txt_444">Liens utile</td>
            </tr>
          </table>
          <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="17%" height="30" align="left" class="subtitle_3"><span class="txt_1g"><img src="../image/design/puce_1.png" alt="Liste des ressources..." width="18" height="18" /></span></td>
              <td width="83%" align="left" class="subtitle_3"><a href="./?page_id=employee&amp;show=list">Liste des ressources </a> </td>
            </tr>
          </table>
          <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="17%" height="30" align="left" class="subtitle_3"><span class="txt_1g"><img src="../image/design/puce_1.png" alt="ajouter nouveau..." width="18" height="18" /></span></td>
              <td width="83%" align="left" class="subtitle_3"> <a href="./?page_id=employee&amp;show=add">Nouveau ressource</a> </td>
            </tr>
          </table>
          <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="30" align="left" class="txt_2">&nbsp;</td>
            </tr>
          </table>
          <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="30" align="left" class="txt_444">Autre lien</td>
            </tr>
          </table>
        <!--  <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="17%" height="30" align="left" class="subtitle_3"><span class="txt_1g"><img src="../image/design/puce_1.png" alt="Add new..." width="18" height="18" /></span></td>
              <td width="83%" align="left" class="subtitle_3"><a href="#" onclick="window.open('./company_management.php','List','width=800,height=580,scrollbars=1').focus();">Company</a> </td>
            </tr>
          </table>-->
          <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="17%" height="30" align="left" class="subtitle_3"><span class="txt_1g"><img src="../image/design/puce_1.png" alt="Nationalit&eacute;..." width="18" height="18" /></span></td>
              <td width="83%" align="left" class="subtitle_3"><a href="gestion_nationnalite.php?KeepThis=true&TB_iframe=true&height=400&width=890" class="thickbox"  onnjclick="window.open('./gestion_nationnalite.php','List','width=800,height=580,scrollbars=1').focus();">Nationalit&eacute;</a> </td>
            </tr>
          </table>
          <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="30" align="left" class="txt_2">&nbsp;</td>
            </tr>
          </table>
          <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="30" align="left" class="txt_4">&nbsp;</td>
            </tr>
          </table>
          </td>
        <td width="82%" align="left" valign="top"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
          <tr height="40">
            <td align="left" class="title_1"><span  class="important_2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./?page_id=employee&amp;show=list"> Liste des Employ&eacute;s</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./?page_id=employee&amp;show=add"> Ajouter un nouveau Employ&eacute;</a></span></td>
          </tr>
        </table>
          <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
            <tr>
              <td></td>
            </tr>
          </table>
          <?php if ($show=='add') { ?>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="top"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="88%" align="left" class="big_3">Ajouter un nouveau Employ&eacute;</td>
                    <td width="12%" align="right" class="txt_1g">&nbsp;</td>
                  </tr>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <form id="form_add" name="form_add" method="post" action="" enctype="multipart/form-data">
                      <tr>
                        <td align="left" valign="top"><table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
                          <tr>
                            <td></td>
                          </tr>
                        </table>
                        <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                            <tr>
                              <td width="14%" align="left"><input name="htxt_id" type="hidden" id="htxt_id" value="<?php if (isset($show_employee)) echo $show_employee['emp_id']; ?>" /></td>
                              <td width="86%" align="left"><?php echo $message; ?></td>
                            </tr>
                          </table>
                            <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
                              <tr>
                                <td></td>
                              </tr>
                            </table>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                              <tr>
                                <td height="30" align="left" class="txt_1">Titre</td>
                                <td align="left">
								<label>
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
                                <td align="left"><label><?php if (isset($show_employee)) $id = $show_employee['nat_id']; else $id=''; echo select_nationality($name='select_nationality',$id,$sub=0); ?></label></td>
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
                            <!--  <tr>
                                <td height="30" align="left" class="txt_1">Company</td>
                                <td align="left"><label><?php if (isset($show_employee)) $id = $show_employee['comp_id']; else $id=''; echo select_company($name='select_company',$id,$sub=0, 'line_3'); ?></label></td>
                              </tr> -->
                              <tr style="display:none">
                                <td height="30" align="left" class="txt_1">Department</td>
                                <td align="left"><label>
                                
                                  <select name="select_group" id="select_group">
								  	<?php if (isset($show_employee)) echo '<option value="'.$show_employee['emp_groupe'].'" selected="selected">'.$show_employee['emp_groupe'].'</option>'; ?>
                                    <option value="Commercial" <?php if (!isset($show_employee)) echo 'selected="selected"'; ?>>Commercial</option>
                                    <option value="Finance">Finance</option>
                                    <option value="HRA">HRA</option>
                                    <option value="Ingineering">Ingineering</option>
                                    <option value="IT" <?php if (!isset($show_employee)) echo 'selected="selected"'; ?>>IT</option>
                                </select> 
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
                              <td height="30" align="left" class="txt_1">N&deg; CIN </td>
                              <td align="left"><label>
                                <input name="txt_num_pass" type="text" class="line_4" id="txt_num_pass" size="35" value="<?php if (isset($show_employee)) echo $show_employee['emp_num_pass']; ?>"/>
                              </label></td>
                            </tr>
                            <tr>
                              <td width="14%" height="30" align="left" class="txt_1"> Copie de CIN </td>
                              <td width="86%" align="left"><?php if (isset($show_employee) && !empty($show_employee['emp_attach_pass'])) echo '<a href="../fichiers/copie_cin/'.$show_employee['emp_attach_pass'].'?KeepThis=true&TB_iframe=true&height=400&width=890" class="thickbox" onvhclick=" window.open(\'../fichiers/copie_cin/'.$show_employee['emp_attach_pass'].'\',\'List\',\'width=580,height=680,scrollbars=1\').focus();"><img src="../image/icon/kget_list.png" alt="Afficher le fichier" width="22" height="22" align="absmiddle" border="0"/></a> -- Update &gt;&gt; '; ?>
                                <input name="fichier" type="file" class="line_4" id="fichier" size="50"/>
                                <input name="htxt_file" type="hidden" id="htxt_file" value="<?php if (isset($show_employee)) echo $show_employee['emp_attach_pass']; ?>"/></td>
                            </tr>
                          </table>
						  <?php if (isset($message_up)) { ?>
                          <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="line_1">
                            <tr>
                              <td width="14%">&nbsp;</td>
                              <td width="86%" align="left" class="important_3"><?php echo $message_up; ?></td>
                            </tr>
                          </table>
						  <?php } ?>
                          <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                              <tr>
                                <td width="14%" align="left">&nbsp;</td>
                                <td width="86%" align="left" class="token_1">Verifiez que tous les champs sont bien remplis avant d'envoyer </td>
                              </tr>
                          </table>
                          <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                              <tr>
                                <td width="14%" align="left">&nbsp;</td>
                                <td width="86%" align="left"><label>
                                  <input name="sub_employee" type="submit" class="sssabir" id="sub_employee" value="Envoyer" />
                                </label></td>
                              </tr>
                          </table></td>
                      </tr>
                    </form>
                </table></td>
            </tr>
            </table>
            <?php } else { ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                  <tr height="63">
                    <td width="50%" align="left" class="big_3">Liste des Ressources</td>
                    <td width="50%" align="right" class="txt_1g">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <form id="form_search_emp" name="form_search_emp" method="get" action="">
                        <tr>
                          <td height="28" align="right"><span class="txt_2">Chercher :<span class="txt_1"> par Nom </span>
                                <label>
                                <input class="chercheee"name="txt_search_emp" type="text" id="txt_search_emp" value="<?php if (!empty($keyword)) echo $keyword; ?>" onclick="this.value=''"/>
                                <input name="sub_search_emp" type="submit" id="sub_search_emp" class="sssabir" value="Search" />
                                </label>
                          </span> </td>
                        </tr>
                      </form>
                    </table>
                    </td>
                  </tr>
                </table>
               
                <table width="100%" height="5" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
                    <tr>
                      <td></td>
                    </tr>
                  </table>
                  <table width="98%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_444">
                    <tr>
                      <td width="6%" align="center">N&deg;</td>
                      <td width="45%" align="left">Nom complet </td>
                      <td width="34%" align="left">
                        
					<!--	<table width="100%" height="28" border="0" cellpadding="0" cellspacing="0">
                          <form id="form2" name="form2" method="post" action="">
						  <tr>
                            <td align="left"><?php echo select_company($name='sortby_company',$sortby,$sub=1, 'line_4'); ?></td>
                          </tr>
						  </form>
                        </table>-->
                                            
                      </td>
                      <td width="15%" align="center">Options</td>
                    </tr>
                  </table>
                  <table width="100%" height="10" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
                    <tr>
                      <td></td>
                    </tr>
                  </table>
                <div id="zone_list"><?php echo list_employee($keyword,$authorization[3],$authorization[4]); ?></div> </td>
              </tr>
            </table>
          <?php } ?></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
