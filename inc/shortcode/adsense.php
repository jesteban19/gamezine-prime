<?php
	
function informatico_adsense_shortcode_render($attr){
	
	$adsense = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:block; text-align:center;"
     data-ad-format="fluid"
     data-ad-layout="in-article"
     data-ad-client="ca-pub-0147705992522980"
     data-ad-slot="3783380037"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>';
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
