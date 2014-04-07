<?php 

if(isset($_POST['CNE']) && !empty($_POST['CNE'])){
$CNE=$_POST['CNE'];
mysql_pconnect("localhost","root","")or die (mysql_error());
mysql_select_db("reinscr")or die (mysql_error());

$acad=mysql_query("SELECT * FROM academie where CNE_etud_acad='".$CNE."'")or die (mysql_error());
$num=mysql_num_rows($acad);
$requete=mysql_fetch_assoc($acad);



if($num!=0)
{

$nom=$requete['Nom_etud_acad'];
$prenom=$requete['prenom_etud_acad'];
$CNE_etud=$requete['CNE_etud_acad'];
$Filiere=$requete['filiere_bac_acad'];
$Province=$requete['province'];
$Date_nais=$requete['date_nais_etud'];



}


}


if(isset($_POST['INSERER']) ){

$nom=$_Post['Nom_etud_acad'];
$prenom=$_Post['prenom_etud_acad'];
$CNE_etud=$_Post['CNE_etud_acad'];
$Filiere=$_Post['filiere_bac_acad'];
$Province=$_Post['province'];
$Date_nais=$_Post['date_nais_etud'];
$lieu=$_Post['lieu'];
$CIN=$_Post['CIN'];
$CIN=$_Post['CIN'];
$CIN=$_Post['CIN'];
$CIN=$_Post['CIN'];
$CIN=$_Post['CIN'];
$CIN=$_Post['CIN'];
$CIN=$_Post['CIN'];
$CIN=$_Post['CIN'];




?>



<style>
table.tablform{ 
font: bold 14px ubuntu;
color:#696969;
background-color:white;
margin-left: 30px;
}
span.bismillah{
background-position: 8px 8px; /* LTR */
background-image: url(../../misc/message-24-ok.png);
background-repeat: no-repeat;
border: 0px solid;
margin: 6px 0;
padding: 10px 10px 10px 50px; /* LTR */
color:green;

}
span.bismillahe{
background-position: 8px 8px; /* LTR */
background-image: url(../../misc/message-24-error.png);
background-repeat: no-repeat;
border: 0px solid;
margin: 6px 0;
padding: 10px 10px 10px 50px; /* LTR */
color:red;

}
input.sssabir {
cursor:pointer;
background-color: #D14836;
background-image: -webkit-linear-gradient(top,#DD4B39,#D14836);
background-image: -moz-linear-gradient(top,#DD4B39,#D14836);
background-image: -ms-linear-gradient(top,#DD4B39,#D14836);
background-image: -o-linear-gradient(top,#DD4B39,#D14836);
background-image: linear-gradient(top,#DD4B39,#D14836);
border: 1px solid transparent;
text-shadow: 0 1px rgba(0, 0, 0, 0.1);
text-transform: uppercase;
-webkit-border-radius: 2px;
-moz-border-radius: 2px;
border-radius: 2px;
  padding: 4px 20px ;
  color: #fff ;
  font: bold 1em "Trebuchet MS",Arial,sans-serif ;
  line-height: 1em ;
  text-align: center ;
  text-decoration: none ;
}
input.sssabir:hover, input.sssabir:focus, input.sssabir:active {
  background: #900 ;
  text-decoration: underline ;
}
</style>
<script type="text/javascript" >


function id_hh(CNE)
{
  var sabiro;
  if (window.XMLHttpRequest) sabiro = new XMLHttpRequest();
  else if (window.ActiveXObject) sabiro = new ActiveXObject('Microsoft.XMLHTTP');
  sabiro.open('POST',"/sabir/id.php",true);
  sabiro.onreadystatechange = function()
  {
      if (sabiro.readyState == 4 && sabiro.status==200)
      {
          if (document.getElementById)
          {   
              if (sabiro.responseText =='OK') { /* OK */
                    document.getElementById('CNE1').innerHTML='<span  class="bismillah" >  '+sabiro.responseText+' </span>';
              }else{                             /* PAS OK */
                    document.getElementById('CNE1').innerHTML='<span  class="bismillahe" >  '+sabiro.responseText+' </span>';
              }
          }     
      }
  }
  sabiro.setRequestHeader('Content-type','application/x-www-form-urlencoded');
  sabiro.send('CNE='+CNE);                 
} 

</script>

  
<form method="post" action="">


<fieldset width="200">
<legend align="center"> Inscription </legend>
    <table class="tablform" border="0" width="200"cellspacing="0">
    <tr align="center" style="background-color:#fff;">
      <td colspan=2 id="msg"></td>
      
    </tr>
      <tr align="center" style="background-color:#fff;">
        <td width="90">Vous êtes  :</td>
        <td>

          <select name="etre" id="etre"  onChange="javascript:submit();" >
          <option value="M"> Marocain </option>
          <option value="E"> Étrangère </option>
          <option selected="selected"> ------------------ </option>
          </select>
      </td>
      </tr> 
   </table></fieldset>  
   
  </form>  
 
     
      <?php if (isset($_POST['etre']) && ($_POST['etre']=='M') && !isset($_POST['CNE'])){?>
    <!--  <form method="post" action="">-->
  <form name="forme"method="post"  action="">
      <fieldset width="200">
      <legend align="center"> CNE </legend>
      
      
      <tr align="center" style="background-color:#fff;">
        <td width="90">CNE :</td>
        <td>
          <input name="CNE" id="CNE" type="text" onBlur="id_hh(forme.CNE.value);" > <span id="CNE1" ></span></td>
      </tr>
      
      
      <tr align="center" style="background-color:#fff;">
        <td colspan="2" ><input class="sssabir" type="button" onClick="id_hh(forme.CNE.value);return false" value="Verifier"  /></td>
      </tr>
       <tr align="center" style="background-color:#fff;">
        <td colspan="2" ><input class="sssabir" type="submit"  value="Envoyer"  /></td>
      </tr>
      
     
     
    </table></fieldset>
    
     </form> 
     
 <!--    <tr align="center" style="background-color:#fff;">
        <td colspan="2" ><input class="sssabir" type="submit" value="envoyer"  /></td>
      </tr>
      </form>  -->
  <?php }?>
  <!-- *************************************** FORM2 ***********************---> 
  
  <?php if ((isset($_POST['etre']) && $_POST['etre']=='E') ||  isset($_POST['CNE'])   ){?> 
 <form name="forme2"method="post" action=""  enctype="multipart/form-data">

<fieldset width="200">
<legend align="center"> Informations personnelle </legend>
    <table class="tablform" border="0" width="200"cellspacing="0">
   
      
       
   
    <tr align="center" style="background-color:#fff;">
    <td width="90">Nom : </td><td><input <?php if(isset($_POST['CNE'])) echo 'value="'.$nom.'" readonly="readonly"';?> name="nom" type="text" >  </td>
    </tr>
    
   <tr align="center" style="background-color:#fff;">
   <td> Prenom : </td><td><input  <?php if(isset($_POST['CNE'])) echo 'value="'.$prenom.'" readonly="readonly"';?>name="prenom"  type="text" > </td> 
   </tr>
   
   <tr align="center" style="background-color:#fff;">
   <td> CNE : </td><td><input  <?php if(isset($_POST['CNE'])) echo 'value="'.$CNE_etud.'" readonly="readonly"';?> name="cne" type="text" > </td> 
   </tr>
 
   <tr align="center" style="background-color:#fff;">
   <td> Date de naissence : </td><td><input <?php if(isset($_POST['CNE'])) echo 'value="'.$Date_nais.'" readonly="readonly"';?>name="date_nais" type="text" > </td> 
   </tr>
  
 <?php if (isset($_POST['etre']) && $_POST['etre']=='M'){?>
    
    <tr align="center" style="background-color:#fff;">
   <td> Province : </td><td><input <?php if(isset($_POST['CNE'])) echo 'value="'.$Province.'" readonly="readonly"';?> name="province" type="text" > </td> 
   </tr>
       <?php }?> 
  
     <!--<tr id="CNE1"></tr>-->
    <tr align="center" style="background-color:#fff;">
        <td width="90">CIN :</td>
        <td> <input name="CIN" id="CIN" type="text" onBlur="id_hh(forme.CIN1.value);" ></td>
      </tr>
      
      <tr align="center" style="background-color:#fff;">
        <td width="90">Lieu de naissance :</td>
        <td> <input name="lieu" id="lieu" type="text" onBlur="id_hh(forme.lieu.value);" ><span id="lieu1"></span></td>
      </tr>  
      
      
     <tr align="center" style="background-color:#fff;">
        <td width="90">Adresse actuelle :</td>
        <td> <input name="adr1" id="adr1" type="text" onBlur="id_hh(forme.adr1.value);" ><span id="adr1"></span></td>
      </tr>
      
      <tr align="center" style="background-color:#fff;">
        <td width="90">Ville :</td>
        <td> <input name="ville" id="ville" type="text" onBlur="id_hh(forme.ville.value);" ><span id="ville1"></span></td>
      </tr>
            <tr align="center" style="background-color:#fff;">
        <td width="90">Pays :</td>
        <td> <input name="paye" id="paye" type="text" onBlur="id_hh(forme.paye.value);" ><span id="paye1"></span></td>
      </tr>
      
      <tr align="center" style="background-color:#fff;">
        <td width="90">Nationalité :</td>
        <td> <input name="nat" id="adr1" type="nat" onBlur="id_hh(forme.nat.value);" ><span id="nat1"></span></td>
      </tr>
      
 
      
      <tr align="center" style="background-color:#fff;">
        <td width="90">Sexe :</td>
        <td>  <input name="sexe" id="sexe" type="radio" value="M" onBlur="id_hh(forme.sexe.value);" > Masculin  <input name="sexe" id="sexe" type="radio" value="F" onBlur="id_hh(forme.sexe.value);" > Feminin <span id="sexe1"></span></td>
      </tr>
      
      <tr align="center" style="background-color:#fff;">
        <td width="90">Telephone :</td>
        <td> <input name="tel" id="tel" type="tel" onBlur="id_hh(forme.tel.value);" ><span id="tel1"></span></td>
      </tr>
      
      
      <tr align="center" style="background-color:#fff;">
        <td width="90">GSM :</td>
        <td> <input name="GSM" id="GSM" type="text" onBlur="id_hh(forme.GSM.value);" ><span id="GSM1"></span></td>
      </tr>
      
      <tr align="center" style="background-color:#fff;">
        <td width="90">E-mail :</td>
        <td> <input name="email" id="email" type="text" onBlur="id_hh(forme.email.value);" ><span id="email1"></span></td>
      </tr>
      
     <tr align="center" style="background-color:#fff;">
        <td width="90">Mot de passe :</td>
        <td> <input name="pass" id="pass" value="" type="password" onBlur="id_hh(forme.pass.value);" ><span id="pass1"></span></td>
      </tr>
      
       <tr align="center" style="background-color:#fff;">
        <td width="90">Photo :</td>
        <td> <input name="photo" id="photo" value="" type="file" onBlur="id_hh(forme.photo.value);" ><span id="photo1"></span></td>
      </tr>
      
      
    </table></fieldset>
    
    
    
    <!--**************************** Informations Bac  ***************-->
<fieldset width="200">
<legend align="center"> Informations Bac </legend>
    <table class="tablform" border="0" width="200"cellspacing="0">
    
      
    <tr align="center" style="background-color:#fff;">
   <td> Filiere : </td><td><input <?php if(isset($_POST['CNE'])) echo 'value="'.$Filiere.'" readonly="readonly"';?> name="filiere"  type="text" > </td> 
   </tr>
   
 <?php if (isset($_POST['etre']) && $_POST['etre']='E'){?>
    <tr align="center" style="background-color:#fff;">
    <td width="90">Pays : </td><td><input  name="pays_bac" type="text" >  </td>
    </tr>
    

   
   <tr align="center" style="background-color:#fff;">
   <td> N&deg; d'Autorisation : </td><td><input name="numauto" type="text" > </td> 
   </tr>
 
   <tr align="center" style="background-color:#fff;">
   <td> Date de délivrance : </td><td><input name="date_deliv" type="text" > </td> 
   </tr>
   
  

    
    <?php } else {?>
    
    <tr align="center" style="background-color:#fff;">
        <td width="90">Année d'Obtention  :</td>
        
        <select name="annob" id="annob"  onChange="fonction_etre(forme.annob.value);" >
        <?php for($i=1980;$i<2012;$i++){ ?>
          <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
         <?php }?>
          </select>
      </tr>
      
      <tr align="center" style="background-color:#fff;">
        <td width="90">Lycee :</td>
        <td> <input name="Lycee" id="Lycee" value="" type="text" onBlur="id_hh(forme.Lycee.value);" ><span id="Lycee1"></span></td>
      </tr>
      
     <tr align="center" style="background-color:#fff;">
        <select name="montion" id="montion"  onChange="fonction_etre(forme.montion.value);" >
          <option value="P"> Passable </option>
          <option value="A"> Assez Bien </option>
          <option value="B"> Bien </option>
          <option value="T"> Trés Bien </option>
          </select>
      </tr>
     
      <?php } ?>
      
      
    
    </table></fieldset>
    
   <!--**************************** Informations Parents  ***************-->
<fieldset width="200">
<legend align="center"> Informations Parents </legend>
    <table class="tablform" border="0" width="200"cellspacing="0">
    
     <tr align="center" style="background-color:#fff;">
    <td width="90">Nom et Prénom du Père : </td><td><input  name="pere" type="text" >  </td>
    </tr>
    
   <tr align="center" style="background-color:#fff;">
   <td> Nom et Prénom de la Mère  : </td><td><input name="mere"  type="text" > </td> 
   </tr>
   
   <tr align="center" style="background-color:#fff;">
   <td> Nom et Prénom du tuteur : </td><td><input name="numauto" type="text" > </td> 
   </tr>
 
   <tr align="center" style="background-color:#fff;">
   <td> CIN du tuteur : </td><td><input name="CIN_tut" type="text" > </td> 
   </tr>
   
   <tr align="center" style="background-color:#fff;">
   <td> Adresse des parents : </td><td><input name="adr2" type="text" > </td> 
   </tr>
   
   <tr align="center" style="background-color:#fff;">
   <td> Province ou Préfecture : </td><td><input name="prov_pre" type="text" > </td> 
   </tr>
   
   <tr align="center" style="background-color:#fff;">
   <td> Telephone Parents : </td><td><input name="tel_parent" type="text" > </td> 
   </tr>
   
   
   <tr align="center" style="background-color:#fff;">
   <td> Profession Pere : </td><td><input name="prof_pere" type="text" > </td> 
   </tr>
   
   
   <tr align="center" style="background-color:#fff;">
   <td> Profession Mere : </td><td><input name="prof_mere" type="text" > </td> 
   </tr>
    
   
     
      
      
      
    
    </table>
</fieldset>

   <!--**************************** Informations Departement  ***************-->
<fieldset width="200">
<legend align="center"> Choix de Filiere </legend>
    <table class="tablform" border="0" width="200"cellspacing="0">
    
    
       <tr align="center" style="background-color:#fff;">
        <select name="filiere2" id="filiere2">
        
  <?php       $acadf=mysql_query("SELECT * FROM filieres ")or die (mysql_error());

$requetef=mysql_fetch_assoc($acadf);
do{
        ?>
          <option value="<?php echo $requetef['id_filiere']; ?>"> <?php echo $requetef['lib_filiere']; ?></option>
          
 <?php }while($requetef=mysql_fetch_assoc($acadf))?>
          </select>
     
      
      
      
    
    </table>
</fieldset>

       <input class="sssabir" type="hidden" value="<?php if (isset($_POST['etre']) echo $_POST['etre'];){?>"  />
      <input class="sssabir" type="hidden" value="INSERER"  />
      
     <div> <input class="sssabir" type="submit" value="envoyer"  /></div>
     
   <?php }?>
</form>

