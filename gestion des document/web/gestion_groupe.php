<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Document sans titre</title>
<link href="../style/default.css" rel="stylesheet" type="text/css" />
<script language="Javascript" type="text/javascript" src="../script/visible.js"></script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
    
    <table width="98%" height="680" border="0" cellpadding="0" cellspacing="25">
      <tr>
        <td width="18%" align="center" valign="top"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left"><span class="title_1"><span class="big_3">Admin</span></span></td>
          </tr>
        </table>
        <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
            <tr>
              <td></td>
            </tr>
          </table>
          <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="30" align="left" class="txt_444">Liens utiles</td>
            </tr>
          </table>
          <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="17%" height="30" align="center" class="subtitle_3"><span class="txt_1g"><img src="../image/design/puce_1.png" alt="Ajouter..." width="18" height="18" /></span></td>
              <td width="83%" align="left" class="subtitle_3"><a href="./?page_id=group&amp;show=list">Liste des Groupes </a> </td>
            </tr>
          </table>
          <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="17%" height="30" align="center" class="subtitle_3"><span class="txt_1g"><img src="../image/design/puce_1.png" alt="Ajouter..." width="18" height="18" /></span></td>
              <td width="83%" align="left" class="subtitle_3"><a href="./?page_id=group&amp;show=add">Ajouter un Groupe </a> </td>
            </tr>
          </table>
          <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="30" align="left" class="txt_2">&nbsp;</td>
            </tr>
          </table>
          <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="30" align="left" class="txt_444">Autres liens </td>
            </tr>
          </table>
          <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="17%" height="30" align="center" class="subtitle_3"><span class="txt_1g"><img src="../image/design/puce_1.png" alt="Ajouter..." width="18" height="18" /></span></td>
              <td width="83%" align="left" class="subtitle_3"><a href="./?page_id=user&amp;show=list">Liste des Utilisateurs </a> </td>
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
          <tr>
            <td align="left" class="title_1"><span  class="important_2"><span class="txt_4">Administration  | </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./?page_id=group&amp;show=list"> Liste des Groupes</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./?page_id=group&amp;show=add"> Ajouter un groupe</a>&nbsp;</span></td>
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
                    <td width="50%" align="left" class="big_3">Ajouter un Groupe </td>
                    <td width="50%" align="right" class="txt_1g">&nbsp;</td>
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
                              <td width="14%" align="left"><input name="htxt_id" type="hidden" id="htxt_id" value="<?php if (isset($show_domaine)) echo $show_domaine['dom_id']; ?>" /></td>
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
                                <td width="14%" height="30" align="left" class="txt_1">Nom du Groupe </td>
                                <td width="86%" align="left"><label>
                                  <input name="txt_name" type="text" class="line_3" id="txt_name" size="35"  value="<?php if (isset($show_domaine)) echo $show_domaine['dom_nom']; ?>"/>
                                </label></td>
                              </tr>
                              <tr>
                                <td height="30" align="left" class="txt_1">Description  </td>
                                <td align="left"><label>
                                  <input name="txt_description" type="text" class="line_3" id="txt_description" value="<?php if (isset($show_domaine)) echo $show_domaine['dom_description']; ?>" size="45"/>
                                </label></td>
                              </tr>
                              <tr>
                                <td height="30" align="left" class="txt_1">Statut</td>
                                <td align="left" class="txt_1"><label>
                                  <input name="check_status" type="checkbox" id="check_status" value="1" <?php if (isset($show_domaine) && $show_domaine['dom_statut']==1) echo 'checked="checked"'; ?> />
                                  Activer
                                </label></td>
                              </tr>
                              
                              <tr>
                                <td height="30" align="left" class="txt_1">Les Permissions </td>
                                <td align="left"><label></label></td>
                              </tr>
                            </table>
                            <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                              <tr>
                                <td width="14%" align="left">&nbsp;</td>
                                <td width="86%" align="left" class="token_1">
								  <table width="300" height="28" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td width="22" align="center">
									  <div id="img_employee" style="background:url(../image/icon/treeview_p.png)" onClick="javascript:change_icone('a_employee','img_employee');visibilite('a_employee');" >
                                       <table width="22" height="22" border="0" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                        </table>
                                      </div>
									  </td>
                                      <td width="278" align="left" class="subtitle_3">&nbsp;Employ&eacute;</td>
                                    </tr>
                                  </table>
								  <div id="a_employee" style="display:none">
                                  <table width="300" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td width="7%" align="left" class="txt_1">&nbsp;</td>
                                      <td width="93%" height="28" align="left" class="txt_1"><label>
                                        <input name="c1" type="checkbox" id="c1" value="1" <?php if ((isset($show_domaine)) && ($show_domaine['dom_autorisation'][1]==1)) echo 'checked="checked"'; ?>/>
                                      Consulter </label></td>
                                    </tr>
                                    <tr>
                                      <td align="left" class="txt_1">&nbsp;</td>
                                      <td height="28" align="left" class="txt_1"><label>
                                      <input name="c2" type="checkbox" id="c2" value="1" <?php if ((isset($show_domaine)) && ($show_domaine['dom_autorisation'][2]==1)) echo 'checked="checked"'; ?>/> 
                                      Ajouter </label></td>
                                    </tr>
                                    <tr>
                                      <td align="left" class="txt_1">&nbsp;</td>
                                      <td height="28" align="left" class="txt_1"><label>
                                      <input name="c3" type="checkbox" id="c3" value="1" <?php if ((isset($show_domaine)) && ($show_domaine['dom_autorisation'][3]==1)) echo 'checked="checked"'; ?>/> 
                                      Modifier </label></td>
                                    </tr>
                                    <tr>
                                      <td align="left" class="txt_1">&nbsp;</td>
                                      <td height="28" align="left" class="txt_1"><label>
                                      <input name="c4" type="checkbox" id="c4" value="1" <?php if ((isset($show_domaine)) && ($show_domaine['dom_autorisation'][4]==1)) echo 'checked="checked"'; ?>/> 
                                      Supprimer </label></td>
                                    </tr>
                                  </table>
								  </div>
                                  <div id="a_arrdep" style="display:none">
                                  <table width="300" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td width="7%" align="left" class="txt_1">&nbsp;</td>
                                      <td width="93%" height="28" align="left" class="txt_1"><label>
                                        <input name="c9" type="checkbox" id="c9" value="1" <?php if ((isset($show_domaine)) && ($show_domaine['dom_autorisation'][9]==1)) echo 'checked="checked"'; ?>/>
                                      Consulter </label></td>
                                    </tr>
                                    <tr>
                                      <td align="left" class="txt_1">&nbsp;</td>
                                      <td height="28" align="left" class="txt_1"><label>
                                      <input name="c10" type="checkbox" id="c10" value="1" <?php if ((isset($show_domaine)) && ($show_domaine['dom_autorisation'][10]==1)) echo 'checked="checked"'; ?>/> 
                                      Ajouter </label></td>
                                    </tr>
                                    <tr>
                                      <td align="left" class="txt_1">&nbsp;</td>
                                      <td height="28" align="left" class="txt_1"><label>
                                      <input name="c11" type="checkbox" id="c11" value="1" <?php if ((isset($show_domaine)) && ($show_domaine['dom_autorisation'][11]==1)) echo 'checked="checked"'; ?>/> 
                                      Modifier </label></td>
                                    </tr>
                                    <tr>
                                      <td align="left" class="txt_1">&nbsp;</td>
                                      <td height="28" align="left" class="txt_1"><label>
                                      <input name="c12" type="checkbox" id="c12" value="1" <?php if ((isset($show_domaine)) && ($show_domaine['dom_autorisation'][12]==1)) echo 'checked="checked"'; ?>/> 
                                      Supprimer </label></td>
                                    </tr>
                                  </table>
								  </div>
                                  <table width="300" height="28" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td width="22" align="center">
                                      <div id="img_documents" style="background:url(../image/icon/treeview_p.png)" onclick="javascript:change_icone('a_documents','img_documents');visibilite('a_documents');" >
                                          <table width="22" height="22" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <td>&nbsp;</td>
                                            </tr>
                                          </table>
                                      </div></td>
                                      <td width="278" align="left" class="subtitle_3">&nbsp;Documents</td>
                                    </tr>
                                  </table>
                                  <div id="a_documents" style="display:none">
                                  <table width="300" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td width="7%" align="left" class="txt_1">&nbsp;</td>
                                      <td width="93%" height="28" align="left" class="txt_1"><label>
                                        <input name="c13" type="checkbox" id="c13" value="1" <?php if ((isset($show_domaine)) && ($show_domaine['dom_autorisation'][13]==1)) echo 'checked="checked"'; ?>/>
                                      Consulter </label></td>
                                    </tr>
                                    <tr>
                                      <td align="left" class="txt_1">&nbsp;</td>
                                      <td height="28" align="left" class="txt_1"><label>
                                      <input name="c14" type="checkbox" id="c14" value="1" <?php if ((isset($show_domaine)) && ($show_domaine['dom_autorisation'][14]==1)) echo 'checked="checked"'; ?>/> 
                                      Ajouter </label></td>
                                    </tr>
                                    <tr>
                                      <td align="left" class="txt_1">&nbsp;</td>
                                      <td height="28" align="left" class="txt_1"><label>
                                      <input name="c15" type="checkbox" id="c15" value="1" <?php if ((isset($show_domaine)) && ($show_domaine['dom_autorisation'][15]==1)) echo 'checked="checked"'; ?>/> 
                                      Modifier </label></td>
                                    </tr>
                                    <tr>
                                      <td align="left" class="txt_1">&nbsp;</td>
                                      <td height="28" align="left" class="txt_1"><label>
                                      <input name="c16" type="checkbox" id="c16" value="1" <?php if ((isset($show_domaine)) && ($show_domaine['dom_autorisation'][16]==1)) echo 'checked="checked"'; ?>/> 
                                      Supprimer </label></td>
                                    </tr>
                                  </table>
								  </div>
                                  <table width="300" height="28" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td width="22" align="center"><div id="img_setting" style="background:url(../image/icon/treeview_p.png)" onclick="javascript:change_icone('a_setting','img_setting');visibilite('a_setting');" >
                                          <table width="22" height="22" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <td>&nbsp;</td>
                                            </tr>
                                          </table>
                                      </div></td>
                                      <td width="278" align="left" class="subtitle_3">&nbsp;Param&egrave;tres</td>
                                    </tr>
                                  </table>
                                  <div id="a_setting" style="display:none">
                                    <table width="335" border="0" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td width="21">&nbsp;</td>
                                        <td width="314" align="left"><table width="300" height="28" border="0" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <td width="22" align="center"><div id="img_setting_user" style="background:url(../image/icon/treeview_p.png)" onclick="javascript:change_icone('a_setting_user','img_setting_user');visibilite('a_setting_user');" >
                                                <table width="22" height="22" border="0" cellpadding="0" cellspacing="0">
                                                  <tr>
                                                    <td>&nbsp;</td>
                                                  </tr>
                                                </table>
                                            </div></td>
                                            <td width="278" align="left" class="subtitle_3">&nbsp;Utilisateurs</td>
                                          </tr>
                                        </table>
										  <div id="a_setting_user" style="display:none">
                                          <table width="300" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <td width="7%" align="left" class="txt_1">&nbsp;</td>
                                              <td width="93%" height="28" align="left" class="txt_1"><label>
                                                <input name="c17" type="checkbox" id="c17" value="1" <?php if ((isset($show_domaine)) && ($show_domaine['dom_autorisation'][17]==1)) echo 'checked="checked"'; ?>/>
                                                Consulter </label></td>
                                            </tr>
                                            <tr>
                                              <td align="left" class="txt_1">&nbsp;</td>
                                              <td height="28" align="left" class="txt_1"><label>
                                                <input name="c18" type="checkbox" id="c18" value="1" <?php if ((isset($show_domaine)) && ($show_domaine['dom_autorisation'][18]==1)) echo 'checked="checked"'; ?>/>
                                                Ajouter </label></td>
                                            </tr>
                                            <tr>
                                              <td align="left" class="txt_1">&nbsp;</td>
                                              <td height="28" align="left" class="txt_1"><label>
                                                <input name="c19" type="checkbox" id="c19" value="1" <?php if ((isset($show_domaine)) && ($show_domaine['dom_autorisation'][19]==1)) echo 'checked="checked"'; ?>/>
                                                Modifier </label></td>
                                            </tr>
                                            <tr>
                                              <td align="left" class="txt_1">&nbsp;</td>
                                              <td height="28" align="left" class="txt_1"><label>
                                                <input name="c20" type="checkbox" id="c20" value="1" <?php if ((isset($show_domaine)) && ($show_domaine['dom_autorisation'][20]==1)) echo 'checked="checked"'; ?>/>
                                                Supprimer </label></td>
                                            </tr>
                                          </table>
										  </div>
                                          <table width="300" height="28" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <td width="22" align="center"><div id="img_setting_dom" style="background:url(../image/icon/treeview_p.png)" onclick="javascript:change_icone('a_setting_dom','img_setting_dom');visibilite('a_setting_dom');" >
                                                  <table width="22" height="22" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                  </table>
                                              </div></td>
                                              <td width="278" align="left" class="subtitle_3">&nbsp;Groupes utilisateurs </td>
                                            </tr>
                                          </table>
										  <div id="a_setting_dom" style="display:none">
                                          <table width="300" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <td width="7%" align="left" class="txt_1">&nbsp;</td>
                                              <td width="93%" height="28" align="left" class="txt_1"><label>
                                                <input name="c21" type="checkbox" id="c21" value="1" <?php if ((isset($show_domaine)) && ($show_domaine['dom_autorisation'][21]==1)) echo 'checked="checked"'; ?>/>
                                                Consulter </label></td>
                                            </tr>
                                            <tr>
                                              <td align="left" class="txt_1">&nbsp;</td>
                                              <td height="28" align="left" class="txt_1"><label>
                                                <input name="c22" type="checkbox" id="c22" value="1" <?php if ((isset($show_domaine)) && ($show_domaine['dom_autorisation'][22]==1)) echo 'checked="checked"'; ?>/>
                                                Ajouter </label></td>
                                            </tr>
                                            <tr>
                                              <td align="left" class="txt_1">&nbsp;</td>
                                              <td height="28" align="left" class="txt_1"><label>
                                                <input name="c23" type="checkbox" id="c23" value="1" <?php if ((isset($show_domaine)) && ($show_domaine['dom_autorisation'][23]==1)) echo 'checked="checked"'; ?>/>
                                                Modifier </label></td>
                                            </tr>
                                            <tr>
                                              <td align="left" class="txt_1">&nbsp;</td>
                                              <td height="28" align="left" class="txt_1"><label>
                                                <input name="c24" type="checkbox" id="c24" value="1" <?php if ((isset($show_domaine)) && ($show_domaine['dom_autorisation'][24]==1)) echo 'checked="checked"'; ?>/>
                                                Supprimer </label></td>
                                            </tr>
                                          </table>
										  </div>
									    </td>
                                      </tr>
                                    </table>
                                  </div>
							    </td>
                              </tr>
                          </table>
                            <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                              <tr>
                                <td width="14%" align="left">&nbsp;</td>
                               <!-- <td width="86%" align="left" class="token_1">Be sure that all important fields are filled before to submit </td>-->
                              </tr>
                            </table>
                            <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_4">
                              <tr>
                                <td width="14%" align="left">&nbsp;</td>
                                <td width="86%" align="left"><label>
                                  <input name="sub_group" type="submit" class="sssabir" id="sub_group" value="Envoyer" />
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
                <td align="center" valign="top"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="50%" align="left" class="big_3">Liste des Groupes </td>
                    <td width="50%" align="right" class="txt_1g"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="important_2">
                      <form id="form1" name="form1" method="post" action="">
                        <tr>
                          <td align="right" class="txt_2">Chercher :<span class="txt_1"> Par  Nom </span>
                              <label>
                              <input name="txt_search" type="text" id="txt_search" value="<?php if (!empty($keyword)) echo $keyword; ?>" onclick="this.value=''"/>
                              <input name="sub_search" type="submit" class="sssabir"id="sub_search" value="Chercher" />
                              </label>                          </td>
                        </tr>
                      </form>
                    </table></td>
                  </tr>
                </table>
                <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
                    <tr>
                      <td></td>
                    </tr>
                  </table>
                  <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" class="txt_444">
                    <tr >
                      <td width="4%" align="center">N&deg;</td>
                      <td width="22%" align="left">Nom du Groupe   </td>
                      <td align="left">Description </td>
                      <td width="11%" align="center">OPTIONS</td>
                    </tr>
                  </table>
                  <?php echo list_group($keyword,$authorization[23],$authorization[24]); ?> </td>
              </tr>
            </table>
          <?php } ?></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
