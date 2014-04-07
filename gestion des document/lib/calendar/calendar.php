<?php

/**
 ------------------------------------------------------------------------------
 * SAISIE DE DATE
 * 8 août 2004
 * Affiche un calendrier, avec dimanche ou lundi comme 1er jour, et permet de
 * reporter la date sélectionnée dans un champ INPUT d'un formulaire.
 *
 * Exemple d'utilisation :
 * Soit un fichier (php, html ou autre). Imaginons qu'il y a un champs "date"
 * qui doit contenir une date formattée selon certains critères. Il faut tout
 * d'abord avoir un formulaire qui a un nom :
 *
 * <from name="test" method="post" action="monFichierDeTraitement.php">
 *
 * Ensuite, il faut un champ qui accueillera le jour choisi via ce fichier.
 * Prenons par exemple un simple champ texte :
 *
 * <input type="texte" name="date" readonly="readonly"/>
 *
 * Finalement, il faut un lien qui ouvre le calendrier. Pour ce faire, on peut
 * utiliser l'événement onClick du Javascript :
 *

 ?>
 <a href="#" onClick="window.open('calendrier.php?frm=test&ch=date', 'calendrier', 'width=415,height=170,scrollbars=0').focus();">
    <img src="images/calendrier.gif" />
  </a>
 <?php 
  *
 *
 * On utilise la fonction window.open(). Le 1er paramètre est le nom de la page
 * ainsi que son emplacement par rapport au calendrier (ici, les 2 sont
 * au même endroit). Il y a 2 variables à passer, "frm" et "ch". "frm" est égal
 * au nom du formulaire, "ch" est égal au nom du champ qui accueillera le jour
 * choisi.
 * Le 2e paramètre est le nom de la fenêtre (optionnel), le reste, ben c'est du
 * connu. Largeur, hauteur, scrollbars. Et un petit focus() pour être sûr que
 * le calendrier se mettra en avant-plan lors de son ouverture.
 *
 * NOTE : Le onClick peut se mettre ailleurs. Et c pas obligé d'avoir une image
 *        Pour un peu plus de sûreté, on peut mettre un readonly dans le champ.
 *        Ainsi, seul la date pourra s'inscrire dedans.
 ------------------------------------------------------------------------------
 */

/**
 * $anneeMin : Permet la selection d'années antérieures à celle actuelle (2 = 2 ans antérieur)
 * $anneeMax : Permet la sélection d'années postérieures à celle actuelle (3 = 3 ans postérieur)
 */
$anneeMin = 10;
$anneeMax = 3;

/**
 * Formattage de la date (par exemple : JJ-MM-AAAA ou JJ|MM|AAAA)
 * $checkzero : ajoute un zéro devant le mois ou le jour s'ils sont inférieur à 10
 *              "false" ou "true"
 * $format    : représente la string qui sépare le mois du jour de l'année
 * $ordre     : détermine l'ordre, de gauche à droite, du jour, mois et année
 *              "a" pour année, "m" pour mois, "j" pour jour
 * $affichage : Pour présenter le calendrier au format anglais ou français
 *              "fr" = commencer par lundi ou "en" = commencer par dimanche
 */
$checkzero = "true";
$format = "-";
$ordre = array("j", "m", "a");
$affichage = "fr";

/**
 * Affichage du calendrier en popup ou non
 * $popup     : Détermine si le calendrier s'affichera sous forme de popup ou non
 *              TRUE = sous forme de popup ou FALSE = directement intégré à la page
 * $formHtml  : Le nom de la FORM où il y a le champ concerné
 * $champ     : Le nom du champ où la date doit être inscrite
 * $page      : Le nom de la page où est inclu le calendrier
 * $larCal    : La largeur du calendrier
 * $marCal    : Les éventuelles marges à donner au calendrier pour bien le placer dans la page
 */
$popup = false;
$formHtml = "";
$champ = "";
$page = "";

/**
 * Mise en page du calendrier
 */
$larCal = "200px";
$marCal = "10px 0 0 0px";

/**
 * Ci-dessous, le nom des mois et des jours. A changer si on veut d'autres langues (ou utiliser
 * la fonction gettext() de PHP. Ne pas changer les positions dans le tableau
 */
$nomj[0] = "Di";
$nomj[1] = "Lu";
$nomj[2] = "Ma";
$nomj[3] = "Me";
$nomj[4] = "Je";
$nomj[5] = "Ve";
$nomj[6] = "Sa";

$nomm[0] = "Janvier";
$nomm[1] = "F&eacute;vrier";
$nomm[2] = "Mars";
$nomm[3] = "Avril";
$nomm[4] = "Mai";
$nomm[5] = "Juin";
$nomm[6] = "Juillet";
$nomm[7] = "Ao&ucirc;t";
$nomm[8] = "Septembre";
$nomm[9] = "Octobre";
$nomm[10] = "Novembre";
$nomm[11] = "D&eacute;cembre";

















