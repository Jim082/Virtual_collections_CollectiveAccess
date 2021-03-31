<?php
/* ----------------------------------------------------------------------
 * themes/default/views/bundles/ca_objects_default_html.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2013-2018 Whirl-i-Gig
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
 * ----------------------------------------------------------------------
 */
 
	$t_object = 			$this->getVar("item");
	$va_comments = 			$this->getVar("comments");
	$va_tags = 				$this->getVar("tags_array");
	$vn_comments_enabled = 	$this->getVar("commentsEnabled");
	$vn_share_enabled = 	$this->getVar("shareEnabled");
	$vn_pdf_enabled = 		$this->getVar("pdfEnabled");
	$vn_id =				$t_object->get('ca_objects.object_id');
	$phylum=				$t_object->get('ca_objects.taxon_phylum');
	$class=					$t_object->get('ca_objects.taxon_class');
	$order=					$t_object->get('ca_objects.taxon_order');
	$family=				$t_object->get('ca_objects.taxon_family');
	$genus=					$t_object->get('ca_objects.taxon_genus');
	$species=				$t_object->get('ca_objects.taxon_species');
	$subspecies=			$t_object->get('ca_objects.taxon_subspecies');
	$sex =					$t_object->get('ca_objects.sex');
	$status =				$t_object->get('ca_objects.taxon_status');
	$stage =				$t_object->get('ca_objects.stage');
	$amount =				$t_object->get('ca_objects.amount');
	$country =				$t_object->get('ca_objects.collect_country');
	$locationdetails =		$t_object->get('ca_objects.locationdetails');
	$coordinates =			$t_object->get('ca_objects.georeference');
	$collectdate =			$t_object->get('ca_objects.collect_date');
	$sketchfab=				$t_object->get('ca_objects.url_3D');
	$age=					$t_object->get('ca_objects.age');
	$objecttype=			$t_object->get('ca_objects.object_type');
	$materials=				$t_object->get('ca_objects.materials');
	$ethnic=				$t_object->get('ca_objects.ethnic_group');
	$Intrumentfamily=		$t_object->get('ca_objects.instrument_family');
	$doctype=				$t_object->get('ca_objects.type_id');
	
?>
<div class="row">
	<div class='col-xs-12 navTop'><!--- only shown at small screen size -->
		{{{previousLink}}}{{{resultsLink}}}{{{nextLink}}}
	</div><!-- end detailTop -->
	<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
		<div class="detailNavBgLeft">
			{{{previousLink}}}{{{resultsLink}}}
		</div><!-- end detailNavBgLeft -->
	</div><!-- end col -->
	<div class='col-xs-12 col-sm-10 col-md-10 col-lg-10'>
		<div class="container"><div class="row">
			<div class='col-sm-6 col-md-6 col-lg-5 col-lg-offset-1'>
			
<?php 			if ( $sketchfab != "") {
					if (strpos($sketchfab,"|") !== false) {
						$urls = explode("|", $sketchfab);
						foreach ($urls as $s) {
							echo '<iframe id="id1"				
							width="100%"
							height="255"
							src="'.$s.'"> </iframe> <BR>';
						}
					} else {?>
						{{{ 
						<iframe id="id"
						width="100%"
						height="255"
						src='^ca_objects.url_3D'>  
						</iframe>
						}}}			 
<?php 			}} 
				if ( $t_object->get('ca_objects.type_id') != 23) { #show Viewer only if it's not a document (txt, csv) ?>
					{{{representationViewer}}}
<?php 			}else{ 
					print '<H6>'._t("Download document").'</H6>';
					print "<a class = 'dlButton' href='/providence/pawtucket/index.php/Detail/DownloadRepresentation/context/objects/representation_id/".$t_object->get('ca_objects_x_object_representations.representation_id')."/id/".$t_object->get('ca_objects.object_id')."/download/1/version/original' title='Download' class='dlButton'> <span class='glyphicon glyphicon-download-alt'></span></a>";		
				} 
