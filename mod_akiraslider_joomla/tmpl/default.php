<?php
// no acceso directo
defined('_JEXEC') or die('Restricted access');
$document = JFactory::getDocument();
JHtml::_('jquery.framework'); // This is necessary for adding the next scripts after joomla jquery files.

/* Start adding necesary CSS and JS scripts */
$document->addScript(Juri::base().'/modules/mod_akiraslider_joomla/vendors/flexslider/jquery.flexslider-min.js');
$document->addStyleSheet(Juri::base().'/modules/mod_akiraslider_joomla/vendors/flexslider/flexslider.css');
$document->addStyleSheet(Juri::base().'/modules/mod_akiraslider_joomla/css/styles.css');
/* end adding necesary CSS and JS scripts */

/* Start Get module's params */
$animation = $params->get('animation');
$controlNav = $params->get('controlNav');
$animationLoop = $params->get('animationLoop');
$itemWidth = $params->get('itemWidth');
$slideshow = $params->get('slideshow');
$itemMargin = $params->get('itemMargin');
$minItems = $params->get('minItems');
$maxItems = $params->get('maxItems');
$asNavFor = $params->get('asNavFor');
$sync = $params->get('sync');
$xmlConfig = $params->get('xmlConfig');
$idContent = $params->get('idContent');
/* End Get module's params */

if (strlen($xmlConfig) >= 5) { //lets check if the xml isn´t empty
    $xml       = simplexml_load_string($xmlConfig);
    $cont      = 0;
    $topLI     = "";
    $imagen    = "";
    $contenido = "";
    //echo($xmlConfig);
    foreach ($xml->slide as $value) { // parse de xml
        $cont++;
        $atributos  = $value->attributes();
        $files[] = $atributos["src"];
        $type[]      = $atributos["type"];
        $links[]  = "#";
    }
}
/*$document->addScriptDeclaration('
    window.event("domready", function() {
        alert("An inline JavaScript Declaration");
    });
');*/

?>
<div class="flexslider" id="<?php echo $idContent?>">
    <ul class="slides" >
        <?php $cont = 0; foreach($files as $file) {?>
            <li><img src="<?php echo $file;?>" /></li>
        <?php }?>
    </ul>
</div>

<script>
    jQuery(document).ready(function($){

        $('#<?php echo $idContent?>').flexslider({
            animation: "<?php echo $animation;?>",
            controlNav: <?php echo $controlNav;?>,
            animationLoop: <?php echo $animationLoop;?>,
            slideshow: <?php echo $slideshow;?>,
            itemWidth: <?php echo $itemWidth;?>,
            itemMargin: <?php echo $itemMargin;?>,
<?php if(strlen(trim($asNavFor)) > 2) echo "asNavFor: '#".$asNavFor."',"; ?>
<?php if(strlen(trim($sync)) > 2) echo "sync: '#".$sync."',"; ?>
            maxItems: <?php echo $maxItems;?>,
            minItems: <?php echo $minItems;?>
        });

    });
</script>