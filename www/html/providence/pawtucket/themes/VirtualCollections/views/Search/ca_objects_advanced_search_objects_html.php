
<div class="row">
	<div class="col-sm-8 " style='border-right:1px solid #ddd;'>
		
<?php			
	print "<H1>"._t("Objects Advanced Search")."</H1>";
	print "<p>"._t("Enter your search terms in the fields below.")."</p>";

	#----------fill lifestage and object types---------
	$stages=Array();
	$o_config = Configuration::load();
	$url_search = $o_config->get('url_search');
	$user_search = $o_config->get('user_search');
	$pass_search = $o_config->get('pass_search');

	$conn = new PDO($url_search, $user_search, $pass_search);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql = "SELECT distinct value_longtext1 FROM ca_attribute_values WHERE element_id=54 order by value_longtext1;";

	$q = $conn->prepare($sql);
	$q->execute();
	$lifestages = $q->fetchAll();

	$i=0;
	foreach($lifestages as $lifestage){
		$stages[$i]= $lifestage[0];
		$i++;
	}

	$sql2 = "SELECT distinct value_longtext1 FROM ca_attribute_values WHERE element_id=119 order by value_longtext1;";

	$q = $conn->prepare($sql2);
	$q->execute();
	$objecttypes = $q->fetchAll();

	$i=0;
	foreach($objecttypes as $objecttype){
		$types[$i]= $objecttype[0];
		$i++;
	}
	
	$sql3 = "SELECT distinct value_longtext1 FROM ca_attribute_values WHERE element_id=121 order by value_longtext1;";

	$q = $conn->prepare($sql3);
	$q->execute();
	$instrumentamilys = $q->fetchAll();

	$i=0;
	foreach($instrumentamilys as $instrumentamily){
		$instrumentFamilys[$i]= $instrumentamily[0];
		$i++;
	}
	
	$sql4 = "SELECT idno FROM `ca_collections` WHERE `parent_id` IS NULL and `collection_id` > 1;";

	$q = $conn->prepare($sql4);
	$q->execute();
	$doctypes = $q->fetchAll();

	$i=0;
	foreach($doctypes as $doctype){
		$doc_types[$i]= $doctype[0];
		$i++;
	}
	
	$sql5 = "SELECT distinct value_longtext1 FROM ca_attribute_values WHERE element_id=41 order by value_longtext1;";

	$q = $conn->prepare($sql5);
	$q->execute();
	$phylums = $q->fetchAll();

	$i=0;
	foreach($phylums as $phylum){
		$taxonphylums[$i]= $phylum[0];
		$i++;
	}

	$sql6 = "SELECT distinct value_longtext1 FROM ca_attribute_values WHERE element_id=42 order by value_longtext1;";

	$q = $conn->prepare($sql6);
	$q->execute();
	$classes = $q->fetchAll();

	$i=0;
	foreach($classes as $class){
		$taxonclasses[$i]= $class[0];
		$i++;
	}
	
	$sql7 = "SELECT distinct value_longtext1 FROM ca_attribute_values WHERE element_id=43 order by value_longtext1;";

	$q = $conn->prepare($sql7);
	$q->execute();
	$orders = $q->fetchAll();

	$i=0;
	foreach($orders as $order){
		$taxonorders[$i]= $order[0];
		$i++;
	}
	
	$sql8 = "SELECT distinct value_longtext1 FROM ca_attribute_values WHERE element_id=44 order by value_longtext1;";

	$q = $conn->prepare($sql8);
	$q->execute();
	$families = $q->fetchAll();

	$i=0;
	foreach($families as $family){
		$taxonfamilies[$i]= $family[0];
		$i++;
	}
?>

{{{form}}}