?>		
				<div id="detailAnnotations"></div>
				
				<?php print caObjectRepresentationThumbnails($this->request, $this->getVar("representation_id"), $t_object, array("returnAs" => "bsCols", "linkTo" => "carousel", "bsColClasses" => "smallpadding col-sm-3 col-md-3 col-xs-4", "primaryOnly" => $this->getVar('representationViewerPrimaryOnly') ? 1 : 0)); ?>
				
				{{{<ifcount code="ca_objects_x_objects" min="1" max="1"><H6><?php print _t('Related object'); ?></H6></ifcount>}}}
				{{{<ifcount code="ca_objects_x_objects" min="2"><H6><?php print _t('Related objects'); ?></H6></ifcount>}}}
				{{{<unit relativeTo="ca_objects_x_objects" delimiter="<br/>"><unit relativeTo="ca_objects"><l>^ca_objects.preferred_labels</l></unit> </unit>}}}
<?php
				# Comment and Share Tools
				if ($vn_comments_enabled | $vn_share_enabled | $vn_pdf_enabled) {
					print '<div id="detailTools">';
					if ($vn_comments_enabled) {
?>				
						<div class="detailTool"><a href='#' onclick='jQuery("#detailComments").slideToggle(); return false;'><span class="glyphicon glyphicon-comment"></span><?php print _t('Comments and Tags');?> (<?php print sizeof($va_comments) + sizeof($va_tags); ?>)</a></div><!-- end detailTool -->
						<div id='detailComments'><?php print $this->getVar("itemComments");?></div><!-- end itemComments -->
<?php				
					}
					#if ($vn_share_enabled) {
					#	print '<div class="detailTool"><span class="glyphicon glyphicon-share-alt"></span>'.$this->getVar("shareLink").'</div><!-- end detailTool -->';
					#}
					$vn_pdf_enabled = false;
					if ($vn_pdf_enabled) {
						# 216:zool ; 220:anthropo
						switch ($t_object->get('ca_objects.type_id')) {
							case 216: 
								print "<div class='detailTool'><span class='glyphicon glyphicon-file'></span>".caDetailLink($this->request, _t("Download as PDF"), "faDownload", "ca_objects",  $vn_id, array('view' => 'pdf', 'export_format' => '_pdf_ca_objects_zool_summary'))."</div>";
								break;
							case 220: 
								print "<div class='detailTool'><span class='glyphicon glyphicon-file'></span>".caDetailLink($this->request, _t("Download as PDF"), "faDownload", "ca_objects",  $vn_id, array('view' => 'pdf', 'export_format' => '_pdf_ca_objects_anthropo_summary'))."</div>";
								break;
							default:
								print "<div class='detailTool'><span class='glyphicon glyphicon-file'></span>".caDetailLink($this->request, _t("Download as PDF"), "faDownload", "ca_objects",  $vn_id, array('view' => 'pdf', 'export_format' => '_pdf_ca_objects_summary'))."</div>";
						}
					}
					print '</div><!-- end detailTools -->';
				}				
				
				#find URL for UUID	$o_config = Configuration::load();
				$o_config = Configuration::load();
				$URL_UUID_Biol = $o_config->get('url_uuid_biol');
				$URL_UUID_Anthropo = $o_config->get('url_uuid_anthropo');
				switch ($t_object->get('ca_objects.type_id')) {
					case 216: 
						$URL_UUID = $URL_UUID_Biol;
						break;
					case 220: 
						$URL_UUID = $URL_UUID_Anthropo;
						break;
				}
?>
			</div><!-- end col -->

			<div class='col-sm-6 col-md-6 col-lg-5'>
				<table width="100%">
					<tr>
						<td colspan="7" class="detail infosection">
							<div class='unit'><h6><?php print _t('General information'); ?></h6></div>
						</td>
					</tr>
					<tr style="vertical-align:top">
						<td colspan="7">
							<H4>{{{<unit relativeTo="ca_collections" delimiter="<br/>"><l>^ca_collections.preferred_labels.name</l></unit><ifcount min="1" code="ca_collections"> <br/> </ifcount>}}}{{{ca_objects.preferred_labels.name}}}</H4>
							<!--<H6>{{{<unit>^ca_objects.type_id</unit>}}}</H6>-->
							<HR>
							
							{{{<ifdef code="ca_objects.measurementSet.measurements">^ca_objects.measurementSet.measurements (^ca_objects.measurementSet.measurementsType)</ifdef><ifdef code="ca_objects.measurementSet.measurements,ca_objects.measurementSet.measurements"> x </ifdef><ifdef code="ca_objects.measurementSet.measurements2">^ca_objects.measurementSet.measurements2 (^ca_objects.measurementSet.measurementsType2)</ifdef>}}}
							
							{{{<ifdef code="ca_objects.idno">
								<H6><?php print _t('Code'); ?>:</H6>^ca_objects.idno<br/>
							</ifdef>}}}
							
