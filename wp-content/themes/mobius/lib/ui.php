<?php
	if ( !class_exists('pageMeta') ) {
		class pageMeta {
		var $prefix = '_st_';
		var $pagemeta =	array(
		// Layout Boxes
			//array(
			//	"name"			=> "layout_box",
			//	"title"			=> "Sidebar Layout",
			//	"type"			=> "layoutbox",
			//	"default"		=> "0",
			//	"desc"      	=> "Select a Layout Style.",
			//	"scope"			=>	array( "post","page" ),
			//	"radiolabel" 	=> 	array( "Left","Right","Wide"),
			//	"radiovalue" 	=> 	array( "left","right","wide"),
			//	"radioclass" 	=> array("l","r","w"),
			//	"capability"	=> "edit_post"
			//),

			// Slide Type
			array(
				"name"			=> "slide_type",
				"title"			=> "Slide Type",
				"type"			=> "radio",
				"default"		=> "0",
				"desc"      	=> "Select a Slide layout above, then assign the image to the slide from the 'Featured Image' panel.",
				"scope"			=>	array( "slide" ),
				"radiovalue" 	=> 	array( "Thumbnail Left","Thumbnail Right","Full Size Image","No Image" ),
				"capability"	=> "edit_post"
			),

			// Slider Thumbnail Sizes
			array(
				 "name"			=> "slide_thumb_size",
				 "title"		=> "Slide Thumbnail Size",
				 "desc"	=> "Thumbnail 'Width' or 'Width x Height' e.g; 200x125",
				 "type"			=> "text",
				 "scope"		=>	array("slide"),
				 "capability"	=> "edit_pages"
			),

			/// Slide meta
			array(
				"name"			=> "customexcerpt",
				"title"			=> "Slide Text",
				"desc"			=> "Text to be displayed in the slide (when no-image or thumbnail modes is selected below)",
				"type"			=> "editor",
				"scope"			=>	array("slide"),
				"capability"	=> "edit_pages"
			),


		// Slide Link Text
		 array(
		 		"name"			=> "customurlname",
		 		"title"			=> "Button text",
		 		"desc"			=> "Text for the button",
		 		"type"			=> "text",
		 		"scope"			=>	array("slide"),
		 		"capability"	=> "edit_pages"
		 	),

		// Slide Link
		array(
				"name"			=> "customurl",
				"title"			=> "Button URL / link",
				"desc"			=> "The url you want the button/image to link to",
				"type"			=> "text",
				"scope"			=>	array( "slide" ),
				"capability"	=> "edit_pages"
			),
		// Slide Link Target
		array(
			"name"			=> "slide_linktarget",
			"title"			=> "Link Target",
			"type"			=> "radio",
			"default"		=> "0",
			"desc"      	=> "Window to open links (if specified)",
			"scope"			=>	array( "slide" ),
			"radiovalue" 	=> 	array( "Same Window","New Window" ),
			"capability"	=> "edit_post"
			),
		// Slide Caption
		array(
			"name"			=> "slide_caption",
			"title"			=> "Slide Caption",
			"desc"			=> "Short caption to be displayed below (leave blank for none)",
			"type"			=> "text",
			"scope"			=>	array( "slide" ),
			"capability"	=> "edit_pages"
			),
		array(
			"name"			=> "show_title",
			"title"			=> "Show Title",
			"desc"			=> "Displays the title in the slide.",
			"type"			=> "checkbox",
			"scope"			=>	 array("slide"),
			"capability"	=> "edit_post"
			),
		);
		/**
		* PHP 4 Compatible Constructor
		*/
		function pageMeta() { $this->__constructPageMeta(); }
		/**
		* PHP 5 Constructor
		*/
		function __constructPageMeta() {
			add_action( 'admin_menu', array( &$this, 'createPageCustomFields' ) );
			add_action( 'save_post', array( &$this, 'savePageCustomFields' ), 1, 2 );
			// Comment this line out if you want to keep default custom fields meta box
			//add_action( 'do_meta_boxes', array( &$this, 'removeDefaultCustomFields' ), 10, 3 );
		}
		/**
		* Remove the default Custom Fields meta box
		*/
		function removeDefaultCustomFields( $type, $context, $post ) {
			foreach (array( 'normal', 'advanced', 'side' ) as $context ) {
				remove_meta_box( 'postcustom', 'post', $context );
				remove_meta_box( 'postcustom', 'page', $context );
				//Use the line below instead of the line above for WP versions older than 2.9.1
				//remove_meta_box( 'pagecustomdiv', 'page', $context );
			}
		}
		/**
		* Create the new Custom Fields meta box
		*/
		function createPageCustomFields() {
			if ( function_exists( 'add_meta_box' ) ) {
				//add_meta_box( 'page-custom-fields', 'Post Layout Options', array( &$this, 'displayPageCustomFields' ), 'post', 'normal', 'high' );
				//add_meta_box( 'page-custom-fields', 'Page Layout Options', array( &$this, 'displayPageCustomFields' ), 'page', 'normal', 'high' );
				add_meta_box( 'page-custom-fields', 'Slide Options', array( &$this, 'displayPageCustomFields' ), 'slide', 'normal', 'high' );
			}
		}
		/**
		* Display the new Custom Fields meta box
		*/
		function displayPageCustomFields() {
			global $post;
		?>

		<div class="form-wrap" >
			<?php
				wp_nonce_field( 'page-custom-fields','page-custom-fields_wpnonce', false, true );
				foreach ( $this->pagemeta as $customField ) {
					// Check scope
					$scope = $customField['scope'];
					$output = false;

					foreach ( $scope as $scopeItem ) {
						switch ( $scopeItem ) {
							case "post": {
								// Output on any post screen
								if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php?" || $post->post_type=="post" )
									$output = true;
								break;
							}
							case "news": {
								// Output on any post screen
								if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php?post_type=news" || $post->post_type=="news" )
									$output = true;
								break;
							}
							case "event": {
								// Output on any post screen
								if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php?post_type=events" || $post->post_type=="events" )
									$output = true;
								break;
							}

							case "slide": {
								// Output on any post screen
								if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php?post_type=slide" || $post->post_type=="slide" )
									$output = true;
								break;
							}
							case "testimonial": {
								// Output on any post screen
								if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php?post_type=testimonial" || $post->post_type=="testimonial" )
									$output = true;
								break;
							}
							case "portfolio": {
								// Output on any post screen
								if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php?post_type=phiportfolio" || $post->post_type=="phiportfolio" )
									$output = true;
								break;
							}
							case "page": {
								// Output on any page screen
								if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php?post_type=page" || $post->post_type=="page" )
									$output = true;
								break;
							}
						}
						if ($output) break;
					}


					// Check capability
					if ( !current_user_can( $customField['capability'], $post->ID ) )
						$output = false;
					// Output if allowed
					if ( $output ) { ?>
						<div id="<?php echo $customField[ 'name' ];?>" class="form-field form-required">
						<div style="float:none; clear:none; background:">
						<?php
							switch ( $customField[ 'type' ] ) {



								case "infopanel": {
								echo '<div class="section-info basic">';
								echo '<h4 style="font-size:13px; margin:0 0 12px 0; clear:left;">'. $customField['title'].'</h4>';
								echo $customField ['desc'];
								echo '</div>';
								break;
								}

								case "editor": {
								$content = get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true );
								$id = $this->prefix.$customField['name'];
								$settings = array('wpautop' => false,'teeny'=> true,'textarea_rows' => 4);
								echo '<div class="section-info basic">';
								wp_editor($content,$id,$settings);
								echo '</div>';
								break;
								}

								case "radio": {
									// Radiobutton
									echo '<h4 style="font-size:13px; margin:0 0 12px 0; clear:left;">'. $customField['title'].'</h4>';

									//if ($customField[ 'desc']) {
									//	echo '<p>' . $customField[ 'desc' ] . '</p>';
									//}

									foreach ($customField['radiovalue'] as $radiovalue => $radiolabel) {
										echo '<div class="'.$customField[ 'type' ].'">';
										//echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="">' . $radiolabel . '</label>';
										echo '<label name="'.$this->prefix.$customField['name'].'">' . $radiolabel . '<input type="radio"  name="'.$this->prefix.$customField['name'].'" id="'.$this->prefix.$customField['name'].'" value="'.$this->prefix.$radiovalue. '"';
										if (get_post_meta($post->ID, $this->prefix.$customField['name'], true ) == $this->prefix .$radiovalue ){
										echo ' checked="checked"';
										}
										elseif(get_post_meta($post->ID, $this->prefix . $customField['name'], true ) == '' && $customField['default'] == $radiovalue){
										echo ' checked="checked"';
										}
										echo '/></label>';
										//echo get_post_meta( $post->ID, $this->prefix . $customField['name'],true);
										echo '</div>';
									}
									echo '<div style="clear:both;"></div>';
									break;
								}

								//	case "layoutbox": {
								//		// Layout Boxes
								//		echo '<h4 style="font-size:13px; margin:0 0 12px 0; clear:left;">'. $customField['title'].'</h4>';
								//		echo '<div id="st_cols">';

								//		$name 		= $customField['name'];
								//		$label 		= $customField['radiolabel'];
								//		$value 		= $customField['radiovalue'];
								//		$class 		= $customField['radioclass'];
								//		$default 	= of_get_option('page_layout');

								//		for($i = 0,$c=count($label);$i < $c;$i++) {
								//			echo '<div class="st_col_'.$class[$i].'">';
								//			echo '<input type="radio" name="'.$this->prefix.$name.'" id="'.$this->prefix.$name.'" value="'.$value[$i].'"';
								//			if (get_post_meta($post->ID, $this->prefix.$name, true ) == $value[$i] ){
								//				echo ' checked="checked"';
								//			}
								//			elseif (get_post_meta($post->ID, $this->prefix.$name, true ) == '' && $value[$i] == $default){
								//				echo ' checked="checked"';
								//			}
								//			echo '/>';
								//			echo '<label for="'.$this->prefix.$name.'">'.$label[$i].'</label>';
								//			echo'</div>';
								//		}
								//		echo '<div style="clear:both;"></div></div>';
								//		break;
								//	}


								case "checkbox": {
									// Checkbox
									echo '<div style="clear:both; margin:4px 0;">';
									echo '<input type="checkbox"  name="' . $this->prefix . $customField['name'] . '" id="' . $this->prefix . $customField['name'] . '" value="yes"';
									if ( get_post_meta( $post->ID, $this->prefix . $customField['name'], true ) == "yes" )
										echo ' checked="checked"';
									echo '" style="width: auto;" />';
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline; margin-left:4px; padding:0;">' . $customField[ 'title' ] . '</label>';
									echo'</div>';
									break;
								}

								case "html": {
									// Description field
									break;
								}

								case "textarea": {
									// Text area
									echo '<div style="clear:both; margin:0 0 8px;">';
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									echo '<textarea name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" columns="30" rows="3">' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '</textarea>';
									echo'</div>';
									break;
								}

								case "textnarrow": {
									// Plain text field
									echo '<div style="clear:both; width:200px; margin:0 20px 10px 0; float:left; clear:left;">';
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									echo '<input type="text" name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" value="' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '" />';
									echo'</div>';
									break;
								}
								default: {
									// Plain text field
									echo '<div style="clear:both; margin:4px 0;">';
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									echo '<input type="text" name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" value="' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '" />';
									echo'</div>';

									break;
								}
							}
							?>
							<?php if ($customField[ 'desc' ] ) echo '<p style="clear:left;">' . $customField[ 'desc' ] . '</p>'; ?>
						</div>
					</div>
					<?php
				}
			} ?>
			</div>
			<?php	}
			/*
			Save the new Custom Fields values
			*/
			function savePageCustomFields( $post_id, $post ) {
				if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
				    return;
				}
				else
				{
					if (isset($_POST[ 'page-custom-fields_wpnonce'])) {
						if ( !wp_verify_nonce( $_POST[ 'page-custom-fields_wpnonce' ], 'page-custom-fields' ) ) {
							return $postID;
						}
					}
					if ( !current_user_can( 'edit_post', $post_id ) ) {
						return;
					}
					foreach ( $this->pagemeta as $customField ) {
						if (current_user_can( $customField['capability'], $post_id ) ) {
							if ( isset( $_POST[ $this->prefix . $customField['name'] ] ) && trim( $_POST[ $this->prefix . $customField['name'] ] ) ) {
								update_post_meta( $post_id, $this->prefix . $customField[ 'name' ], $_POST[ $this->prefix . $customField['name'] ] );
							} else {
								delete_post_meta( $post_id, $this->prefix . $customField[ 'name' ] );
							}
						}
					}
				}
			}
		} // End Class
	} // End if class exists statement
	// Instantiate the class
	if ( class_exists('pageMeta') ) {
		$pageMeta_var = new pageMeta();
	}