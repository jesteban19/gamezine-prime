<?php
	
function informatico_adsense_shortcode_render($attr){
	
	$adsense = magazine_prime_get_option('adense_id_article');
	return $adsense;
	
}
function informatico_adsense_shortcode($context){
return $context.=__("
<a href=\"#\" class=\"button\" id=\"adsense_article_btn\" title=\"Agregar Adesense\">$ Publicidad</a>");
}

function informatico_adsense_shortcode_to_editor()
{
	
?>
	
	<script>
		
		  jQuery('#adsense_article_btn').on('click',function(){
			  var shortcode = '[adsense_article /]';
			  if( !tinyMCE.activeEditor || tinyMCE.activeEditor.isHidden()) {
			    jQuery('textarea#content').val(shortcode);
			  } else {
			    tinyMCE.execCommand('mceInsertContent', false, shortcode);
			  }
			  //close the thickbox after adding shortcode to editor
			  self.parent.tb_remove();
			});
	
	</script>

<?php
}

add_shortcode('adsense_article','informatico_adsense_shortcode_render');
add_action('media_buttons_context','informatico_adsense_shortcode');
add_action('admin_footer','informatico_adsense_shortcode_to_editor');

?>
