<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_artigos_relacionados
 *
 * @copyright
 * @license     GNU/Public
 */

defined('_JEXEC') or die;

$baseurl = JUri::base();
?>
<div class="artigos_relacionados<?php echo $moduleclass_sfx ?>">
    <div class="row">
        <?php 
	foreach ($meusitens as $meuitem) : ?>
        <?php 
//imagens

$images = json_decode($meuitem->images);


if($params->get('exibir_imagem') == '1'){
	if ($params->get('tipo_de_imagem') == 'first_text_image'){
		preg_match('/(?<!_)src=([\'"])?(.*?)\\1/',$meuitem->introtext, $matches);
	$image = $matches[2];
	}
	
	if ($params->get('tipo_de_imagem') == 'image_intro'){
		$image = $images->image_intro;
	}
	if ($params->get('tipo_de_imagem') == 'image_fulltext'){
		$image = $images->image_fulltext;
	}
		
}


//texto
//Limite de caracteres
$maxLimit = $params->get('limite_do_texto');
$text = $meuitem->introtext.$meuitem->fulltext;
         $text = preg_replace("/\r\n|\r|\n/", " ", $text);
                    // Em seguida, troca os marcadores <br /> com \n
                    $text = preg_replace("/<BR[^>]*>/i", " ", $text);
                    // Troca os marcadores <p> com \n\n
                    $text = preg_replace("/<P[^>]*>/i", " ", $text);
                    // Remove todos os marcadores
                    $text = strip_tags($text);
                    // Trunca o texto pelo limite de caracteres
                    $text = substr($text, 0, $maxLimit);
                    //$text = String::truncate($text, $maxLimit, '...', true);
                    // Deixa visível a última palavra que, no caso, foi cortada no meio
                    $text = preg_replace("/[.,!?:;]? [^ ]*$/", " ", $text);
                    // Adiciona reticências ao fim do texto
                    $text = trim($text) . '...' ;
                    // Troca \n com <br />
                    $text = str_replace("\n", " ", $text);

?>

		<div class="col-md-<?php echo $params->get('items_por_linha');?>">
		<?php if ($params->get('exibir_titulo') == '1') : ?>
			<h4 class="related-item-title">
			<a class="related-item-titl-link" href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute('index.php?option=com_content&view=article&catid='.$meuitem->catid.'&id='.$meuitem->id.'&Itemid='.$itemid));?>"><?php echo $meuitem->title;?></a>
			</h4>
<?php endif;?>
<?php if ($image and ($params->get('exibir_imagem') == '1') and ($image != '') ) : ?>
			<div class="related-item-image">
			<a class="related-item-titl-link" href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute('index.php?option=com_content&view=article&catid='.$meuitem->catid.'&id='.$meuitem->id.'&Itemid='.$itemid));?>">
			<img src="<?php echo $image;?>" />
			</a>
				
			</div>
<?php endif;?>
<?php if ($params->get('exibir_texto') == '1') : ?>
			<div class="related-item-description"><?php echo $text;?></div>
<?php endif;?>
<?php if ($params->get('show_read_more') == '1') : ?>

			<div class="related-item-readmore"><a class="btn button bt-primary" href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute('index.php?option=com_content&view=article&catid='.$meuitem->catid.'&id='.$meuitem->id.'&Itemid='.$itemid));?>"><?php echo JText::_('SHOW_MORE_BUTTON_TEXT');?></a></div>
<?php endif;?>
        </div>


        <?php endforeach;?>
    </div>
</div>