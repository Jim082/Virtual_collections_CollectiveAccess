<?php
/** ---------------------------------------------------------------------
 * themes/default/Front/front_page_html : Front page of site 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2013 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 *
 * This source code is free and modifiable under the terms of 
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * @package CollectiveAccess
 * @subpackage Core
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License version 3
 *
 * ----------------------------------------------------------------------
 */
		
?>
<div class="row" >
	<div class="col-sm-5" style="text-align:center;">
	<BR><BR>
		<?php print "<H1>"._t("Welcome to Virtual collections!<BR><BR><BR>You can browse through our digital collections and find detailed pictures, 3D models, sounds and videos of our collection items.")."</H1>";?>
		<BR>
	</div> 
	<div class="col-sm-7" >
		<img src='/providence/pawtucket/themes/VirtualCollections/assets/pawtucket/graphics/intro.jpg' alt="AfricaMuseum" width="70%" /> 
	</div> 
</div> 
<div class="row" >
	<div class="col-sm-12" style="text-align:left;">
		<h3><strong><?php print _t("Latest news!"); ?>  </strong></h3>
	</div> 
</div> 
<div class="row" >
	<div class="col-sm-2" style="text-align:right;">
		<img typeof="foaf:Image" src="https://www.naturalsciences.be/sites/default/files/styles/400w/public/Fig%20IV.1.jpg?itok=IoeWMSiS" width="90%" alt="Scorpion pictured in UV fluorescence. Focus stacking image." title="Scorpion pictured in UV fluorescence. Focus stacking image." /> 
	</div> 
	<div class="col-sm-10" style="text-align:left;">
		<div class="views-field views-field-created">        
			<span class="field-content">23/07/2020</span>  
		</div>  
		<div class="views-field views-field-title-field">        
			<H2><?php print _t("How to digitize natural science collections?"); ?></H2>  
		</div>        
		<div>
			<p><strong>	<?php print _t("Researchers from the Royal Belgian Institute of Natural Sciences and the Royal Museum for Central Africa have created a manual for the digitization of natural science collections. And it can be done literally in fifty different ways, with fifty more nuances. A guide."); ?></strong></p>
			<p> <?php print _t("By digitizing museum pieces in 2D and / or 3D and publishing them online, they are made accessible to researchers around the world. Thanks to the high-resolution images, specimens no longer have to leave the museum's deposit with its ideal conservation conditions. In addition, they are not likely to be damaged by handling and transport."); ?></p>
		</div> 				
		<div>    
			<a href="https://www.naturalsciences.be/<?php print _t('en'); ?>/news/item/19162/?fbclid=IwAR3QjRrEBebhVfEZoCMj5rItcdWhgcleZlmYJweYD9qR9_fnLIaQ7inLJys" target="_blank">  <?php print _t("More"); ?></a>...</BR><BR><BR>
		</div> 
	</div> 
</div> 

  <!--<iframe align="left" frameborder="1" height="600" name="News!" scrolling="yes" src="https://blog.sketchfab.com/museum-spotlight-royal-museum-central-africa/" title="News!" width="400" id="News!"></iframe>

				<iframe align="right" frameborder="0" height="600" name="News!" scrolling="yes" src="https://blog.sketchfab.com/cultural-heritage-spotlight-3d-digitization-process-rmca/" width="400" id="News!"></iframe>
-->

	<div class="col-sm-4" >

<?php
		// print $this->render("Front/gallery_set_links_html.php");
?>
	</div> <!--end col-sm-4-->	
<?php
	print $this->render("Front/featured_set_slideshow_html.php");
?>
</div><!-- end row -->