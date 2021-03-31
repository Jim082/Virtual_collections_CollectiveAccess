<?php
    header('Content-Type: application/json');
	$BASE_URL="https://virtualcol.africamuseum.be/proxy_iiif/proxy_ca_iiif_manifest.php";
	try {
			$uuid=$_REQUEST["uuid"];
			$servername = 'localhost';
            $username = 'vcadmin';
            $password = 'vcadmin@MRAC';
			$db="virtual_collections";
            //On établit la connexion
            $pdo = new PDO("mysql:host=".$servername.";dbname=".$db, $username, $password);
            
            
           
			$stm=$pdo->prepare("SELECT object_id, representation_id as image_id FROM v_uuid_pic_numbers where uuid=:uuid");
			
			$stm->bindParam(":uuid", $uuid,PDO::PARAM_STR);
			$stm->execute();
			$res=$stm->fetch(PDO::FETCH_ASSOC);
			
			$ch = curl_init( );
			curl_setopt($ch, CURLOPT_URL,$BASE_URL);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($res));
			#curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			
			# Send request.
			$response = curl_exec($ch);
			
			curl_close($ch);
			print($response);
			
		} 
		catch (PDOException $e) 
		{
			echo 'Connection failed: ' . $e->getMessage();
		}
?>