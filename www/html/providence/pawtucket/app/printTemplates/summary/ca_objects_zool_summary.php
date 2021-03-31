<?php
/* ----------------------------------------------------------------------
 * app/templates/summary/summary.php
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
 * -=-=-=-=-=- CUT HERE -=-=-=-=-=-
 * Template configuration:
 *
 * @name Object tear sheet
 * @type page
 * @pageSize letter
 * @pageOrientation portrait
 * @tables ca_objects
 * @marginTop 0.75in
 * @marginLeft 0.5in
 * @marginRight 0.5in
 * @marginBottom 0.75in
 *
 * ----------------------------------------------------------------------
 */
 
 	$t_item = $this->getVar('t_subject');
	$t_display = $this->getVar('t_display');
	$va_placements = $this->getVar("placements");

	print $this->render("pdfStart.php");
	print $this->render("header.php");
	print $this->render("footer.php");	

?>
	<div class="title">
		<h1 class="title"><?php print $t_item->getLabelForDisplay();?></h1>
	</div>
	<div class="title" style="font-size:1px">	    .</div>
	<div class="title" style="font-size:1px">		.</div>
	<div class="title" style="font-size:1px">	    .</div>
	<div class="title" style="font-size:1px">		.</div>
	<div class="title" style="font-size:1px">	    .</div>
	<div class="title" style="font-size:1px">		.</div>
	
	<div class="representationList">
<?php
	$va_reps = $t_item->getRepresentations(array("small", "thumbnail"));
	
	$nbrpic=0;
	foreach($va_reps as $va_rep) {
		if(sizeof($va_reps) > 1){
			# --- more than one rep show thumbnails
			#if ($nbrpic=0){
				if ($va_rep["mimetype"] == "image/jpeg"){
					$vn_padding_top = ((120 - $va_rep["info"]["small"]["HEIGHT"])/2) + 5;
					print $va_rep['tags']['small']."\n";
				}
			#}else{
			#	$vn_padding_top = ((120 - $va_rep["info"]["thumbnail"]["HEIGHT"])/2) + 5;
			#	print $va_rep['tags']['thumbnail']."\n";
			#}
		}else{
			# --- one rep - show medium rep
			if ($va_rep["mimetype"] == "image/jpeg"){
				print $va_rep['tags']['small']."\n";
			}
		}
	}