<?php 						if ( $genus == "Anthophora") { ?>
								<H6>Permanent ID:</H6>UMons_9364
								<a href="http://www.atlashymenoptera.net/pagetaxon.aspx?tx_id=6468" target="_blank">
									<img alt="link to doc" data-entity-type="" data-entity-uuid="" src="/providence/pawtucket/themes/VirtualCollections/assets/pawtucket/graphics/link.jpg" class="align-center" width='15px'/>
								</a> 
								<br/>
<?php 						} ?>

							{{{<ifdef code="ca_objects.stable_CETAF_Identifier">
								<H6>Permanent ID:</H6>^ca_objects.stable_CETAF_Identifier
								<a href="<?php print $URL_UUID; ?>" target="_blank">
									<img alt="link to doc" data-entity-type="" data-entity-uuid="" src="/providence/pawtucket/themes/VirtualCollections/assets/pawtucket/graphics/link.jpg" class="align-center" width='15px'/>
								</a> 
								<br/>
							</ifdef>}}}			
							
							{{{<ifdef code="ca_objects.description">
								<div class='unit'><h6><?php print _t('Description'); ?></h6>
									<span class="trimText"><p style="white-space: pre-line">^ca_objects.description</p></span>
								</div>
							</ifdef>}}}
							
							{{{<ifcount code="ca_entities" min="1" max="1"><H6><?php print _t('Related person'); ?></H6></ifcount>
							<ifcount code="ca_entities" min="2"><H6><?php print _t('Related people'); ?></H6></ifcount>
							<unit relativeTo="ca_objects_x_entities" delimiter="<br/>">
								<unit relativeTo="ca_entities">
									<l>^ca_entities.preferred_labels</l>
								</unit> 
								(^relationship_typename)
							</unit>}}}
						</td>
					</tr>
					<tr style="vertical-align:top">
<?php 					if (  $doctype == 216) { #216=biology ?>
							<td colspan="2">
<?php 							if ( $stage != "") { ?>
									{{{
									<div class='unit'><h6><?php print _t('Life stage'); ?></h6>
										<span class="trimText">^ca_objects.stage</span>
									</div>
									}}}
<?php 							} ?>
							</td>
							<td colspan="2">
<?php 							if ( $sex != "") { ?>
									{{{
									<div class='unit'><h6><?php print _t('Sex'); ?></h6>
										<span class="trimText">^ca_objects.sex</span>
									</div>
									}}}
<?php 							} ?>
							</td>
							<!--<td>
<?php 							if ( $amount != "") { ?>
									{ {{<ifcount code="ca_storage_locations" min="1" max="1"><H6><?php print _t('Storage'); ?></H6></ifcount>}} }
									{ {{<ifcount code="ca_storage_locations" min="2"><H6><?php print _t('Storage spaces'); ?></H6></ifcount>}} }
									{ {{<unit relativeTo="ca_objects_x_storage_locations" delimiter="<br/>"><unit relativeTo="ca_storage_locations">^ca_storage_locations.idno</unit></unit>}} }
<?php 							} ?>
							</td>
							<td colspan="2">
<?php 							if ( $amount != "") { ?>
									{ {{
									<div class='unit'><h6><?php print _t('Amount'); ?></h6>
										<span class="trimText">^ca_objects.amount</span>
									</div>
									}} }
<?php 							} ?>
							</td>
							{ {{<ifdef code="ca_objects.containerID">
								<H6><?php print _t('Box'); ?>:</H6>^ca_objects.containerID<br/>
							</ifdef>}} }	-->
							
							{{{<ifcount code="ca_storage_locations" min="1"  max="1">}}}
								<td>
									{{{<ifcount code="ca_storage_locations" min="1" max="1"><H6><?php print _t('Storage'); ?></H6></ifcount>}}}
									{{{<ifcount code="ca_storage_locations" min="2"><H6><?php print _t('Storage spaces'); ?></H6></ifcount>}}}
									{{{<unit relativeTo="ca_objects_x_storage_locations" delimiter="<br/>"><unit relativeTo="ca_storage_locations">^ca_storage_locations.idno</unit></unit>}}}

								</td>
								<td colspan="2">
<?php 							if ( $amount != "") { ?>
										{{{
										<div class='unit'><h6><?php print _t('Amount'); ?></h6>
											<span class="trimText">^ca_objects.amount</span>
										</div>
										}}}
<?php 							} ?>
								</td>
							{{{</ifcount>}}}
<?php 					} ?>
<?php 					if (  $doctype == 220) { #220=anthropology ?>
							<td colspan="7">
<?php 							if ( $amount != "") { ?>
									{{{
									<div class='unit'><h6><?php print _t('Amount'); ?></h6>
										<span class="trimText">^ca_objects.amount</span>
									</div>
									}}}
<?php 							} ?>
							</td>
<?php 					} ?>
					</tr>
