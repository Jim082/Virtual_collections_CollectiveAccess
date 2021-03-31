<?php
	$o_collections_config = $this->getVar("collections_config");
	$qr_collections = $this->getVar("collection_results");
?>
	<div class="row">
		<div class='col-md-12 col-lg-12 collectionsList'>
			<h1><?php print _t($this->getVar("section_name")); ?></h1>
			<p><?php print _t($o_collections_config->get("collections_intro_text")); ?></p>
			
			

<?php	
$va_access_values = $this->getVar("access_values");
$va_access_values = caGetUserAccessValues($this->request);
			$o_collections_config = $this->getVar("collections_config");
			$vb_collapse_levels = $o_collections_config->get("collapse_levels");
	$vn_i = 0;
	if($qr_collections && $qr_collections->numHits()) {
		print "<Table width='60%' style='margin-left:auto;margin-right:auto;'><TR>";
		while($qr_collections->nextHit()) {
			$vn_rel_object_count = sizeof($qr_collections->get("ca_objects.object_id", array("returnAsArray" => true, 'checkAccess' => $va_access_values)));
			if ( $vn_i == 0) { print "<div class='row'>"; } 
			print "<TD>";
			print "<div class=' overlay-image _b0 '><a href='/providence/pawtucket/index.php/detail/Collections/".$qr_collections->get("ca_collections.collection_id")."'>";
			print "<img class=' image _b1 ' src='/providence/pawtucket/themes/VirtualCollections/assets/pawtucket/graphics/".$qr_collections->get("ca_collections.idno").".jpg' alt='".$qr_collections->get("ca_collections.preferred_labels")."' />";
			print "<div class=' normal _b3 '>";
			print "<div class=' text _2 '>".$qr_collections->get("ca_collections.preferred_labels")."</div>";
			print "</div> <div class=' hover _b2 '>";
			print "<div class=' text2'>".$qr_collections->get("ca_collections.preferred_labels")." </BR><p style='white-space: pre-line'>".$qr_collections->get("ca_collections.description")."</p></div>";   
			#print "<div class=' text _2 '>".$qr_collections->get("ca_collections.preferred_labels")." </BR>Nbr specimens = ".$vn_rel_object_count." record".(($vn_rel_object_count == 1) ? "" : "s")."</div>";
			print "</div></a></div>";
			
			if (($o_collections_config->get("description_template")) && ($vs_scope = $qr_collections->getWithTemplate($o_collections_config->get("description_template")))) {
				print "<div>".$vs_scope."</div>";
			}
			print "</TD>";
			$vn_i++;
			if ($vn_i == 3) {
				print "</TR><TR>";
				
				$vn_i = 0;
			}
		}
		if (($vn_i < 3) && ($vn_i != 0) ) {
			print "</TR><TR>";
		}
		print "</TR></Table>";
	} else {
		print _t('No collections available');
	}
?>
		</div>
	</div>
