<?php 
include_once '../lib/lib_mysql.php';
?>
<?php
connexion();
$page = $_SERVER["PHP_SELF"];
if (isset($_GET['doc_info'])) {
	$doc_info = $_GET['doc_info'];
	$show_document = show_document($doc_info);
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
            <td width="50%" align="left" class="big_1"><img src="../image/design/img_ppm_logo_mini.png" width="500" height="60" /></td>
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
          <td align="left" class="big_2"><img src="../image/icon/folder_open.png" width="22" height="22" /> <?php echo $show_document['doc_title'].' <br /> <span class="txt_4g">'.$show_document['doc_detail'].'</span>'; ?> </td>
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
               
                  
                  
                  
                    
                    
                    
                    <!-- ********************************************------->
                                                <table class="sab" width="100%" align="center"  cellspacing="1" >
<tr class="hhhhhh" >
    <td>Type du Document</td>
    <td>Propri&eacute;taire</td> 
    <td>Date de creation</td>
    <td>Prepar&eacute; par</td>
    <td>Date de signature</td>
    <td>Approuvé par</td>
    <td>Nombre de pages</td>
    

</tr>
<tr align="center" style="background-color:#e2f2fc;" height="40">
    <td><?php echo $show_document['typdoc_title']; ?></td> 
    <td><?php echo $show_document['doc_owner']; ?></td> 
    <td><?php echo $show_document['doc_creat_date']; ?></td>
    <td><?php echo $show_document['doc_prepared_by']; ?></td>
    <td><?php echo $show_document['doc_sign_date']; ?></td>
    <td><?php echo $show_document['doc_reviewed_by']; ?></td>
    <td><?php echo $show_document['doc_nbr_page']; ?></td>
                             
 </tr>  
 
 </table>
 <p>&nbsp;</p> 
 <table width="100%" border="0" cellpadding="0" cellspacing="0">  
   <tr >   <!-- ********************************************-----              
                    
                   
        <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                <td width="20%" height="30" align="left" class="txt_4">Owner</td>
                                <td width="30%" align="left" class="important_2"><span class="txt_4">|</span> <?php echo $show_document['doc_owner'] ?></td>
                                <td width="20%" align="left" class="important_2"><span class="txt_4">Creat. Date </span></td>
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
                          </table>--> 
                          <b><?php echo show_document_folder($doc_info) ?></b> </td>
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
                <td align="left" class="token_1">Awa Clid -  Doc Manager </td>
              </tr>
          </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<?php deconnexion(); ?>