<?php 				if ( $genus != "" ) { ?>
						<tr style="vertical-align:top">
							<td colspan="7" class="detail infosection">
									<div class='unit'><h6><?php print _t('Taxonomy'); ?></h6></div>
							</td>
						</tr>
<?php 				} ?>
<?php 				if ( $age != ""  or $objecttype != ""  or $materials != ""){ ?>
						<tr style="vertical-align:top">
							<td colspan="7" class="detail infosection">
									<div class='unit'><h6><?php print _t('Object details'); ?></h6></div>
							</td>
						</tr>
<?php 				} ?>
					<tr style="vertical-align:top">
						<td colspan="3">
<?php 						if ( $phylum != "") { ?>
								{{{
									<h6><?php print _t('Phylum'); ?></h6>
									<span class="trimText">^ca_objects.taxon_phylum</span>
								}}}
<?php 						} ?>
						</td>
						<td colspan="4">
<?php 						if ( $genus != "") { ?>
								{{{
								<h6><?php print _t('Genus'); ?></h6>
									<span class="trimText">^ca_objects.taxon_genus</span>
								}}}
<?php 						} ?>
						</td>
					</tr>
					<tr style="vertical-align:top">
						<td colspan="3">
<?php 						if ( $class != "") { ?>
								{{{
								<h6><?php print _t('Class'); ?></h6>
									<span class="trimText">^ca_objects.taxon_class</span>
								}}}
<?php 						} ?>
						</td>
						<td colspan="4">
<?php 						if ( $species != "") { ?>
								{{{
								<h6><?php print _t('Species'); ?></h6>
									<i><span class="trimText">^ca_objects.taxon_species</span></i>
								}}}
<?php 						} ?>
						</td>
					</tr>
					<tr style="vertical-align:top">
						<td colspan="3">
<?php 						if ( $order != "") { ?>
								{{{
								<h6><?php print _t('Order'); ?></h6>
									<span class="trimText">^ca_objects.taxon_order</span>
								}}}
<?php 						} ?>
						</td>
						<td colspan="4">
<?php 						if ( $subspecies != "") { ?>
								{{{
								<h6><?php print _t('Subspecies'); ?></h6>
									<span class="trimText">^ca_objects.taxon_subspecies</span>
								}}}
<?php 						} ?>
						</td>
					</tr>
					<tr style="vertical-align:top">
						<td colspan="7">
<?php 						if ( $family != "") { ?>
								{{{
								<h6><?php print _t('Family'); ?></h6>
									<span class="trimText">^ca_objects.taxon_family</span>
								}}}
<?php 						} ?>
						</td>
					</tr>
					<tr>
						<td colspan="7">
<?php 						if ( $status != "") { ?>
								{{{
								<h6><?php print _t('Type'); ?></h6>
									<span class="trimText">^ca_objects.taxon_status</span>
								}}}
<?php 						} ?>
						</td>
					</tr>
					<tr style="vertical-align:top">
<?php 					if ( $objecttype != "") { ?>
							<td colspan="2">
								{{{
								<h6><?php print _t('Object type'); ?></h6>
									<span class="trimText">^ca_objects.object_type</span>
								}}}
							</td>
<?php 					} ?>
<?php 					if ( $age != "") { ?>
							<td>
								{{{
								<h6><?php print _t('Age'); ?></h6>
									<span class="trimText">^ca_objects.age</span> <?php print _t('years'); ?>
								}}}
							</td>
<?php 					} ?>
<?php 					if ( $materials != "") { ?>
							<td colspan="4">
								{{{
								<h6><?php print _t('Materials'); ?></h6>
									<span class="trimText">^ca_objects.materials</span>
								}}}
							</td>
<?php 					} ?>
					</tr>
					
