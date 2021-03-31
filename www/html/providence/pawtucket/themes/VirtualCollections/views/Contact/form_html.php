 <?php
	$o_config = caGetContactConfig();
	$va_errors = $this->getVar("errors");
	$vn_num1 = rand(1,10);
	$vn_num2 = rand(1,10);
	$vn_sum = $vn_num1 + $vn_num2;
	$vs_page_title = ($o_config->get("contact_page_title")) ? $o_config->get("contact_page_title") : _t("Contact");
	
	# --- if a table has been passed this is coming from the Item Inquiry/Ask An Archivist contact form on detail pages
	$pn_id = $this->request->getParameter("id", pInteger);
	$ps_table = $this->request->getParameter("table", pString);
	
	if($pn_id && $ps_table){
		$t_item = Datamodel::getInstanceByTableName($ps_table);
		if($t_item){
			$t_item->load($pn_id);
			$vs_url = $this->request->config->get("site_host").caDetailUrl($this->request, $ps_table, $pn_id);
			$vs_name = $t_item->get($ps_table.".preferred_labels.name");
			$vs_idno = $t_item->get($ps_table.".idno");
			$vs_page_title = ($o_config->get("item_inquiry_page_title")) ? $o_config->get("item_inquiry_page_title") : _t("Item Inquiry");
		}
	}
?>
<div class="row"><div class="col-sm-12">
	<H1><?php print $vs_page_title; ?></H1>
<?php
	if(is_array($va_errors["display_errors"]) && sizeof($va_errors["display_errors"])){
		print "<div class='alert alert-danger'>".implode("<br/>", $va_errors["display_errors"])."</div>";
	}
?>
	<form id="contactForm" action="<?php print caNavUrl($this->request, "", "Contact", "send"); ?>" role="form" method="post">
	    <input type="hidden" name="crsfToken" value="<?php print caGenerateCSRFToken($this->request); ?>"/>
<?php
	if($pn_id && $t_item->getPrimaryKey()){
?>
		<div class="row">
			<div class="col-sm-12">
				<p><b>Title: </b><?php print $vs_name; ?>
				<br/><b>Regarding this URL: </b><a href="<?php print $vs_url; ?>" class="purpleLink"><?php print $vs_url; ?></a>
				</p>
				<input type="hidden" name="itemId" value="<?php print $vs_idno; ?>">
				<input type="hidden" name="itemTitle" value="<?php print $vs_name; ?>">
				<input type="hidden" name="itemURL" value="<?php print $vs_url; ?>">
				<input type="hidden" name="id" value="<?php print $pn_id; ?>">
				<input type="hidden" name="table" value="<?php print $ps_table; ?>">
				<hr/><br/><br/>
	
			</div>
		</div>
<?php
	}
