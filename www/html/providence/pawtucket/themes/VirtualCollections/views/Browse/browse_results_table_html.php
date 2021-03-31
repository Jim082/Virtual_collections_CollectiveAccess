<?php
/* ----------------------------------------------------------------------
 * views/Browse/browse_results_images_html.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2014 Whirl-i-Gig
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
 
		$qr_res 			= $this->getVar('result');				// browse results (subclass of SearchResult)
		$qr_res2 			= $this->getVar('result');				// browse results (subclass of SearchResult)
		$va_facets 			= $this->getVar('facets');				// array of available browse facets
		$va_criteria 		= $this->getVar('criteria');			// array of browse criteria
		$vs_browse_key 		= $this->getVar('key');					// cache key for current browse
		$va_access_values 	= $this->getVar('access_values');		// list of access values for this user
		$vn_hits_per_block 	= (int)$this->getVar('hits_per_block');	// number of hits to display per block
		$vn_start		 	= (int)$this->getVar('start');			// offset to seek to before outputting results
		$vn_row_id		 	= (int)$this->getVar('row_id');			// id of last visited detail item so can load to and jump to that result - passed in back button
		$vb_row_id_loaded 	= false;
		if(!$vn_row_id){
			$vb_row_id_loaded = true;
		}

		$va_views			= $this->getVar('views');
		$vs_current_view	= $this->getVar('view');
		$va_view_icons		= $this->getVar('viewIcons');
		$vs_current_sort	= $this->getVar('sort');
		
		$t_instance			= $this->getVar('t_instance');
		$vs_table 			= $this->getVar('table');
		$vs_pk				= $this->getVar('primaryKey');
		$o_config = $this->getVar("config");	
			
		$va_options			= $this->getVar('options');
		$vs_extended_info_template = caGetOption('extendedInformationTemplate', $va_options, null);

		$vb_ajax			= (bool)$this->request->isAjax();
	   
		$o_icons_conf = caGetIconsConfig();
		$va_object_type_specific_icons = $o_icons_conf->getAssoc("placeholders");
		if(!($vs_default_placeholder = $o_icons_conf->get("placeholder_media_icon"))){
			$vs_default_placeholder = "<i class='fa fa-picture-o fa-2x'></i>";
		}
		$vs_default_placeholder_tag = "<div class='bResultItemImgPlaceholder'>".$vs_default_placeholder."</div>";

		
		$va_add_to_set_link_info = caGetAddToSetInfo($this->request);
	
		$vn_col_span = 6;
		$vn_col_span_sm = 6;
		$vn_col_span_xs = 12;
		$vb_refine = false;
		if(is_array($va_facets) && sizeof($va_facets)){
			$vb_refine = true;
			$vn_col_span = 6;
			$vn_col_span_sm = 6;
			$vn_col_span_xs = 12;
		}
		
		$type_id_all = [];
		$i = 0;

		#while($qr_res2->nextHit()) {   #get doc type to remove some columns
		for ($x = 0; $x < $qr_res2->numHits(); $x++) {
			if ($i == 0) {
				$type_id_all[$i] =  $qr_res2->get("{$vs_table}.type_id");
			}
			if (($qr_res2->get("{$vs_table}.type_id") != $type_id_all[$i-1])) {
				$type_id_all[$i] =  $qr_res2->get("{$vs_table}.type_id");
				$i = $i+1;
			}
		}
		$type_id = array_unique($type_id_all);
		$nbrcoll = sizeOf($type_id);		

		if ($vn_start < $qr_res->numHits()) {	
			$vn_c = 0;
			$vn_results_output = 0;
			$qr_res->seek($vn_start);
			
			if ($vs_table != 'ca_objects') {
				$va_ids = array();
				while($qr_res->nextHit() && ($vn_c < $vn_hits_per_block)) {
					$va_ids[] = $qr_res->get("{$vs_table}.{$vs_pk}");
				}
			
				$qr_res->seek($vn_start);
				$va_images = caGetDisplayImagesForAuthorityItems($vs_table, $va_ids, array('version' => 'small', 'relationshipTypes' => caGetOption('selectMediaUsingRelationshipTypes', $va_options, null), 'objectTypes' => caGetOption('selectMediaUsingTypes', $va_options, null), 'checkAccess' => $va_access_values));
			} else {
				$va_images = null;
			}
			
			$t_list_item = new ca_list_items();
			
			print "<div class = 'wrapper'><Table class='table_results' >
			<TR class='tr1'>
				<TD></TD>
				<!--<TD>	
					Picture
				</TD>-->
				<TD>	
					ID
				</TD>
				<TD>	
					"._t('Title')."
				</TD>
				<TD>	
					"._t('Collection')."
				</TD>";
				if ($nbrcoll == 1 and $type_id[0] == 216){ 
					print "
					<TD>	
						"._t('Phylum')."
					</TD>
					<TD>	
						"._t('Class')."
					</TD>
					<TD>	
						"._t('Order')."
					</TD>
					<TD>	
						"._t('Family')."
					</TD>
					<TD>	
						"._t('Genus')."
					</TD>
					<TD>	
						"._t('Species')."
					</TD>
					<TD>	
						"._t('Subspecies')."
					</TD>
					<TD>	
						"._t('Type')."
					</TD>
					<TD>	
						"._t('Sex')."
					</TD>
					<TD>	
						"._t('Life stage')."
					</TD>";
				}
				print  "<TD>	
					"._t('Amount')."
				</TD>";
				if ($nbrcoll == 1 and $type_id[0] == 220){ 
					print "<TD>	
						"._t('Object type')."
					</TD>
					<TD>	
						"._t('Materials')."
					</TD>
					<TD>	
						"._t('Age')." ("._t('years').")
					</TD>
					<TD>	
						"._t('Ethnic group')."
					</TD>
					<TD>	
						"._t('Instrument family')."
					</TD>";
				}
				print "<TD>	
					"._t('Country')."
				</TD>
				<TD>	
					"._t('Place')."
				</TD>
				<TD>	
					"._t('Coordinates')."
				</TD>
				<TD>	
					"._t('Sampling date')."
				</TD>
				<!--<TD>	
					Collector
				</TD>
				<TD>	
					Contributor
				</TD>
				<TD>	
					"._t('Box')."
				</TD>-->
				<TD>	
					"._t('UUID')."
				</TD>
				<TD></TD>
			</TR>";
			while($qr_res->nextHit()) {
				
				if($vn_c == $vn_hits_per_block){
					if($vb_row_id_loaded){
						break;
					}else{
						$vn_c = 0;
					}
				}
				$vn_id 	= $qr_res->get("{$vs_table}.{$vs_pk}");
				if($vn_id == $vn_row_id){
					$vb_row_id_loaded = true;
				}
				# --- check if this result has been cached
				# --- key is MD5 of table, id, view, refine(vb_refine)
				$vs_cache_key = md5($vs_table.$vn_id."list".$vb_refine);
				
				if(($o_config->get("cache_timeout") > 0) && ExternalCache::contains($vs_cache_key,'browse_result')){
					print ExternalCache::fetch($vs_cache_key, 'browse_result');
				}else{
					$vs_type_detail 	= $qr_res->get("{$vs_table}.type_id");
					
					if ($vs_type_detail != 23){ #hide related documents
						$vs_idno_detail_link 	= caDetailLink($this->request, $qr_res->get("{$vs_table}.idno"), '', $vs_table, $vn_id);
						$vs_label_detail_link 	=$qr_res->get("{$vs_table}.preferred_labels");
						$vs_label_uuid			=$qr_res->get("{$vs_table}.stable_CETAF_Identifier");
						$vs_label_collection	=$qr_res->get("{$vs_table}.taxon_phylum");
						$vs_label_phylum		=$qr_res->get("{$vs_table}.taxon_phylum");
						$vs_label_class			=$qr_res->get("{$vs_table}.taxon_class");
						$vs_label_order			=$qr_res->get("{$vs_table}.taxon_order");
						$vs_label_family		=$qr_res->get("{$vs_table}.taxon_family");
						$vs_label_genus			=$qr_res->get("{$vs_table}.taxon_genus");
						$vs_label_species		=$qr_res->get("{$vs_table}.taxon_species");
						$vs_label_subspecies	=$qr_res->get("{$vs_table}.taxon_subspecies");
						$vs_label_type			=$qr_res->get("{$vs_table}.taxon_status.item_value");
						$vs_label_sex			=$qr_res->get("{$vs_table}.sex.item_value");
						$vs_label_stage			=$qr_res->get("{$vs_table}.stage");
						$vs_label_amount		=$qr_res->get("{$vs_table}.amount");
						$vs_label_country		=$qr_res->get("{$vs_table}.collect_country");
						$vs_label_place			=$qr_res->get("{$vs_table}.locationdetails");
						$vs_label_coord			=$qr_res->get("{$vs_table}.georeference");
						$vs_label_sampling_date	=$qr_res->get("{$vs_table}.collect_date");
						$vs_label_sketchfab		=$qr_res->get("{$vs_table}.url_3D");
						$vs_label_age			=$qr_res->get("{$vs_table}.age");
						$vs_label_objecttype	=$qr_res->get("{$vs_table}.object_type");
						$vs_label_materials		=$qr_res->get("{$vs_table}.materials");
						$vs_label_ethnic		=$qr_res->get("{$vs_table}.ethnic_group");
						$vs_label_Intrumentfamily=$qr_res->get("{$vs_table}.intrument_family");
						$vs_label_doctype		=$qr_res->get("{$vs_table}.type_id");
						
						$vs_thumbnail = "";
						$vs_type_placeholder = "";
						$vs_typecode = "";
						$vs_image = ($vs_table === 'ca_objects') ? $qr_res->getMediaTag("ca_object_representations.media", 'small', array("checkAccess" => $va_access_values)) : $va_images[$vn_id];
					
						if(!$vs_image){
							if ($vs_table == 'ca_objects') {
								$t_list_item->load($qr_res->get("type_id"));
								$vs_typecode = $t_list_item->get("idno");
								if($vs_type_placeholder = caGetPlaceholder($vs_typecode, "placeholder_media_icon")){
									$vs_image = "<div class='bResultItemImgPlaceholder'>".$vs_type_placeholder."</div>";
								}else{
									$vs_image = $vs_default_placeholder_tag;
								}
							}else{
								$vs_image = $vs_default_placeholder_tag;
							}
						}
						$vs_rep_detail_link 	= caDetailLink($this->request, $vs_image, '', $vs_table, $vn_id);	
					
						$vs_add_to_set_link = "";
						if(($vs_table == 'ca_objects') && is_array($va_add_to_set_link_info) && sizeof($va_add_to_set_link_info)){
							$vs_add_to_set_link = "<a href='#' onclick='caMediaPanel.showPanel(\"".caNavUrl($this->request, '', $va_add_to_set_link_info["controller"], 'addItemForm', array($vs_pk => $vn_id))."\"); return false;' title='".$va_add_to_set_link_info["link_text"]."'>".$va_add_to_set_link_info["icon"]."</a>";
						}
					
						$vs_expanded_info = $qr_res->getWithTemplate($vs_extended_info_template);
			
						$vs_result_outputTable = "
							<TR class='tr2'>
								<TD>	
									<div class='bSetsSelectMultiple'>
										<input type='checkbox' name='object_ids[]' value='{$vn_id}'>
									</div>
								</TD>
								<!--<TD>	
									{$vs_rep_detail_link}
								</TD>-->
								<TD>	
									<small>{$vs_idno_detail_link}</small>
								</TD>
								<TD>	
									{$vs_label_detail_link}

								</TD>
								<TD>	
									{$vs_label_collection}
								</TD>";
								if ($nbrcoll > 1 or ($nbrcoll == 1 and $type_id[0] == 216)){ 
									$vs_result_outputTable .= 
									"<TD>	
										{$vs_label_phylum}
									</TD>
									<TD>	
										{$vs_label_class}
									</TD>
									<TD>	
										{$vs_label_order}
									</TD>
									<TD>	
										{$vs_label_family}
									</TD>
									<TD>	
										{$vs_label_genus}
									</TD>
									<TD>	
										{$vs_label_species}
									</TD>
									<TD>	
										{$vs_label_subspecies}
									</TD>
									<TD>	
										{$vs_label_type}
									</TD>
									<TD>	
										{$vs_label_sex}
									</TD>
									<TD>	
										{$vs_label_stage}
									</TD>";
							}
								$vs_result_outputTable .=   "
								<TD>	
									{$vs_label_amount}
								</TD>";
								if ($nbrcoll > 1 or ($nbrcoll == 1 and $type_id[0] == 220)){ 
									$vs_result_outputTable .=  "
									<TD>	
										{$vs_label_objecttype}
									</TD>
									<TD>	
										{$vs_label_materials}
									</TD>
									<TD>	
										{$vs_label_age}
									</TD>
									<TD>	
										{$vs_label_ethnic}
									</TD>
									<TD>	
										{$vs_label_Intrumentfamily}
									</TD>";
								}
								$vs_result_outputTable .=  "
								<TD>	
									{$vs_label_country}
								</TD>
								<TD>	
									{$vs_label_place}
								</TD>
								<TD>	
									{$vs_label_coord}
								</TD>
								<TD>	
									{$vs_label_sampling_date}
								</TD>
								<!--<TD>
									{$vs_label_collector}
								</TD>
								<TD>	
									{$vs_label_contributor}
								</TD>
								<TD>	
									{$vs_label_box}
								</TD>-->
								<TD>	
									{$vs_label_uuid}
								</TD>
								<TD>	
										<div class='bResultListItemExpandedInfo' id='bResultListItemExpandedInfo{$vn_id}'>
											<hr>
											{$vs_expanded_info}{$vs_add_to_set_link}
										</div><!-- bResultListItemExpandedInfo -->

								</TD>
							</TR>
							";
						#ExternalCache::save($vs_cache_key, $vs_result_output, 'browse_result', $o_config->get("cache_timeout"));
						ExternalCache::save($vs_cache_key, $vs_result_outputTable, 'browse_result', $o_config->get("cache_timeout"));
						#print $vs_result_output;
						print $vs_result_outputTable;
					}
				}				
				$vn_c++;
				$vn_results_output++;
			}
			print "</Table></div>";
			print "<div style='clear:both'></div>".caNavLink($this->request, _t('Next %1', $vn_hits_per_block), 'jscroll-next', '*', '*', '*', array('s' => $vn_start + $vn_results_output, 'key' => $vs_browse_key, 'view' => $vs_current_view, 'sort' => $vs_current_sort, '_advanced' => $this->getVar('is_advanced') ? 1  : 0));
		}
?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		if($("#bSetsSelectMultipleButton").is(":visible")){
			$(".bSetsSelectMultiple").show();
		}
	});
</script>