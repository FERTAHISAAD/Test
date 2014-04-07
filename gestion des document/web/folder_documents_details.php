<?php 
include_once '../lib/lib_mysql.php';
?>
<?php
connexion();
$page = $_SERVER["PHP_SELF"];
if (isset($_GET['doc_info'])) {
	$doc_info = $_GET['doc_info'];
	$show_document = show_document($doc_info);
	$folder_id = $_GET['folder_id'];
	$show_folder = show_folder($folder_id);
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
            <td width="50%" align="left" class="big_1"><img src="../image/design/img_ppm_logo_mini.png" width="230" height="50" /></td>
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
          <td width="69%" align="left" class="txt_4g">Documents - Folder Opened : <?php echo $show_folder['folder_name']; ?></td>
          <td width="31%" align="right" class="txt_4g"><span class="txt_4"><<&nbsp;<span class="txt_1g"><a href="folder_documents.php?folder_id=<?php echo $folder_id; ?>">Return to the Folder Opened </a></span></span></td>
        </tr>
      </table>
      <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
        <tr>
          <td></td>
        </tr>
      </table>
      <table width="98%" height="30" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left" class="big_3">Document opened : <span class="big_2"><?php echo $show_document['doc_title']; ?></span></td>
        </tr>
      </table>
      <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
        <tr>
          <td></td>
        </tr>
      </table>
      <table width="98%" height="30" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left" class="txt_4g">Deatail : <span class="title_2"><?php echo '<span class="txt_4g">'.$show_document['doc_detail'].'</span>'; ?></span> </td>
        </tr>
      </table>
      <table width="98%" height="468" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="82%" align="left" valign="top"><table width="100%" height="80" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left" valign="top"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                  <tr>
                    <td align="left">&nbsp;</td>
                  </tr>
                </table>
                <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="20%" align="left" class="title_1"><span class="txt_1g"><span class="txt_4g">Type Document </span></span></td>
                      <td width="80%" align="left" class="txt_1g"><span class="txt_4g"><span class="txt_4">|</span></span> <?php echo $show_document['typdoc_title'] ?> </td>
                    </tr>
                  </table>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
        <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                <td width="20%" height="30" align="left" class="txt_4">Proprietaire</td>
                                <td width="30%" align="left" class="important_2"><span class="txt_4">|</span> <?php echo $show_document['doc_owner'] ?></td>
                                <td width="20%" align="left" class="important_2"><span class="txt_4"> Date de creation </span></td>
                                <td width="30%" align="left" class="important_2"><span class="txt_4">|</span> <?php echo date_fr_2($show_document['doc_creat_date']) ?></td>
                              </tr>
                              <tr>
                                <td height="30" align="left" class="txt_4">Prepared By </td>
                                <td align="left" class="important_2"><span class="txt_4">|</span> <?php echo $show_document['doc_prepared_by'] ?></td>
                                <td align="left" class="important_2"><span class="txt_4">Sign. Date </span></td>
                                <td align="left" class="important_2"><span class="txt_4">|</span> <?php echo date_fr_2($show_document['doc_sign_date']) ?></td>
                              </tr>
                              <tr>
                                <td height="30" align="left" class="txt_4">Reviewed By </td>
                                <td align="left" class="important_2"><span class="txt_4">|</span> <?php echo $show_document['doc_reviewed_by'] ?></td>
                                <td align="left" class="important_2"><span class="txt_4">Number of Page </span></td>
                                <td align="left" class="important_2"><span class="txt_4">|</span> <?php echo $show_document['doc_nbr_page'] ?></td>
                              </tr>
                              <tr>
                                <td height="30" align="left" class="txt_4">&nbsp;</td>
                                <td align="left" class="important_2">&nbsp;</td>
                                <td align="left" class="important_2">&nbsp;</td>
                                <td align="left" class="important_2">&nbsp;</td>
                              </tr>
                            </table>
                          <table width="100%" height="6" border="0" cellspacing="0" cellpadding="0" background="../image/design/fond_inter.png">
                            <tr>
                              <td></td>
                            </tr>
                          </table>
                          <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                <td width="20%" align="left" class="txt_4">Nom du Dossier </td>
                                <td width="80%" align="left" class="txt_4">Fichier Attach&eacute;  </td>
                              </tr>
                          </table>
                          <?php echo show_document_folder($doc_info) ?> </td>
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
                <td align="center" class="token_1">Awa Clid -  Doc Manager </td>
              </tr>
          </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<?php deconnexion(); ?>