?>
		<div class="row">
			<div class="col-sm-12">
				<h3><?php print _t("About the Royal Museum for Central Africa"); ?></h3>
				<?php print _t("The Royal Museum for Central Africa must aspire to be a world centre of research and knowledge dissemination on past and present societies and natural environments of Africa, and in particular Central Africa, to foster – among the public at large and the scientific community – understanding of and interest in this area and, through partnerships, to contribute substantially to its sustainable development. Thus the core endeavours of this Africa-oriented institution consist of acquiring and managing collections, conducting scientific research, implementing the results of this research, disseminating knowledge, and mounting selected exhibitions of its collections."); ?>
				<br><br>
				<?php print _t("The AfricaMuseum is a centre for knowledge and resources on Africa, in particular Central Africa, in an historical, contemporary, and global context. The museum exhibits unique collections. It is a place of memory on the colonial past and strives to be a dynamic platform for exchanges and dialogues between cultures and generations."); ?></p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h3><?php print _t("Request for medias"); ?></h3>
				<?php print _t("For any request for a high resolution photo or other media, please use the contact form below or contact the curator concerned directly (<a href='https://www.africamuseum.be/en/research/collections_libraries' target='_blank'>Collections</a>)."); ?>
			</div>
		</div>
		<div class="row">
		<div class = 'wrapper'>
			<table margin="20px">
				<tr>
					<td width="20%">
						<h6>&nbsp;</h6>
						<b><?php print _t("Address"); ?>:</b><br>Leuvensesteenweg 13<br>3080 Tervuren<br>Belgium<br><br>
						<b><?php print _t("Phone"); ?>:</b><br>+32 2 769 52 11<br>
						<b>Email:</b><br> <a href="mailto:info@africamuseum.be">info@africamuseum.be</a><br><br>
						<b><?php print _t("Belgian company registration number"); ?>:</b><br> BE 0306.562.560
					</td>
					<td width="40%">
						<iframe allowfullscreen="" frameborder="0" height="300" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2520.013763465616!2d4.5161053157119!3d50.83090897952964!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c3d94ffaa0d669%3A0x9d938a1bf2a3652a!2sRoyal%20Museum%20for%20Central%20Africa!5e0!3m2!1sen!2sbe!4v1575376502843!5m2!1sen!2sbe" style="border:0;" width="100%"></iframe>
					</td>
					<td width="40%">
							<img alt="site map" data-entity-type="" data-entity-uuid="" src="/providence/pawtucket/themes/VirtualCollections/assets/pawtucket/graphics/site_map.jpg" class="align-center" width='100%'/>
						<ul>
							<li><?php print _t("A - Welcome Pavilion"); ?></li>
							<li><?php print _t("B - Museum Building"); ?></li>
							<li><?php print _t("C - Director's Pavilion"); ?></li>
							<li><?php print _t("D - Stanley Pavilion"); ?></li>
							<li><?php print _t("E - CAPA Building"); ?></li>
							<li><?php print _t("F - Finances Building"); ?></li>
							<li><?php print _t("G - Africa Palace (former Colonial Palace)"); ?></li>
							<li>H - Villa</li>
						</ul>
					</td>
				</tr>
			</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-9">
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group<?php print (($va_errors["name"]) ? " has-error" : ""); ?>">
							<label for="name"><?php print _t("Name"); ?></label>
							<input type="text" class="form-control input-sm" id="email" placeholder="Enter name" name="name" value="{{{name}}}">
						</div>
					</div><!-- end col -->
					<div class="col-sm-4">
						<div class="form-group<?php print (($va_errors["email"]) ? " has-error" : ""); ?>">
							<label for="email"><?php print _t("Email address"); ?></label>
							<input type="text" class="form-control input-sm" id="email" placeholder="Enter email" name="email" value="{{{email}}}">
						</div>
					</div><!-- end col -->
					<div class="col-sm-4">
						<div class="form-group<?php print (($va_errors["security"]) ? " has-error" : ""); ?>">
							<label for="security"><?php print _t("Security Question"); ?></label>
							<div class='row'>
								<div class='col-sm-6'>
									<p class="form-control-static"><?php print $vn_num1; ?> + <?php print $vn_num2; ?> = </p>
								</div>
								<div class='col-sm-6'>
									<input name="security" value="" id="security" type="text" class="form-control input-sm" />
								</div>
							</div><!--end row-->	
						</div><!-- end form-group -->
					</div><!-- end col -->
				</div><!-- end row -->
			</div><!-- end col -->
		</div><!-- end row -->
		<div class="row">
			<div class="col-md-9">
				<div class="form-group<?php print (($va_errors["message"]) ? " has-error" : ""); ?>">
					<label for="message"><?php print _t("Message"); ?></label>
					<textarea class="form-control input-sm" id="message" name="message" rows="5">{{{message}}}</textarea>
				</div>
			</div><!-- end col -->
		</div><!-- end row -->
		<div class="form-group">
			<button type="submit" class="btn btn-default"><?php print _t("Send"); ?></button>
		</div><!-- end form-group -->
		<input type="hidden" name="sum" value="<?php print $vn_sum; ?>">
	</form>
	
</div><!-- end col --></div><!-- end row -->