/**
 ---------------------------------------------------------------------------------------------
 * Le reste du code PHP, à priori, y'a plus besoin de le toucher. Par contre, y'a la CSS juste
 * un peu plus bas. Celle-là est parfaitement modifiable (c'est d'ailleurs recommandé, c'est
 * toujours mieux de personnaliser un peu le truc)
 */
$ajd = getdate();

if ($popup){
        
	$frm = $_GET["frm"];
	$champ = $_GET["ch"];
	$link = "?frm=".$frm."&ch=".$champ;
}else{
	$frm = $formHtml;
	$ch = $champ;
	$link = $page;
}

if (isset($_POST["mois"])){
    $mois = $_POST["mois"];
    $annee = $_POST["annee"];
}else{
    $mois = $ajd["mon"];
    $annee = $ajd["year"];
}

$aujourdhui = array($ajd["mday"], $ajd["mon"], $ajd["year"]);

$moisCheck = $mois + 1;
$anneeCheck = $annee;
if ($moisCheck > 12){
    $moisCheck = 1;
    $anneeCheck = $annee + 1;
}

$dernierJour = strftime("%d", mktime(0, 0, 0, $moisCheck, 0, $anneeCheck));
$premierJour = date("w", mktime(0, 0, 0, $mois, 1, $annee));

if ($affichage != "en"){
    //On modifie la position du premier jour suivant la disposition des jours qu'on veut
    $origine = 1;
    $j = $origine;
    for ($i = 0; $i < count($nomj); $i++){
        if ($j >= count($nomj)){
            $j = 0;
        }
        $temp[] = $nomj[$j];
        $j++;
    }
    $nomj = $temp;
    //On décale le 1er jour en conséquence
    $premierJour--;
    if ($premierJour < 0){
        $premierJour = 6;
    }
}

/**
 * Renvoie une string qui vaut selected ou non, pour un champs SELECT
 *
 * @param   integer     $temps      L'année ou le mois choisi
 * @param   integer     $i          L'annee en cours
 * @return  string                  La string nécessaire pour sélectionner une OPTION
 */
function get_selected($temps, $i){
    $selected = "";
    if ($temps == $i){
        $selected = " selected=\"selected\"";
    }
    return $selected;
}

/**
 * Renvoie une string représentant l'appel à une classe CSS
 *
 * Pour les valeurs par défaut :
 *      - 1 : ' class="aut"'
 *      - 2 : ''
 *
 * @param   integer     $jour       Le jour en cours
 * @param   integer     $index      La valeur par défaut de la string
 * @return  string                  La string nécessaire pour appeller la classe CSS voulue
 */
function get_classe($jour, $index, $mode){
    switch ($index) {
        case 1:
            $classe = " class=\"aut\"";
            break;
        default:
            $classe = "";
    }
    switch ($mode) {
        case "en":
            $x1 = 0;
            $x2 = 6;
            break;
        default:
            $x1 = 6;
            $x2 = 5;
    }
    if ($jour == $x1){
        $classe = " class=\"dim\"";
    }elseif ($jour == $x2){
        $classe = " class=\"sam\"";
    }
    return $classe;
}

/**
 * Détermine si on est sur un dimanche ou un samedi, à partir du 1er du mois
 *
 * @param   array       $ajd            Le jour, mois et année de maintenant
 * @param   integer     $annee          L'année en cours
 * @param   integer     $mois           Le mois en cours
 * @param   integer     $jour           Le jour en cours
 * @param   integer     $cptJour        Le numéro du jour en cours de la semaine
 * @param   integer     $premierJour    Le numéro du 1er jour (dans la semaine) du mois
 * @param   array       $nomj           Le tableau des noms des jours
 * @param   integer     $prems          Le numéro du dernier jour de la semaine du mois précédent
 * @param   string      $mode           Le mode d'affichage du calendrier ("fr" ou "en")
 * @return  string                      La string nécessaire pour appeller la classe CSS voulue
 */
function get_classeJour($ajd, $annee, $mois, $jour, $cptJour, $premierJour, $nomj, $prems, $mode){
    $classe = "";
    if ($mode == "en"){
        if (($cptJour == 0 && $jour > 1) || ($jour == 1 && $premierJour == 0)){
            $classe = " class=\"dim\"";
        }elseif ($cptJour == 6 || (count($nomj) - $jour == $prems)){
            $classe = " class=\"sam\"";
        }
    }else{
        if ($cptJour == 6 || (count($nomj) - $jour == $prems)){
            $classe = " class=\"dim\"";
        }else if ($cptJour == 5 || (count($nomj) - $jour - 1 == $prems)){
            $classe = " class=\"sam\"";
        }
    }
    if ($jour == $ajd[0] && $mois == $ajd[1] && $annee == $ajd[2]){
        $classe = " class=\"ajd\"";
    }
    return $classe;
}