<div class='advancedContainer'>
	<div class='row'>
		<!--<div class="advancedSearchField col-sm-3">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search object collections."><?php print _t("Collection"); ?></span>
			{{{ca_collections.collection_id%restrictToTypes=collection%width=200px&height=30px&select=1&sort=ca_collections.preferred_labels.name}}}
		</div>-->
		<div class="advancedSearchField col-sm-3 ">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit your search to object types."><?php print _t("Theme"); ?></span>
			{{{ca_objects.type_id%height=30px}}}
		</div>
		<div class="advancedSearchField col-sm-4">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search object identifiers."><?php print _t("Identifier"); ?></span>
			{{{ca_objects.idno%width=210px}}}
		</div>
		<div class="advancedSearchField col-sm-5">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search across all fields in the database."><?php print _t("Keyword"); ?></span>
			{{{_fulltext%width=200px&height=1}}}
		</div>			
	</div>		
	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit your search to Object Titles only."><?php print _t("Title"); ?></span>
			{{{ca_objects.preferred_labels.name%width=220px}}}
		</div>
	</div>		
	<div class='row'>
		<div class="advancedSearchField col-sm-2 zoology">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit your search to phylum only."><?php print _t("Phylum"); ?></span>
			{{{ca_objects.taxon_phylum%width=220px}}}
		</div>
		<div class="advancedSearchField col-sm-2 zoology">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit your search to class only."><?php print _t("Class"); ?></span>
			{{{ca_objects.taxon_class%width=220px}}}
		</div>
		<div class="advancedSearchField col-sm-2 zoology">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit your search to order only."><?php print _t("Order"); ?></span>
			{{{ca_objects.taxon_order%width=220px}}}
		</div>
		<div class="advancedSearchField col-sm-2 zoology">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit your search to family only."><?php print _t("Family"); ?></span>
			{{{ca_objects.taxon_family%width=220px}}}
		</div>
		<div class="advancedSearchField col-sm-2 zoology">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit your search to Genus only."><?php print _t("Genus"); ?></span>
			{{{ca_objects.taxon_genus%width=220px}}}
		</div>
		<div class="advancedSearchField col-sm-2 zoology">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit your search to Species only."><?php print _t("Species"); ?></span>
			{{{ca_objects.taxon_species}}}
		</div>
		<div class="advancedSearchField col-sm-2 zoology">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit your search to taxon type."><?php print _t("Type"); ?></span>
			{{{ca_objects.taxon_status%restrictToTypes=objects%width=200px&height=auto}}}
		</div>
		<div class="advancedSearchField col-sm-2 zoology">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit your search to the sex."><?php print _t("Sex"); ?></span>
			{{{ca_objects.sex}}}
		</div>
		<div class="advancedSearchField col-sm-6 zoology">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit your search to life stage."><?php print _t("Life stage"); ?></span>
			{{{ca_objects.stage}}}
		</div>
	</div>
	<div class='row'>
		<div class="advancedSearchField col-sm-2 anthropology">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit your search to Object type."><?php print _t("Object type"); ?></span>
			{{{ca_objects.object_type}}}
		</div>
		<div class="advancedSearchField col-sm-2 anthropology">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit your search to age of object."><?php print _t("Age"); ?></span>
			{{{ca_objects.age}}}
		</div>
		<div class="advancedSearchField col-sm-2 anthropology">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit your search to materials of object."><?php print _t("Materials"); ?></span>
			{{{ca_objects.materials}}}
		</div>
		<div class="advancedSearchField col-sm-2 anthropology">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit your search to ethnic group."><?php print _t("Ethnic group"); ?></span>
			{{{ca_objects.ethnic_group}}}
		</div>
		<div class="advancedSearchField col-sm-2 anthropology">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit your search to family of instrument."><?php print _t("Instrument family"); ?></span>
			{{{ca_objects.instrument_family}}}
		</div>
	</div>
	<div class='row'>
		<div class="advancedSearchField col-sm-2">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search object identifiers.">UUID</span>
			{{{ca_objects.stable_CETAF_Identifier}}}
		</div>
		<div class="advancedSearchField col-sm-2">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit your search to 3D."><?php print _t("Media type"); ?></span>
			{{{ca_objects.digitisation}}}
		</div>
		<div class="col-sm-2">
			<?php print _t("Boxes"); ?>
			<input type="checkbox" id="boxes" name="boxes" onclick="validatebox()" />
		</div>
	</div>
	<div class='row'>
		<div class="advancedSearchField col-sm-4">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search records of a particular date or date range."><?php print _t("Date of collect range <i>(e.g. 1970-1979)</i>"); ?></span>
			{{{ca_objects.collect_date}}}
		</div>
		<div class="advancedSearchField col-sm-2">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit your search to country."><?php print _t("Country of collect"); ?></span>
			{{{ca_objects.collect_country}}}
		</div>
	</div>
	<!--<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search records within a particular collection.">Collection </span>
			{{{ca_collections.preferred_labels%restrictToTypes=collection%width=200px&height=40px}}}
		</div>
	</div>-->
	<br style="clear: both;"/>
	<div class='advancedFormSubmit'>
		<!--<span class='btn btn-default'>{{{reset%label=Reset}}}</span>-->
		<span class='btn btn-default' style="margin-left: 20px;"><INPUT class = "transp_button" type="button" onclick="reset()" Name = "Reset" VALUE = "<?php print _t("Reset"); ?>"></span>
		<!--<span class='btn btn-default' style="margin-left: 20px;">{{{submit%label=Search}}}</span>-->
		<span class='btn btn-default' style="margin-left: 20px;"><INPUT class = "transp_button" TYPE = "Submit" Name = "Search" VALUE = "<?php print _t("Search"); ?>"></span>
	</div>
</div>	

{{{/form}}}

	</div>
	<div class="col-sm-4" >