?>
	</div>
	</BR></BR></BR>
	<table margin="20px">	
		<TR>
			<TD style="font-size:14px" colspan="6">	
				<u><?php print _t('Taxonomy')?></u><BR>
			</TD>
		</TR>
		<TR>
			<TD style="font-size:10px">	
				<b><?php print _t('Phylum')?>:</b>
			</TD>
			<TD style="font-size:10px" colspan="5">	
				{{{<ifdef code="ca_objects.taxon_phylum">^ca_objects.taxon_phylum</ifdef>}}}
				{{{<ifnotdef code="ca_objects.taxon_phylum">/</ifnotdef>}}}
			</TD>
		</TR>
		<TR>
			<TD style="font-size:10px">		
				<b><?php print _t('Class')?>:</b>
			</TD>
			<TD style="font-size:10px" colspan="5">		
				{{{<ifdef code="ca_objects.taxon_class">^ca_objects.taxon_class</ifdef>}}}
				{{{<ifnotdef code="ca_objects.taxon_class">/</ifnotdef>}}}
			</TD>
		</TR>
		<TR>
			<TD style="font-size:10px">		
				<b><?php print _t('Order')?>:</b>
			</TD>
			<TD style="font-size:10px" colspan="5">		
				{{{<ifdef code="ca_objects.taxon_order">^ca_objects.taxon_order</ifdef>}}}
				{{{<ifnotdef code="ca_objects.taxon_order">/</ifnotdef>}}}
			</TD>
		</TR>
		<TR>
			<TD style="font-size:10px">		
				<b><?php print _t('Family')?>:</b>
			</TD>
			<TD style="font-size:10px" colspan="5">		
				{{{<ifdef code="ca_objects.taxon_family">^ca_objects.taxon_family</ifdef>}}}
				{{{<ifnotdef code="ca_objects.taxon_family">/</ifnotdef>}}}
			</TD>
		</TR>
		<TR>
			<TD style="font-size:10px">		
				<b><?php print _t('Genus')?>:</b>
			</TD>
			<TD style="font-size:10px" colspan="5">				
				{{{<ifdef code="ca_objects.taxon_genus">^ca_objects.taxon_genus</ifdef>}}}
				{{{<ifnotdef code="ca_objects.taxon_genus">/</ifnotdef>}}}
			</TD>
		</TR>
		<TR>
			<TD style="font-size:10px">		
				<b><?php print _t('Species')?>:</b>
			</TD>
			<TD style="font-size:10px" colspan="5">			
				{{{<ifdef code="ca_objects.taxon_species">^ca_objects.taxon_species</ifdef>}}}
				{{{<ifnotdef code="ca_objects.taxon_species">/</ifnotdef>}}}
			</TD>
					</TR>
		<TR>
			<TD style="font-size:10px">		
				<b><?php print _t('Subspecies')?>:</b>
			</TD>
			<TD style="font-size:10px" colspan="5">			
				{{{<ifdef code="ca_objects.taxon_subspecies">^ca_objects.taxon_subspecies</ifdef>}}}
				{{{<ifnotdef code="ca_objects.taxon_subspecies">/</ifnotdef>}}}
			</TD>
		</TR>
		<TR>
			<TD style="font-size:10px">		
				<b><?php print _t('Type')?>:</b>
			</TD>
			<TD style="font-size:10px" colspan="5">				
				{{{<ifdef code="ca_objects.taxon_status">^ca_objects.taxon_status</ifdef>}}}
				{{{<ifnotdef code="ca_objects.taxon_status">/</ifnotdef>}}}
			</TD>
		</TR>
		<TR>
			<TD style="font-size:14px" colspan="6">	</TD>
		</TR>
		<TR>
			<TD style="font-size:14px" colspan="6">	
				<u><?php print _t('General information')?></u><BR>
			</TD>
		</TR>
		<TR>
			<TD style="font-size:10px">		
				<b><?php print _t('Description')?>:</b>
			</TD>
			<TD style="font-size:10px" colspan="2">		
				{{{<ifdef code="ca_objects.description">^ca_objects.description</ifdef>}}}
				{{{<ifnotdef code="ca_objects.description">/</ifnotdef>}}}
			</TD>
		</TR>
		<TR>
			<TD style="font-size:10px">		
				<b><?php print _t('Code')?>:</b>
			</TD>
			<TD style="font-size:10px" colspan="2">	
				{{{<ifdef code="ca_objects.idno">^ca_objects.idno</ifdef>}}}
			</TD>
			<TD style="font-size:10px">		
				<b><?php print _t('UUID')?>:</b>
			</TD>
			<TD style="font-size:10px" colspan="2">		
				{{{<ifdef code="ca_objects.stable_CETAF_Identifier">^ca_objects.stable_CETAF_Identifier </ifdef>}}}
				{{{<ifnotdef code="ca_objects.stable_CETAF_Identifier">/</ifnotdef>}}}
			</TD>
		</TR>
				
		{{{<ifcount code="ca_entities" min="1" restrictToRelationshipTypes='contributor'><unit relativeTo='ca_entities' restrictToRelationshipTypes='contributor'>
		<TR>
			<TD style="font-size:10px">		
				<b><?php print _t('Contributor')?>:</b>
			</TD>
			<TD style="font-size:10px" colspan="5">	^ca_entities.preferred_labels.displayname</unit></ifcount>			
			</TD>
		</TR>}}}
		
		{{{<ifcount code="ca_entities" min="1" restrictToRelationshipTypes='collector'><unit relativeTo='ca_entities' restrictToRelationshipTypes='collector'>
		<TR>
			<TD style="font-size:10px">		
				<b><?php print _t('Collector')?>:</b>
			</TD>
			<TD style="font-size:10px" colspan="5">	^ca_entities.preferred_labels.displayname</unit></ifcount>			
			</TD>
		</TR>}}}
				
		{{{<ifcount code="ca_entities" min="1" restrictToRelationshipTypes='identifier'><unit relativeTo='ca_entities' restrictToRelationshipTypes='identifier'>
		<TR>
			<TD style="font-size:10px">		
				<b><?php print _t('Identifier')?>:</b>
			</TD>
			<TD style="font-size:10px" colspan="5">	^ca_entities.preferred_labels.displayname</unit></ifcount>			
			</TD>
		</TR>}}}

		<TR>
			<TD style="font-size:10px">		
				<b><?php print _t('Sex')?>:</b>
			</TD>
			<TD style="font-size:10px" colspan="2">		
				{{{<ifdef code="ca_objects.sex">^ca_objects.sex</ifdef>}}}
				{{{<ifnotdef code="ca_objects.sex">/</ifnotdef>}}}
			</TD>
			<TD style="font-size:10px">		
				<b><?php print _t('Life stage')?>:</b>
			</TD>
			<TD style="font-size:10px" colspan="2">		
				{{{<ifdef code="ca_objects.stage">^ca_objects.stage</ifdef>}}}
				{{{<ifnotdef code="ca_objects.stage">/</ifnotdef>}}}
			</TD>
			<TD style="font-size:10px">		
				<b><?php print _t('Amount')?>:</b>
			</TD>
			<TD style="font-size:10px" colspan="2">		
				{{{<ifdef code="ca_objects.amount">^ca_objects.amount</ifdef>}}}
				{{{<ifnotdef code="ca_objects.amount">/</ifnotdef>}}}
			</TD>
		</TR>
		</TR>
		<TR>
			<TD style="font-size:14px" colspan="6">	</TD>
		</TR>
		<TR>
			<TD style="font-size:14px" colspan="6">	
				<u><?php print _t('Sampling')?></u><BR>
			</TD>
		</TR>
		<TR>
			<TD style="font-size:10px">		
				<b><?php print _t('Country')?>:</b>
			</TD>
			<TD style="font-size:10px" colspan="2">				
				{{{<ifdef code="ca_objects.collect_country">^ca_objects.collect_country</ifdef>}}}
				{{{<ifnotdef code="ca_objects.collect_country">/</ifnotdef>}}}
			</TD>
			<TD style="font-size:10px">		
				<b><?php print _t('Coordinates')?>:</b>
			</TD>
			<TD style="font-size:10px" colspan="2">						
				{{{<ifdef code="ca_objects.georeference">^ca_objects.georeference</ifdef>}}}
				{{{<ifnotdef code="ca_objects.georeference">/</ifnotdef>}}}
			</TD>
		</TR>
		<TR>
			<TD style="font-size:10px">		
				<b><?php print _t('Location details')?>:</b>
			</TD>
			<TD style="font-size:10px" colspan="5">						
				{{{<ifdef code="ca_objects.locationdetails">^ca_objects.locationdetails</ifdef>}}}
				{{{<ifnotdef code="ca_objects.locationdetails">/</ifnotdef>}}}
			</TD>
		</TR>
		<TR>
			<TD style="font-size:10px">		
				<b><?php print _t('Date')?>:</b>
			</TD>
			<TD style="font-size:10px" colspan="5">			
				{{{<ifdef code="ca_objects.collect_date">^ca_objects.collect_date</ifdef>}}}
				{{{<ifnotdef code="ca_objects.collect_date">/</ifnotdef>}}}
			</TD>
		</TR>
	</table>
<?php	
	print $this->render("pdfEnd.php");