/**
 * Détermine si on est sur un samedi, lorsqu'on complète le tableau
 *
 * @param   integer     $i              Le jour en cours
 * @param   integer     $cptJour        Le numéro du dernier jour (dans la semaine) du mois
 * @param   string      $mode           Le mode d'affichage du calendrier ("fr" ou "en")
 * @return  string                      La string nécessaire pour appeller la classe CSS voulue
 */
function get_classeJourReste($i, $cptJour, $mode){
    $classe = "";
    if ($mode == "en"){
        if ($i == (7 - $cptJour) - 1){
            $classe = " class=\"sam\"";
        }
    }else{
        if ($i == (6 - $cptJour) - 1){
            $classe = " class=\"sam\"";
        }else if ($i == (7 - $cptJour) - 1){
            $classe = " class=\"dim\"";
        }
    }
    return $classe;
}

?>

    <style>
        body, table, select {
            font-family: ubuntu,Arial;
            font-size: 11px;
            font-weight:bold;
        }

        body {
            background-image: url(/images/calendrier.gif);
            background-position: center center;
            background-repeat: no-repeat;
        }
</style>

<?php
if ($popup) {
?>
	<style>
		#calendrierEntier {
			
			
		}
	</style>
<?php
}else{
?>
<style>

.ggggg {
cursor:pointer;
background-color: #D14836;
background-image: -webkit-linear-gradient(top,#DD4B39,#D14836);
background-image: -moz-linear-gradient(top,#DD4B39,#D14836);
background-image: -ms-linear-gradient(top,#DD4B39,#D14836);
background-image: -o-linear-gradient(top,#DD4B39,#D14836);
background-image: linear-gradient(top,#DD4B39,#D14836);
border: 0px solid transparent;
text-shadow: 0 1px rgba(0, 0, 0, 0.1);
text-transform: uppercase;
-webkit-border-radius: 2px;
-moz-border-radius: 2px;
border-radius: 2px;
  padding: 4px 4px ;
 /* background: #c00 ;*/
  color: #fff ;
  font: 1em ubuntu, "Trebuchet MS",Arial,sans-serif ;
  line-height: 1em ;
  text-align: center ;
  text-decoration: none ;
}
.ggggg:hover, .ggggg:focus, .ggggg:active {
  background: #900 ;
  text-decoration: none;
}
		#calendrierEntier {
			
			
		}
</style>
<?php
}
?>
<style>
        #calendar {
            width: 160px;
           height: 160px;
           
            border-collapse: collapse;
            border-right: 1px solid #999999;
            border-bottom: 1px solid #999999;
            text-align: center;
            font-size: 110%;
           margin: 0;
           padding: 0;
        }
        #calendar th {
            border-left: 1px solid #999999;
            border-top: 1px solid #999999;
            padding: 0.5em;
            font-weight: bold;
            width: 10%;
        }

        #calendar td {
            border-left: 1px solid #999999;
            border-top: 1px solid #999999;
            margin: 0;
            padding: 0;
        }

        #calendar td a {
            display: block;
            text-decoration: none;
            color: #333333;
        }

        #calendar td a:hover {
            background-color: #CCCCCC;
            color: #333333;
        }

        .dim{
            background-color: #0099CC;
        }

        .aut {
            background-color: #EEEEEE;
        }

        .sam {
            background-color: #99CCFF;
        }

        .ajd {
            background-color: #00CC33;
        }

        #calendrier {
            width: 100%;
            margin: 0;
            text-align: center;
        }
       #calendrier select {
            width: 40%;
           margin: 0;
           
            
        }
    </style>

<div id="calendrierEntier"   >
<form id="calendrier" methwidth: 100%;od="post" action="<?php echo $link; ?>">
<select class="ggggg" name="mois" id="mois" onChange="reload(this.form)">
<?php
/**
 * Affichage des mois
 */
for ($i = 0; $i < count($nomm); $i++){
    $selected = get_selected($mois - 1, $i);
?>
    <option value="<?php echo ($i + 1); ?>"<?php echo $selected; ?>><?php echo $nomm[$i]; ?></option>
<?php
}
?>
</select>
<select class="ggggg" name="annee" id="annee" onChange="reload(this.form)">
<?php
/**
 * Affichage des années
 */
for ($i = $ajd["year"] - $anneeMin; $i < $ajd["year"] + $anneeMax; $i++){
    $selected = get_selected($annee, $i);
?>
    <option value="<?php echo $i; ?>"<?php echo $selected; ?>><?php echo $i; ?></option>
<?php
}
?>
</select>
</form>

<table id="calendar" >
    <tr>