<?php			
		print "<H1>"._t("Help")."</H1>";
		print "<p>"._t("This form allows you to carry out an advanced search within our already inventoried collections.")."</p>";
		print "<p>"._t("You can search on multiple fields simultaneously. Furthermore, for the title, keywords and dates, it is possible to carry out a search on the basis of incomplete terms using an asterisk (*).")."</p>";
		print "<p>"._t("Example: 'coal' will allow you to retrieve entries containing the term 'coal', 'coalfield', 'coalbox', etc.")."</p>";
		print "<p>"._t("On the results page, you can further refine your search using different filters.")."</p>";
		print "<p>"._t("Fields are displayed according to the chosen collection. If you want to see all fields, don't choose a collection.")."</p>";
		print "<H2>"._t("Description of the different fields")."</H2>";
		print "<p>"._t("<B>Theme</B>: research based on the top-level collection.<BR><B>Identifier</B>: if you know the item's identifier.<BR><B>Keyword</B>: General field where you can enter a term to be searched everywhere.<BR><B>Title</B>: search in the words of the document title. You can write multiple title terms in any order; however, the search engine only considers whole words (no asterisk (*)).<BR><B>Taxonomic fields</B> : Enter name of the taxon(asterisk (*) allowed)<BR><B>Type</B>: Choose one of the taxonomic types in the list.<BR><B>Sex</B>: Choose one value in the list.<BR><B>Life stage</B>: Enter a value.<BR><B>Object type, Age, Materials, Ethnic group, Instrument family</B>: Enter a value (an integer for age).<BR><B>UUID</B>: if you know the UUID.<BR><B>Media type</B> : Choose one of the media types.<BR><B>Boxes</B> : Check Boxes if you want to limit your search to complete boxes<BR><B>Date of collect</B>: research based on a year or a range of years. Examples: '1974' (all documents dating from 1974), '1974-1979' (all documents in this range of years), '197*' (all documents between 1970 and 1979), '19**' (all documents between 1900 and 1999).<BR><B>Country of collect </B>: Enter name of the country (name may depend on the language).")."</p>";
?>

	</div><!-- end col -->
</div><!-- end row -->



<script>
	jQuery(document).ready(function() {
		$('[name="ca_objects.type_id"] option[value=216]').attr('selected','selected');
		$('.zoology').show();
		$('.anthropology').hide();
		$('.advancedSearchField .formLabel').popover(); 
	});


	
	function validatebox(){
		if (document.getElementById('boxes').checked){
			$('[name="_fulltext[]"]').val($('[name="_fulltext[]"]').val() + " full box") ;
		}else{
			$('[name="_fulltext[]"]').val($('[name="_fulltext[]"]').val().replace(" full box", ""));
		}
}

	$('[name="ca_objects.type_id"]').change(function(){
		var tmp = $('[name="ca_objects.type_id"] option:selected').val().trim();
		//if ((tmp == "Zoology") || (tmp == "Zoologie") || (tmp == "Zoölogie")) {
		if ((tmp == "216")) {
			$('.anthropology').hide();
			$('.zoology').show();
		}
		if ((tmp == "220")) {
			$('.anthropology').show();
			$('.zoology').hide();
		}
		if ((tmp == "")) {
			$('.anthropology').show();
			$('.zoology').show();
		}
	});	
	
	$('[name="ca_objects.taxon_phyluum[]"]').change(function(){
		var phylum=$('[name="ca_objects.taxon_phylum[]"] option:selected').val().trim();
		
<?php		
		$sql1 = "SELECT distinct av.value_longtext1 
					FROM `ca_objects` o 
					LEFT JOIN ca_attributes a on a.table_num=57 and a.row_id = o.object_id 
					LEFT JOIN ca_attribute_values av on a.attribute_id = av.attribute_id 
					WHERE av.element_id=42  and o.object_id in ( 
						SELECT o.object_id FROM `ca_objects` o 
						LEFT JOIN ca_attributes a on a.table_num=57 and a.row_id = o.object_id 
						LEFT JOIN ca_attribute_values av on a.attribute_id = av.attribute_id 
						WHERE av.`value_longtext1` = '".$valphylum."' );";
		$q = $conn->prepare($sql1);
		$q->execute();
		$classes = $q->fetchAll();

		$i=0;
		foreach($classes as $class){
			$taxonclasses2[$i]= $class[0];
			$i++;
		}
		$incl="<select name=ca_objects.taxon_class[] id=ca_objects.taxon_class[]>";  
		foreach($taxonclasses2 as $taxonclass){
			$incl.="<option value=".$taxonclass.">".$taxonclass."</option>"; 
		}			
		$incl.="</select>";  
?>
		$('.taxonclass').html('<?php print $incl; ?>');
	});
	
	function reset() {
		document.getElementById("form").reset();
	 }
</script>