<?php 				if ( $ethnic != "") { ?>
						<tr style="vertical-align:top">
							<td colspan="2">
								{{{
								<h6><?php print _t('Ethnic group'); ?></h6>
									<span class="trimText">^ca_objects.ethnic_group </span>
								}}}
							</td>
						</tr>
<?php 				} ?>

					
<?php 				if ( $Intrumentfamily != "") { ?>
						<tr style="vertical-align:top">
							<td colspan="5">
								{{{
								<h6><?php print _t('Instrument family'); ?></h6>
									<span class="trimText">^ca_objects.instrument_family</span>
								}}}
							</td>
						</tr>
<?php 				} ?>
					
					<tr>
						<td colspan="7" class="detail infosection">
<?php 						if (( $country != "" or $place != "" or strlen($collectdate) >1 ) and $doctype == 216) { #216=biology ?>
								<div class='unit'><h6><?php print _t('Sampling'); ?></h6></div>
<?php 						} ?>
						</td>
					</tr>
					<tr>
						<td colspan="7" class="detail infosection">
<?php 						if ( ($country != "" or $place != "" or strlen($collectdate) >1 ) and $doctype == 220) { #220=anthropology ?>
								<div class='unit'><h6><?php print _t('Origin'); ?></h6></div>
<?php 						} ?>
						</td>
					</tr>
					<tr>
						<td colspan="2">
<?php 						if ( $country != "" ) { ?>
								{{{
								<div class='unit'><h6><?php print _t('Country'); ?></h6>
									<span class="trimText">^ca_objects.collect_country </span>
								</div>
								}}}
<?php 						} ?>
						</td>
						<td colspan="2">
<?php 						if ( $coordinates != ""  ) { ?>
								{{{
								<div class='unit'><h6><?php print _t('Coordinates'); ?></h6>
									<span class="trimText">^ca_objects.georeference</span>
								</div>
								}}}
<?php 						} ?>
						</td>
						<td colspan="5">
<?php 						if ( $locationdetails != "" ) { ?>
								{{{
								<div class='unit'><h6><?php print _t('Location details'); ?></h6>
									<span class="trimText">^ca_objects.locationdetails </span>
								</div>
								}}}
<?php 						} ?>
						</td>
					</tr>
<?php 				if ( strlen($collectdate) >1 ) {?>
						{{{
						<tr>
							<td colspan="9">
								<div class='unit'><h6><?php print _t('Date'); ?></h6>
									<span class="trimText">^ca_objects.collect_date </span>
								</div>
							</td>
						</tr>
						}}}
<?php 				} ?>
				</table>
				{{{<ifdef code="ca_objects.dateSet.setDisplayValue"><H6><?php print _t('Date'); ?>:</H6>^ca_objects.dateSet.setDisplayValue<br/></ifdef>}}}
			
				<hr></hr>
<?php 			if ( $coordinates != ""  ) { ?>
					<div class="col-sm-8 ">
						<!--{ {{map}} }-->
						<style >
							p.collapse{
								display:none;
							}
						</style>
						<div  style="width:500px;height:400px;" id="map" class="map"></div>
						<div id="mouse-position"></div>
						<div>
							<select id="layer-select">
								<option value="Road">Road</option>
								<option value="Aerial">Aerial</option>
							</select>
						</div>
					</div>
<?php 			} ?>
				<div class="row">
					<div class="col-sm-4 colBorderLeft">		
						{{{<ifcount code="ca_places" min="1" max="1"><H6><?php print _t('Related place'); ?></H6></ifcount>}}}
						{{{<ifcount code="ca_places" min="2"><H6><?php print _t('Related places'); ?></H6></ifcount>}}}
						{{{<unit relativeTo="ca_objects_x_places" delimiter="<br/>"><unit relativeTo="ca_places"><l>^ca_places.preferred_labels</l></unit> (^relationship_typename)</unit>}}}
						
						{{{<ifcount code="ca_list_items" min="1" max="1"><H6><?php print _t('Related Term'); ?></H6></ifcount>}}}
						{{{<ifcount code="ca_list_items" min="2"><H6><?php print _t('Related Terms'); ?></H6></ifcount>}}}
						{{{<unit relativeTo="ca_objects_x_vocabulary_terms" delimiter="<br/>"><unit relativeTo="ca_list_items"><l>^ca_list_items.preferred_labels.name_plural</l></unit> (^relationship_typename)</unit>}}}
					</div><!-- end col -->				
				</div><!-- end row -->
			</div><!-- end col -->
		</div><!-- end row --></div><!-- end container -->
	</div><!-- end col -->
	<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
		<div class="detailNavBgRight">
			{{{nextLink}}}
		</div><!-- end detailNavBgLeft -->
	</div><!-- end col -->
