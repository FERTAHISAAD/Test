<?php 
include_once '../lib/lib_mysql.php';
?>
<?php
connexion();
$page = $_SERVER["PHP_SELF"];
if (isset($_GET['user_info'])) {
	$user_info = $_GET['user_info'];
	$show_user = show_user($user_info);
}
?>


<link href="../style/default.css" rel="stylesheet" type="text/css" />
<table width="100%" height="578" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="578" align="center" valign="top"><table width="100%" height="50" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center">
		<table width="98%" height="50" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="50%" align="left" class="big_1"><img src="../image/design/img_ppm_logo_mini.png" width="500" height="80" /></td>
            <td width="50%" align="right">&nbsp;</td>
          </tr>
        </table>
		</td>
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
          <td align="left" class="big_2"><img src="../image/icon/identity_New1.png" width="22" height="22" /> <?php echo $show_user['util_id'].' <span class="txt_4g"> - '.$show_user['emp_prenom'].' '.$show_user['emp_nom']; ?> ,<span class="txt_4"><?php echo $show_user['emp_titre'] ?></span></span> </td>
        </tr>
      </table>
      <table width="98%" height="468" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="82%" align="left" valign="top"><table width="100%" height="80" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left" valign="top"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="20%" align="left" class="title_1"> Informations d'utilisateur </td>
                      <td width="80%" align="left" class="title_1"><span class="txt_4"></span></td>
                    </tr>
                  </table>
                  
                                   <table class="sab" width="100%" align="center"  cellspacing="1" >
<tr class="hhhhhh" >
    <td>D&eacute;signation</td> 
    <td>E-mail</td>
    <td>GSM</td>
    <td>Groupe</td>
    <td>Autorisation Groupe</td>
    <td>Copie CIN</td>

</tr>
<tr align="center" style="background-color:#e2f2fc;" height="40">
    <td><?php echo $show_user['emp_designation']; ?></td> 
    <td><?php echo $show_user['emp_email']; ?></td>
    <td><?php echo $show_user['emp_tel']; ?></td>
    <td><?php echo $show_user['dom_nom']; ?></td>
    <td><?php echo $show_user['dom_autorisation']; ?></td>
    <td><?php if (!empty($show_user['emp_attach_pass'])) echo '<a href="#" onclick=" window.open(\'../fichiers/copie_cin/'.$show_user['emp_attach_pass'].'\',\'List\',\'width=580,height=680\').focus();"><img src="../image/icon/kget_list.png" alt="Show the file" width="22" height="22" align="absmiddle" border="0"/></a>'; ?></td>
    
    
                            
 </tr>  
 
 </table> 
           
                  <!--  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="center" valign="top"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                            <tr>
                              <td align="left">&nbsp;</td>
                            </tr>
                          </table>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                <td width="20%" height="30" align="left" class="txt_4">D&eacute;signation</td>
                                <td width="30%" align="left" class="important_2"><span class="txt_4">|</span></td>
                                <td width="20%" align="left" class="important_2"><span class="txt_4">Email</span></td>
                                <td width="30%" align="left" class="important_2"><span class="txt_4">|</span></td>
                              </tr>
                              <tr>
                                <td height="30" align="left" class="txt_4">Company</td>
                                <td align="left" class="important_2"><span class="txt_4">|</span></td>
                                <td align="left" class="important_2"><span class="txt_4">Mobile Phone </span></td>
                                <td align="left" class="important_2"><span class="txt_4">|</span></td>
                              </tr>
                              <tr>
                                <td height="30" align="left" class="txt_4">Nationality</td>
                                <td align="left" class="important_2"><span class="txt_4">|</span></td>
                                <td align="left" class="important_2"><span class="txt_4">Passport Number </span></td>
                                <td align="left" class="important_2"><span class="txt_4">|</span></td>
                              </tr>
                            </table>
                          <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                <td width="20%" align="left" class="txt_4">Passport Copy </td>
                                <td width="80%" align="left" class="txt_2"><span class="important_2"><span class="txt_4">|</span></span></td>
                              </tr>
                          </table>
                          -->
                          </td>
                      </tr>
                  </table></td>
              </tr>
            </table>
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
                <td align="left" class="detail_1">Awa Clid -  Doc Manager </td>
              </tr>
          </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<?php deconnexion(); ?>
