<div class="crypto-edit">
	<div class="crypto-options">

        <?php
            $crypto_ticker = ($crypto_ticker == '') ? 'ticker' : $crypto_ticker;
            $crypto_ticker_position = ($crypto_ticker_position == '') ? 'header' : $crypto_ticker_position;
        ?>
	
		<div class="crypto-rows">
			<div class="crypto-cols crypto-labels">
				<label for="crypto_title"><?php _e('Widget Title','cryptocurrency-widgets-pack'); ?></label>
			</div>
			<div class="crypto-cols">
				<input type="text" class="selectize-input post-title" name="post_title" id="title" value="<?php echo esc_attr(get_the_title());?>" />
			</div>
		</div>
		<div class="widget-type">

			<div class="crypto-rows">
				<div class="crypto-cols crypto-labels">
					<label for="crypto_ticker"><?php _e('Widget Type','cryptocurrency-widgets-pack'); ?></label>
				</div>
				<div class="crypto-cols">
					<label for="crypto_ticker1" class="form-radio">
						<input type="radio" class="beaut-radio" name="crypto_ticker" id="crypto_ticker1" value="ticker" <?php if ($crypto_ticker == 'ticker') { echo 'checked'; } ?> /><i class="form-icon"></i><?php _e('Ticker','cryptocurrency-widgets-pack'); ?>
					</label>
					<label for="crypto_ticker2" class="form-radio">
						<input type="radio" class="beaut-radio" name="crypto_ticker" id="crypto_ticker2" value="table" <?php if ($crypto_ticker == 'table') { echo 'checked'; } ?> /><i class="form-icon"></i><?php _e('Table','cryptocurrency-widgets-pack'); ?>
					</label>
					<label for="crypto_ticker4" class="form-radio">
						<input type="radio" class="beaut-radio" name="crypto_ticker" id="crypto_ticker4" value="card" <?php if ($crypto_ticker == 'card') { echo 'checked'; } ?> /><i class="form-icon"></i><?php _e('Card','cryptocurrency-widgets-pack'); ?>
					</label>
					<label for="crypto_ticker5" class="form-radio">
						<input type="radio" class="beaut-radio" name="crypto_ticker" id="crypto_ticker5" value="label" <?php if ($crypto_ticker == 'label') { echo 'checked'; } ?> /><i class="form-icon"></i><?php _e('Label','cryptocurrency-widgets-pack'); ?>
					</label>
					<label class="form-radio" style="padding: .2rem 0 .2rem 1.3rem;">
						<div class="img-pro prodemo">
							<a target="_blank" href="https://massivecryptopro.blocksera.com"><?php _e('Pro','cryptocurrency-widgets-pack'); ?></a>
							<img style="width: auto;" src="<?php echo MCWP_URL.'assets/pro-settings/chart-unchecked.png'; ?>" data-name="chart	" />
						</div>
					</label>
					<label class="form-radio" style="padding: .2rem 0 .2rem 1.3rem;">
						<div class="img-pro prodemo" style="margin-right: -10px;">
							<a target="_blank" href="https://massivecryptopro.blocksera.com"><?php _e('Pro','cryptocurrency-widgets-pack'); ?></a>
							<img style="width: auto;" src="<?php echo MCWP_URL.'assets/pro-settings/converter-unchecked.png'; ?>" data-name="converter	" />
						</div>
					</label>
					<label class="form-radio" style="padding: .2rem 0 .2rem 1.3rem;margin-top:0;">
						<div class="img-pro prodemo" style="margin-left: -19px;">
							<a target="_blank" href="https://massivecryptopro.blocksera.com"><?php _e('Pro','cryptocurrency-widgets-pack'); ?></a>
							<img style="width: auto;" src="<?php echo MCWP_URL.'assets/pro-settings/list-unchecked.png'; ?>" data-name="list	" />
						</div>
					</label>
					<label class="form-radio" style="padding: .2rem 0 .2rem 1.3rem;margin-top:0;">
						<div class="img-pro prodemo" style="margin-left: -18px;">
							<a target="_blank" href="https://massivecryptopro.blocksera.com"><?php _e('Pro','cryptocurrency-widgets-pack'); ?></a>
							<img style="width: auto;" src="<?php echo MCWP_URL.'assets/pro-settings/box-unchecked.png'; ?>" data-name="box	" />
						</div>
					</label>
					<label class="form-radio" style="padding: .2rem 0 .2rem 1.3rem;margin-top:0;">
						<div class="img-pro prodemo" style="margin-left: -18px;">
							<a target="_blank" href="https://massivecryptopro.blocksera.com"><?php _e('Pro','cryptocurrency-widgets-pack'); ?></a>
							<img style="width: auto;" src="<?php echo MCWP_URL.'assets/pro-settings/text-unchecked.png'; ?>" data-name="text	" />
						</div>
					</label>
				</div>
			</div>
		</div>
		
		<div class="crypto-rows">
			<div class="crypto-cols crypto-labels">
				<label for="crypto_ticker_coin"><?php _e('Coins','cryptocurrency-widgets-pack'); ?><a class="removecoins" style="float: right;"><?php _e('Clear','cryptocurrency-widgets-pack'); ?></a></label>
			</div>
			<div class="crypto-cols">
				<select id="select-beast" name="crypto_ticker_coin[]" multiple class="demo-default" placeholder="<?php _e('Select a Cryptocurrency Coin','cryptocurrency-widgets-pack'); ?>">
					<option value=""><?php _e('Select a Cryptocurrency Coin','cryptocurrency-widgets-pack'); ?></option>
					<?php
                    $mcwp_coinsyms = $this->mcwp_coinsyms();
					$mcwp_cid = $mcwp_coinsyms['cid'];
					$mcwp_names = $mcwp_coinsyms['names'];
					for($i = 0; $i < sizeof($mcwp_cid); $i++){ ?>
                        <option value="<?php echo esc_attr($mcwp_cid[$i]); ?>"<?php if($crypto_ticker_coin != ''){if(is_array($crypto_ticker_coin) && in_array($mcwp_cid[$i],$crypto_ticker_coin)){echo " selected";}} ?>><?php echo $mcwp_names[$i]; ?></option>
					<?php } ?>
				</select>
			</div>
            <br><br>
            <div class="crypto-cols crypto-toggle ticker-position table-position converter-position<?php if ($crypto_ticker !== 'ticker' && $crypto_ticker !== 'table') { echo ' cc-hide'; } ?>">
				<?php _e('or show top','cryptocurrency-widgets-pack'); ?> <select name="crypto_bunch_select" class="selectize-select" style="width: 10ch;">
                    <option value=""<?php if (intval($crypto_bunch_select) == "0") { echo ' selected'; } ?>></option>
                    <option value="10"<?php if (intval($crypto_bunch_select) == "10") { echo ' selected'; } ?>>10</option>
                    <option value="50"<?php if (intval($crypto_bunch_select) == "50") { echo ' selected'; } ?>>50</option>
                    <option value="100"<?php if (intval($crypto_bunch_select) == "100") { echo ' selected'; } ?>>100</option>
                    <option value="200"<?php if (intval($crypto_bunch_select) == "200") { echo ' selected'; } ?>>200</option>
                    <option value="500"<?php if (intval($crypto_bunch_select) == "500") { echo ' selected'; } ?>>500</option>
                    <option value="1000"<?php if (intval($crypto_bunch_select) == "1000") { echo ' selected'; } ?>>1000</option>
                    <option value="2000"<?php if (intval($crypto_bunch_select) == "2000") { echo ' selected'; } ?>><?php echo sizeof($mcwp_cid); ?></option>
                </select> <?php _e('coins','cryptocurrency-widgets-pack'); ?>
            </div>
		</div>
		<?php if(get_option('mcwp-notice') && get_option('mcwp-notice') != 0) { ?>
			<div class="crypto-rows mcwp-rate">
				<div class="crypto-cols crypto-labels">
					<div><?php _e('Thank you for installing our plugin. We hope you will like it very much. Would you rate this plugin 5 stars? It will help us a lot !!!','cryptocurrency-widgets-pack'); ?></div>
					<div class="mcwp-rate-button">
						<span class="mcwp-rate-close"><?php _e("I'll Rate Later",'cryptocurrency-widgets-pack'); ?></span>
						<a target="_blank" href="https://wordpress.org/support/plugin/cryptocurrency-widgets-pack/reviews/#new-post"><?php _e("Sure, I'll Rate",'cryptocurrency-widgets-pack'); ?></a>
					</div>
				</div>
			</div>
		<?php } ?>

		<div class="crypto-rows ticker-position<?php if ($crypto_ticker !== 'ticker') { echo ' cc-hide'; } ?>">
		
			<div class="crypto-cols crypto-labels">
				<label for="crypto_ticker_position"><?php _e('Ticker Position','cryptocurrency-widgets-pack'); ?></label>
			</div>
			<div class="crypto-cols no-padding">
				<div class="ticker-header">
					<label for="crypto_ticker_position1" class="form-radio">
						<input type="radio" class="beaut-radio" name="crypto_ticker_position" id="crypto_ticker_position1" value="header" <?php if ($crypto_ticker_position == 'header') { echo 'checked'; } ?> /><img src="<?php echo MCWP_URL; ?>assets/admin/cards/card1<?php if ($crypto_ticker_position == 'header') { echo 'hover'; } ?>.png">
					</label>
				</div>
				<div class="ticker-header">
					<label for="crypto_ticker_position2" class="form-radio">
						<input type="radio" class="beaut-radio" name="crypto_ticker_position" id="crypto_ticker_position2" value="footer" <?php if ($crypto_ticker_position == 'footer') { echo 'checked'; } ?> /><img src="<?php echo MCWP_URL; ?>assets/admin/cards/card2<?php if ($crypto_ticker_position == 'footer') { echo 'hover'; } ?>.png">
					</label>
				</div>
				<div class="ticker-header">
					<label for="crypto_ticker_position3" class="form-radio">
						<input type="radio" class="beaut-radio" name="crypto_ticker_position" id="crypto_ticker_position3" value="same" <?php if ($crypto_ticker_position == 'same') { echo 'checked'; } ?> /><img src="<?php echo MCWP_URL; ?>assets/admin/cards/card3<?php if ($crypto_ticker_position == 'same') { echo 'hover'; } ?>.png">
					</label>
				</div>
			</div>
		</div>
		<div class="crypto-rows ticker-position <?php if(($crypto_ticker != "ticker") && ($crypto_ticker != "")) { echo 'cc-hide'; } ?>">
			<div class="crypto-cols crypto-labels">
				<label for="crypto_speed"><?php _e('Ticker Speed','cryptocurrency-widgets-pack'); ?></label>
			</div>
			<div class="crypto-cols range-slider">
				<input name="crypto_speed" id="crypto_speed" class="range-slider__range" type="range" step="1" value="<?php if($crypto_speed != '') { echo esc_attr($crypto_speed); } else { echo '100'; } ?>" min="0" max="200">
				<span class="range-slider__value">0</span>
			</div>
		</div>
		<div class="crypto-rows ticker-position <?php if(($crypto_ticker != "ticker") && ($crypto_ticker != "")) { echo 'cc-hide'; } ?>">
			<div class="crypto-cols crypto-labels">
				<label for="crypto_ticker_columns"><?php _e('Display Options','cryptocurrency-widgets-pack'); ?></label>
			</div>
			<div class="crypto-cols">
				<label class="form-switch" for="crypto_ticker_columns1"><input type="checkbox" name="crypto_ticker_columns[]" id="crypto_ticker_columns1" value="changes" <?php if(is_array($crypto_ticker_columns) && in_array('changes',$crypto_ticker_columns, $strict = FALSE)) {echo "checked";} ?> />
				<i class="form-icon"></i><?php _e('24h Change','cryptocurrency-widgets-pack'); ?></label>
			</div>
		</div>
		<div class="crypto-rows card-position label-position <?php if(($crypto_ticker != "label") && ($crypto_ticker != "card")) { echo 'cc-hide'; } ?>">
			<div class="crypto-cols crypto-labels">
				<label for="crypto_card_columns"><?php _e('Display Options','cryptocurrency-widgets-pack'); ?></label>
			</div>
			<div class="crypto-cols">
				<label class="form-switch" for="crypto_card_columns1"><input type="checkbox" name="crypto_card_columns[]" id="crypto_card_columns1" value="fullwidth" <?php if(is_array($crypto_card_columns) && in_array('fullwidth',$crypto_card_columns, $strict = FALSE)) {echo "checked";} ?> />
				<i class="form-icon"></i><?php _e('Full Width','cryptocurrency-widgets-pack'); ?></label>
			</div>
		</div>
		<div class="crypto-rows">
			<div class="crypto-cols crypto-labels">
				<label for="crypto_text_color"><?php _e('Custom Text Color','cryptocurrency-widgets-pack'); ?></label>
			</div>
			<div class="crypto-cols">
            	<input type="text" name="crypto_text_color" value="<?php echo $crypto_text_color; ?>" class="color-field">
			</div>
		</div>
		<div class="crypto-rows">
			<div class="crypto-cols crypto-labels">
				<label for="crypto_text_color"><?php _e('Custom Background Color','cryptocurrency-widgets-pack'); ?></label>
			</div>
			<div class="crypto-cols">
            	<input type="text" name="crypto_background_color" value="<?php echo $crypto_background_color; ?>" class="color-field">
			</div>
		</div>
		<div class="crypto-rows">
			<div class="crypto-cols crypto-labels">
				<label for="crypto_custom_css"><?php _e('Add Custom CSS','cryptocurrency-widgets-pack'); ?></label>
			</div>
			<div class="crypto-cols crypto-labels">
				<textarea name="crypto_custom_css" id="crypto_custom_css" class="large-text code" rows="4"><?php echo $crypto_custom_css; ?></textarea>
			</div>
		</div>
		<div class="crypto-rows">
			<div class="img-pro">
				<a target="_blank" href="https://massivecryptopro.blocksera.com"><?php _e('Available in Pro Version','cryptocurrency-widgets-pack'); ?> ></a>
				<img draggable="false" src="<?php echo MCWP_URL.'assets/pro-settings/realtime-settings.png' ?>" />
			</div>
		</div>

		<div class="crypto-rows ticker-position<?php if ($crypto_ticker !== 'ticker') { echo ' cc-hide'; } ?>">
			<div class="img-pro">
				<a target="_blank" href="https://massivecryptopro.blocksera.com"><?php _e('Available in Pro Version','cryptocurrency-widgets-pack'); ?> ></a>
				<img draggable="false" src="<?php echo MCWP_URL.'assets/pro-settings/ticker-color.png' ?>" />
			</div>
		</div>
		
		<div class="crypto-rows ticker-position<?php if ($crypto_ticker !== 'ticker') { echo ' cc-hide'; } ?>">
			<div class="img-pro">
				<a target="_blank" href="https://massivecryptopro.blocksera.com"><?php _e('Available in Pro Version','cryptocurrency-widgets-pack'); ?> ></a>
				<img draggable="false" src="<?php echo MCWP_URL.'assets/pro-settings/ticker-display.png' ?>" />
			</div>
		</div>
		<div class="crypto-rows table-position<?php if ($crypto_ticker !== 'table') { echo ' cc-hide'; } ?>">
			<div class="img-pro">
				<a target="_blank" href="https://massivecryptopro.blocksera.com"><?php _e('Available in Pro Version','cryptocurrency-widgets-pack'); ?> ></a>
				<img draggable="false" src="<?php echo MCWP_URL.'assets/pro-settings/table-settings.png' ?>" />
			</div>
		</div>
		<div class="crypto-rows card-position<?php if ($crypto_ticker !== 'card') { echo ' cc-hide'; } ?>">
			<div class="img-pro">
				<a target="_blank" href="https://massivecryptopro.blocksera.com"><?php _e('Available in Pro Version','cryptocurrency-widgets-pack'); ?> ></a>
				<img draggable="false" src="<?php echo MCWP_URL.'assets/pro-settings/card-settings.png' ?>" />
			</div>
		</div>
		<div class="crypto-rows label-position<?php if ($crypto_ticker !== 'label') { echo ' cc-hide'; } ?>">
			<div class="img-pro">
				<a target="_blank" href="https://massivecryptopro.blocksera.com"><?php _e('Available in Pro Version','cryptocurrency-widgets-pack'); ?> ></a>
				<img draggable="false" src="<?php echo MCWP_URL.'assets/pro-settings/label-settings.png' ?>" />
			</div>
		</div>
		<div class="crypto-rows chart-position<?php if ($crypto_ticker !== 'chart') { echo ' cc-hide'; } ?>">
			<div class="img-pro">
				<a target="_blank" href="https://massivecryptopro.blocksera.com"><?php _e('Available in Pro Version','cryptocurrency-widgets-pack'); ?> ></a>
				<img draggable="false" src="<?php echo MCWP_URL.'assets/pro-settings/chart-settings.png' ?>" />
			</div>
		</div>
		<div class="crypto-rows converter-position<?php if ($crypto_ticker !== 'converter') { echo ' cc-hide'; } ?>">
			<div class="img-pro">
				<a target="_blank" href="https://massivecryptopro.blocksera.com"><?php _e('Available in Pro Version','cryptocurrency-widgets-pack'); ?> ></a>
				<img draggable="false" src="<?php echo MCWP_URL.'assets/pro-settings/converter-settings.png' ?>" />
			</div>
		</div>
		<div class="crypto-rows list-position<?php if ($crypto_ticker !== 'list') { echo ' cc-hide'; } ?>">
			<div class="img-pro">
				<a target="_blank" href="https://massivecryptopro.blocksera.com"><?php _e('Available in Pro Version','cryptocurrency-widgets-pack'); ?> ></a>
				<img draggable="false" src="<?php echo MCWP_URL.'assets/pro-settings/list-settings.png' ?>" />
			</div>
		</div>
		<div class="crypto-rows box-position<?php if ($crypto_ticker !== 'box') { echo ' cc-hide'; } ?>">
			<div class="img-pro">
				<a target="_blank" href="https://massivecryptopro.blocksera.com"><?php _e('Available in Pro Version','cryptocurrency-widgets-pack'); ?> ></a>
				<img draggable="false" src="<?php echo MCWP_URL.'assets/pro-settings/box-settings.png' ?>" />
			</div>
		</div>
		<div class="crypto-rows text-position<?php if ($crypto_ticker !== 'text') { echo ' cc-hide'; } ?>">
			<div class="img-pro">
				<a target="_blank" href="https://massivecryptopro.blocksera.com"><?php _e('Available in Pro Version','cryptocurrency-widgets-pack'); ?> ></a>
				<img draggable="false" src="<?php echo MCWP_URL.'assets/pro-settings/text-settings.png' ?>" />
			</div>
		</div>
		<div class="crypto-rows">
			<div class="img-pro">
				<a target="_blank" href="https://massivecryptopro.blocksera.com"><?php _e('Available in Pro Version','cryptocurrency-widgets-pack'); ?> ></a>
				<img draggable="false" src="<?php echo MCWP_URL.'assets/pro-settings/general-settings.png' ?>" />
			</div>
		</div>
	</div>
	<div class="crypto-preview">
        <div class="crypto-notice"><span class="micon-info-circled"></span> <?php _e('Publish or update to preview','cryptocurrency-widgets-pack'); ?></div>
		<div class="crypto-affix">
			<?php echo do_shortcode('[cryptopack id="'.$post->ID.'"]'); ?>
		</div>
	</div>
	<div class="mcwp-imgpro">
		<h3><?php _e('Hey, look our brand new Cryptocurrency Widgets Premium Plugins','cryptocurrency-widgets-pack'); ?></h3>
		<a target="_blank" href="https://massivecryptopro.blocksera.com"><img src="https://crypto.blocksera.com/pro.png" /></a>
	</div>
</div>