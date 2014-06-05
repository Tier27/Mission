<?php
	// EventON Settings tab - Addons and licenses
	// version: 0.2
?>
<div id="evcal_4" class="postbox evcal_admin_meta">	
	<?php

		// UPDATE eventon addons list
			$eventon->evo_updater->ADD_update_addons();

	?>

	<div class='evo_addons_page addons'>
		<?php
			$admin_url = admin_url();
			$show_license_msg = true;

			// REMOVE license
			if(isset($_GET['lic']) && $_GET['lic']=='remove'){
				//delete_option('_evo_licenses');
				$xx = $eventon->evo_updater->remove_license();
			}

			$evo_licenses =get_option('_evo_licenses');

			// running for the first time
			if(empty($evo_licenses)){
				
				$lice = array(
					'eventon'=>array(
						'name'=>'EventON',
						'current_version'=>$eventon->version,
						'type'=>'plugin',
						'status'=>'inactive',
						'key'=>'',
					));
				update_option('_evo_licenses', $lice);
				
				$evo_licenses = get_option('_evo_licenses');				
			}

			$evo_data = $evo_licenses['eventon'];
			

			//$eventon->evo_updater->ADD_deactivate_lic('eventon-action-user');
			//print_r($evo_licenses);

			// ACTIVATED
			if($evo_data['status']=='active'):
				$_has_update = (!empty($evo_data['has_new_update']) && $evo_data['has_new_update'])? true:false;
				$new_update_details_btn = ($_has_update)?
					"<p class='links'><b>".__('New Update availale','eventon')."</b><br/><a href='".$admin_url."update-core.php'>Update Now</a> | <a class='thickbox' href='".BACKEND_URL."plugin-install.php?tab=plugin-information&plugin=eventon&section=changelog&TB_iframe=true&width=600&height=400'>Version Details</a></p>":null;

				?>
					<div class="addon main activated <?php echo ($_has_update)? 'hasupdate':null;?>">
						<h2>EventON</h2>
						<p class='version'><?php echo $evo_data['current_version'];?><span>/<?php echo $evo_data['remote_version'];?></span></p>
						<p>License Status: <strong>Activated</strong></p>
						<p class='action'><?php echo $new_update_details_btn;?></p>
					</div>
				<?php 
				// NOT ACTIVATED
				else:
				?>
				<div id='evo_license_main' class="addon main">
					<h2>EventON</h2>
					<p class='version'><?php echo $evo_data['current_version'];?><span>/<?php echo $evo_data['remote_version'];?></span></p>
					<p class='status'>License Status: <strong>Not Activated</strong></p>
					<p class='action'><a class='eventon_popup_trig evo_admin_btn btn_prime' dynamic_c='1' content_id='eventon_pop_content_001' poptitle='Activate EventON License'>Activate Now</a></p>
					<p class='activation_text'>Activate your copy of EventON to get free automatic plugin updates direct from your site!</p>

						<div id='eventon_pop_content_001' class='evo_hide_this'>
							<p>Your codecanyon Purchase Key:<br/>
							<input class='eventon_license_key_val' type='text' style='width:100%'/>
							<input class='eventon_slug' type='hidden' value='eventon' />
							<input class='eventon_license_div' type='hidden' value='evo_license_main' /><br/><i>More information on <a href='http://www.myeventon.com/documentation/how-to-find-eventon-license-key/' target='_blank'>How to find eventON purchase key</a></i></p>
							<p><a class='eventon_submit_license evo_admin_btn btn_prime'>Activate Now</a></p>
						</div>
				</div>
			<?php

			endif;
		?>

		<?php // ADDONS 

			$evo_installed_addons ='';
			$count =1;
			$eventon_addons_opt = get_option('eventon_addons');

			//print_r($eventon_addons_opt);
			
			global $wp_version; 

			// GET remote content
				$blog_url = get_bloginfo('url');
				$url = 'http://update.myeventon.com/addons.php';	
				
				$response = wp_remote_post(
		            $url,
		            array(
		                'body' => array(
		                    'action'     => 'evo_get_addons',
		                    'api-key' => md5($blog_url)
		                ),
		                'user-agent' => 'WordPress/' . $wp_version . '; ' . $blog_url
		            )
		        );

		        // BACK UP solution
		        if(is_wp_error( $response )){
		        	$url_backup = AJDE_EVCAL_URL.'/admin/includes/addon_details.php';
		        	$response = wp_remote_post(
			            $url_backup,
			            array(
			                'body' => array(
			                    'action'     => 'evo_get_addons',
			                    'api-key' => md5($blog_url)
			                ),
			                'user-agent' => 'WordPress/' . $wp_version . '; ' . $blog_url
			            )
			        );
		        }

	        if ( !is_wp_error( $response ) ) {

	        	$request = unserialize($response['body']);

	        	if(!empty($request)){
					
					// installed addons
					if(!empty($eventon_addons_opt) and count($eventon_addons_opt)>0 ){
						foreach($eventon_addons_opt as $tt=>$yy){
							$evo_installed_addons[]=$tt;
						}
					}else{	$evo_installed_addons=false;	}
		
					
					// EACH ADDON
					foreach($request as $slug=>$addons){

						// Check if addon is installed in the website
						$_has_addon = ($evo_installed_addons && in_array($slug, $evo_installed_addons))?true:false;
						if($_has_addon){
							$_addon_options_array = $eventon_addons_opt[(string)$slug];				
						}
						
						
							$guide = ($_has_addon && !empty($_addon_options_array['guide_file']) )? "<span class='eventon_guide_btn eventon_popup_trig' ajax_url='{$_addon_options_array['guide_file']}' poptitle='How to use {$addons['name']}'>Guide</span> | ":null;
							
							$__action_btn = (!$_has_addon)? "<a class='evo_admin_btn btn_secondary' target='_blank' href='". $addons['download']."'>Get it now</a>": "<a class='eventon_popup_trig evo_admin_btn btn_prime' dynamic_c='1' content_id='eventon_pop_content_{$slug}' poptitle='Activate {$addons['name']} License'>Activate Now</a>";

							$__remote_version = (!empty($evo_licenses[$slug]['remote_version']))? '<span title="Remote server version"> /'.$evo_licenses[$slug]['remote_version'].'</span>': null;

							$_has_update = (!empty($evo_licenses[$slug]['has_new_update']) && $evo_licenses[$slug]['has_new_update'])? true:false;
							$_ADD_new_update_details_btn = ($_has_update)?
								"<p class='links'><b>".__('New Update availale','eventon')."</b><br/><a href='".$admin_url."update-core.php'>Update Now</a> | <a class='thickbox' href='".BACKEND_URL."plugin-install.php?tab=plugin-information&plugin={$slug}&section=changelog&TB_iframe=true&width=600&height=400'>Version Details</a></p>":null;
							
						
						// ACTIVATED
						if(!empty($evo_licenses[$slug]['status']) && $evo_licenses[$slug]['status']=='active' && $_has_addon):
						
						?>
							<div id='evoaddon_<?php echo $slug;?>' class="addon activated <?php echo ($_has_update)? 'hasupdate':null;?>">
								<h2><?php echo $addons['name']?></h2>
								<p class='version'><span><?php echo $eventon_addons_opt[$slug]['version']?></span><?php echo $__remote_version;?></p>
								<p class='status'>License Status: <strong>Activated</strong></p>
								<p class="links"><?php echo $guide;?><a href='<?php echo $addons['link'];?>' target='_blank'>Learn More</a></p>
								<?php echo $_ADD_new_update_details_btn;?>
							</div>
						
						<?php	
							// NOT ACTIVATED
							else:
						?>
							<div id='evoaddon_<?php echo $slug;?>' class="addon <?php echo (!$_has_addon)?'donthaveit':null;?>">
								<h2><?php echo $addons['name']?></h2>
								<?php if(!empty($eventon_addons_opt[$slug])):?><p class='version'><span><?php echo $eventon_addons_opt[$slug]['version']?></span><?php echo $__remote_version;?></p><?php endif;?>
								<p class='status'>License Status: <strong>Not Activated</strong></p>
								<p class='action'><?php echo $__action_btn;?></p>
								<p class="links"><?php echo $guide;?><a href='<?php echo $addons['link'];?>' target='_blank'>Learn More</a></p>
								<p class='activation_text'></p>
									<div id='eventon_pop_content_<?php echo $slug;?>' class='evo_hide_this'>
										<p>Addon License Key <br/>
										<input class='eventon_license_key_val' type='text' style='width:100%'/>
										<input class='eventon_slug' type='hidden' value='<?php echo $slug;?>' />
										<input class='eventon_id' type='hidden' value='<?php echo $addons['id'];?>' />
										<input class='eventon_license_div' type='hidden' value='evoaddon_<?php echo $slug;?>' /></p>
										<p>Email Address used <span class='evoGuideCall'>?<em>This must be the email address you used to order eventon addon from myeventon.com</em></span><br/><input class='eventon_email_val' type='text' style='width:100%'/></p>
										<p><a class='eventonADD_submit_license evo_admin_btn btn_prime'>Activate Now</a></p>
									</div>
							</div>
						<?php		
							endif;

							$count++;
					}
				}


				// notice
				echo "<div class='clear'></div><p><i><b>NOTE:</b> if you are not able to activate eventon or its addons please try again later as the activation server may be overloaded. </i></p>";


			}else{
				// WRITE backup xml file loading for addon

	        	echo "<p>WordPress is unable to access remote server to get content. Connection time out. Please check your server for cURL accessibility.</p>";
	        	$error_string = $response->get_error_message();
	  			echo '<div id="message" class="error"><p>' . $error_string . '</p></div>';
	  		}

		?>
		
		<div class="clear"></div>
	</div>


	
	
	
	<?php
		// Throw the output popup box html into this page
		echo $eventon->output_eventon_pop_window(array('content'=>'Loading...', 'type'=>'padded'));
	?>
</div>