</div><!-- end row -->
					<!--<div>
						<iframe id="id"	width="100%" height="500" src='//darwin.naturalsciences.be/backend.php/?menu=off'>  </iframe>
					</div>-->
<script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.4.3/build/ol.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.4.3/css/ol.css" type="text/css">

<?php 
	if ( $species != "") {
		$taxon=$species;
		$taxonlevel="species";
	} elseif ( $genus != ""){
		$taxon=$genus;
		$taxonlevel="genus";
	}elseif ( $family != ""){
		$taxon=$family;
		$taxonlevel="family";
	};
	
	echo '
	<script type="application/ld+json" >
	{
	  "@context": "http://schema.org",
	  "@id": "https://virtualcol.africamuseum.be/providence/pawtucket/index.php/Detail/objects/'.$vn_id.'",
	  "@type": "Taxon",
	  "dct:conformsTo": "https://bioschemas.org/profiles/Taxon/0.6-RELEASE",
	  "name": "'.$taxon.'",
	  "taxonRank": [
		"'.$taxonlevel.'"
	  ]
	}
	</script >
	';
?>

<script type='text/javascript'>
	jQuery(document).ready(function() {
		$('.trimText').readmore({
		  speed: 75,
		  maxHeight: 120
		});
		drawmap();
	});
	
	var map;
	var $lat;
	var $long;
	var p_data_epsg= 'EPSG:4326';
<?php 	if ( $coordinates != ""  ) { 
			$pos = strpos($coordinates, ",");
			if ($pos !== false){
				$lat=substr($coordinates, 1, -strlen($coordinates)+$pos);
				$long=substr($coordinates, $pos +1, -1);
				
			}
?>
			function drawmap(){
				mousePositionControl= new ol.control.MousePosition({
					 coordinateFormat: ol.coordinate.createStringXY(4),
					projection:p_data_epsg,
					className: "custom-mouse-position",
					target: document.getElementById("mouse-position"),
					undefinedHTML: "&nbsp;"
				});
				scaleLineControl = new ol.control.ScaleLine();

				styleLine= new ol.style.Style({
				  fill: new ol.style.Fill({
					color: 'rgba(255, 255, 255, 0.2)'
				  }),
				  stroke: new ol.style.Stroke({
					color: '#3366ff',
					width: 4
				  }),
				  image: new ol.style.Circle({
					radius: 7,
					fill: new ol.style.Fill({
					  color: '#3366ff'
					})
				  })
				})
				
				var wkt = 'POINT(<?php print $long;?> <?php print $lat;?>)';
				var format = new ol.format.WKT();
				var feature = format.readFeature(wkt,
									{
									dataProjection: 'EPSG:4326',
									featureProjection: 'EPSG:3857'
									});

				var vectorlayer = new ol.layer.Vector({
									source: new ol.source.Vector({
												features: [feature]
											}),
									style : styleLine
								});

				var styles = [
					'Road',
					'Aerial',
				  ];
				var layers = [];
				var i, ii;
				for (i = 0, ii = styles.length; i < ii; ++i) {
					layers.push(new ol.layer.Tile({
						visible: false,
						preload: Infinity,
						source: new ol.source.BingMaps({key: "Ai1X7hw9LHgPPF9BdnfLC2tTfhi5izHhCWJ4DCqREjqHBvDCsnBOfj3G3aCyoNwx",imagerySet: styles[i]  })
					}));
				}

				map = new ol.Map({
						target: 'map',
						layers: layers,
						view: new ol.View({
						  center: ol.proj.fromLonLat([<?php print $long; ?>,<?php print $lat; ?>]),
						  zoom: 7
						}),
						controls: ol.control.defaults({
								attributionOptions: ({collapsible: false})
						}).extend([mousePositionControl, scaleLineControl ])
				});
				map.addLayer(vectorlayer);
				
				var select = document.getElementById('layer-select');
				function onChange() {
					var style = select.value;
					for (var i = 0, ii = layers.length; i < ii; ++i) {
					  layers[i].setVisible(styles[i] === style);
					}
				}
				select.addEventListener('change', onChange);
				onChange();
				
				
			}
<?php 	}
?>
	
</script>