<?php
/**
 * Affichage du nom des jours
 */
for ($jour = 0; $jour < 7; $jour++){
    $classe = get_classe($jour, 1, $affichage);
?>
        <th  style="color: red"align="center" <?php echo $classe; ?>><?php echo $nomj[$jour]; ?></th>
<?php
}
?>
    <tr style="text-align:center">
<?php
/**
 * Affichage des cellules vides en début de mois, s'il y en a
 */
for ($prems = 0; $prems < $premierJour; $prems++){
    $classe = get_classe($prems, 2, $affichage);
?>
        <td<?php echo $classe; ?>>&nbsp;</td>
<?php
}
/**
 * Affichage des jours du mois
 */
$cptJour = 0;
for ($jour = 1; $jour <= $dernierJour; $jour++){
    $classe = get_classeJour($aujourdhui, $annee, $mois, $jour, $cptJour, $premierJour, $nomj, $prems, $affichage);
    $cptJour++;
?>
        <td<?php echo $classe; ?>><a href="#" onClick="submitDate(<?php echo $jour; ?>)"><?php echo $jour; ?></a></td>
<?php
    if (is_int(($jour + $prems) / 7)){
        $cptJour = 0;
?>
    </tr>
<?php
        if ($jour < $dernierJour){
?>
    <tr>
<?php
        }
    }
}
/**
 * Affichage des cellules vides en fin de mois, s'il y en a
 */
if ($cptJour != 0){
    for ($i = 0; $i < (7 - $cptJour); $i++){
        $classe = get_classeJourReste($i, $cptJour, $affichage);
?>
        <td<?php echo $classe; ?>>&nbsp;</td>
<?php
    }
?>
    </tr>
<?php
}
?>
</table>
</div>

<script type="text/javascript">
    var checkzero = <?php echo $checkzero; ?>;
    var format = "<?php echo $format; ?>";
    var ordre = new Array("<?php echo strtoupper(implode('", "', $ordre)); ?>");

    /**
     * Reload la fenêtre avec les nouveaux mois et année choisis
     *
     * @param   object      frm     L'object document du formulaire
     */
    function reload(frm){
        var mois = frm.elements["mois"];
        var annee = frm.elements["annee"];
        //Debug du mois et année
        var index1 = mois.options[mois.selectedIndex].value;
        var index2 = annee.options[annee.selectedIndex].value;
        //Envoi du formulaire
        frm.submit();
    }

    /**
     * Ajoute un zéro devant le jour et le mois s'ils sont plus petit que 10
     *
     * @param   integer     jour        Le numéro du jour dans le mois
     * @param   integer     mois        Le numéro du mois
     */
    function checkNum(jour, mois){
        tab = new Array();
        tab[0] = jour;
        tab[1] = mois;
        if (this.checkzero){
            if (jour < 10){
                tab[0] = "0" + jour;
            }
            if (mois < 10){
                tab[1] = "0" + mois;
            }
        }
        return tab;
    }

    /**
     * Créé la string de retour et la renvoie à la page d'appel
     *
     * C'est ici que la string est créé. C'est également ici que le champ du formulaire
     * de la page d'appel reçoit la valeur. La fenêtre s'auto-fermera ensuite toute
     * seule comme une grande.
     * Paisible est l'étudiant qui comme la rivière peut suivre son cours sans quitter son lit...
     *
     * @param   integer     jour        Le numéro du jour dans le mois
     */
    function submitDate(jour){
        tab = this.checkNum(jour, <?php echo $mois; ?>);
        jour = tab[0];
        mois = tab[1];
        if (this.ordre[0] && this.ordre[0] == "M"){
            if (this.ordre[1] && this.ordre[1] == "A"){
                val = mois + this.format + "<?php echo $annee; ?>" + this.format + jour;
            }else{
                val = mois + this.format + jour + this.format + "<?php echo $annee; ?>";
            }
        }else if (this.ordre[0] && this.ordre[0] == "J"){
            if (this.ordre[1] == "A"){
                val = jour + this.format + "<?php echo $annee; ?>" + this.format + mois;
            }else{
                val = jour + this.format + mois + this.format + "<?php echo $annee; ?>";
            }
        }else{
            if (this.ordre[1] && this.ordre[1] == "J"){
                val = "<?php echo $annee; ?>" + this.format + jour + this.format + mois;
            }else{
                val = "<?php echo $annee; ?>" + this.format + mois + this.format + jour + " <?php echo date("H:i:s"); ?>";
            }
        }
<?php
if ($popup){
?>
        window.opener.document.<?php echo $frm.".elements[\"".$champ."\"]"; ?>.value = val;
		window.close();
<?php
}else{
?>
		document.<?php echo $frm.".elements[\"".$champ."\"]"; ?>.value = val;
<?php
}
?>
    }
</script>


