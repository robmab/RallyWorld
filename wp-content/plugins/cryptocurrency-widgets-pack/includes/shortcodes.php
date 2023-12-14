<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('CryptoPack_Shortcodes')) {
class CryptoPack_Shortcodes {

	public $allpostmetas = [
		'crypto_ticker',
		'crypto_ticker_coin',
		'crypto_ticker_position',
		'crypto_bunch_select',
		'crypto_speed',
		'crypto_ticker_columns',
		'crypto_card_columns',
		'crypto_table_columns',
		'crypto_background_color',
		'crypto_text_color',
		'crypto_custom_css'
	];

    public function data($post_id) {

        $data = new StdClass();
        $allpostmetas = $this->allpostmetas;
        
        for($k = 0; $k < sizeof($allpostmetas); $k++) {
			$data->{$allpostmetas[$k]} = get_post_meta($post_id, $allpostmetas[$k], true);
		}

        return $data;
    }

    public function selectedCoins($mcwp_cid, $data) {

        $selectedcoins = [];

        if($data->crypto_bunch_select > 0){
            for($k = 0;$k < sizeof($mcwp_cid); $k++) {
                if($k < $data->crypto_bunch_select) {
                    array_push($selectedcoins, $mcwp_cid[$k]);
                }
            }
        } else {
            for($k = 0; $k < sizeof($mcwp_cid); $k++) {
                if(is_array($data->crypto_ticker_coin) && in_array($mcwp_cid[$k], $data->crypto_ticker_coin)) {
                    array_push($selectedcoins, $mcwp_cid[$k]);
                }
            }
        }

        return $selectedcoins;
    }

    public function mcwp_image_id($image, $size = 'thumb') {
        if($image == 'error') {
            return MCWP_URL.'assets/public/img/error.png';
        } else {
            $image = str_replace('large/', $size.'/', $image);
            return 'https://assets.coingecko.com/coins/images/' . $image;
        }
    }

    public function mcwp_currency_convert($price) {
        
        if(($price >= 1) || ($price == 0)) {
            $price = number_format((float)$price, '2');
        } else {
            $count = strspn(number_format($price, '10'), "0", strpos($price, ".") + 1);
            $count = ($count > 5) ? 8 : 6;
            $price = number_format($price, $count);
        }
        
        $output = '$ ' . $price;
        return substr($output, -1) == '.' ? substr($output, 0, -1) : $output;
    }

    public function ticker($output, $coins, $data) {

        if($data->crypto_text_color !== ''){
            $data->crypto_background_color = ($data->crypto_background_color == '') ? '#fff' : $data->crypto_background_color;
        }

        $output .= '<div class="mcwp-ticker mcwp-'. esc_attr($data->crypto_ticker_position) .'" data-speed="'.esc_attr($data->crypto_speed).'">';
        $output .= '<div class="cc-ticker cc-white-color" ' . (($data->crypto_background_color !== '') ? ' style="background-color: ' . esc_attr($data->crypto_background_color) . ';"' : "") . '>';
        $output .= '<ul class="cc-stats">';

        foreach($coins as $coin) {

            $output .= '<li class="cc-coin"><div>';
            $output .= '<img src="' . esc_url($this->mcwp_image_id($coin->img)) . '" alt="' . esc_attr($coin->cid) . '" />';
            $output .= '<b>';

            if(is_array($data->crypto_ticker_columns) && in_array('coingecko', $data->crypto_ticker_columns)) {
                $output .= '<a rel="nofollow" href="https://coingecko.com/coins/' . esc_attr($coin->cid) . '" target="_blank">';
            }
            $output .= esc_html($coin->name) . ' <span>(' . esc_html($coin->symbol) . ')</span>';

            if(is_array($data->crypto_ticker_columns) && in_array('coingecko', $data->crypto_ticker_columns)) {
                $output .= '</a>';
            }
            $output .= ' <span>' . esc_html($this->mcwp_currency_convert($coin->price_usd)) . '</span>';

            if(is_array($data->crypto_ticker_columns) && in_array('changes', $data->crypto_ticker_columns)) {
                $output .= '<span class="' . (esc_attr($coin->percent_change_24h) > 0 ? 'mcwpup' : 'mcwpdown') . '"> ' . abs(esc_html($coin->percent_change_24h)) . '%</span>';
            }
            $output .= '</b></div></li>';
        }
        $output .= '</ul></div></div>';

        return $output;
    }

    public function table($output, $selectedcoins, $data) {
        
        $tablecoins = (sizeof($selectedcoins) > 50) ? 50 : sizeof($selectedcoins);

        $theme = ($data->crypto_background_color !== '') ? 'custom' : 'light';
        $output .= '<svg style="width: 0; height: 0; opacity: 0; visibility: hidden;">
                <defs>
                    <linearGradient id="red" x1="1" x2="0" y1="1" y2="0">
                        <stop offset="0" stop-color="white"></stop>
                        <stop offset="1" stop-color="#ef3e3e"></stop>
                    </linearGradient>
                    <linearGradient id="green" x1="1" x2="0" y1="1" y2="0">
                        <stop offset="0" stop-color="white"></stop>
                        <stop offset="1" stop-color="#3cef3c"></stop>
                    </linearGradient>
                </defs>
            </svg>';

        $output .= '<table class="mcwp-datatable table-processing '.esc_attr($theme).'" data-theme="'.esc_attr($theme).'" data-color="'.esc_attr($data->crypto_text_color).'" data-bgcolor="'.esc_attr($data->crypto_background_color).'" data-length="'.esc_attr($tablecoins).'"><thead><tr>';
        $output .= '<th>#</th><th>' . __('Name','cryptocurrency-widgets-pack') . '</th><th>' . __('Price','cryptocurrency-widgets-pack') . '</th><th>' . __('Market Cap','cryptocurrency-widgets-pack') . '</th><th>' . __('Change','cryptocurrency-widgets-pack') . '</th><th>' . __('Price Graph (24h)','cryptocurrency-widgets-pack') . '</th>';
        $output .= '</tr></thead><tbody>';

        for($i = 0; $i < $tablecoins; $i++) {
            $output .= '<tr><td colspan="56" height="30"><span></span></td></tr>';
        }

        $output .= '</tbody></table>';

        return $output;
    }

    public function card($output, $selectedcoins, $coins, $data) {

        foreach($coins as $coin) {
            if(in_array(strtolower($coin->cid), $selectedcoins)) {

                $output .= (is_array($data->crypto_card_columns) && in_array('fullwidth', $data->crypto_card_columns)) ? '' : '<div class="cc-card-col">';
                $output .= '<div class="mcwp-card mcwp-card-1 mcwp-card-white"';
                
                if($data->crypto_background_color !== '') {
                    $output .= ' style="background-color: '.esc_attr($data->crypto_background_color).';"';
                }

                $output .= '><div class="bg"><img src="' . esc_url($this->mcwp_image_id($coin->img, 'large')) . '" alt="' . esc_attr($coin->cid) . '"></div>';
                $output .= '<div class="mcwp-card-head"><div><img src="' . esc_url($this->mcwp_image_id($coin->img)) . '" alt="' . esc_attr($coin->cid) . '">';
                $output .= '<p>';
                
                if(is_array($data->crypto_card_columns) && in_array('coingecko', $data->crypto_card_columns)) {
                    $output .= '<a rel="nofollow" href="https://coingecko.com/coins/' . esc_attr($coin->cid) . '" target="_blank">';
                }
                $output .= esc_html($coin->name) . ' (' . esc_html($coin->symbol) . ')';

                if(is_array($data->crypto_card_columns) && in_array('coingecko', $data->crypto_card_columns)) {
                    $output .= '</a>';
                }

                if(is_array($data->crypto_card_columns) && in_array('percentage', $data->crypto_card_columns)) {
                    $output .= '<small class="' . (esc_attr($coin->percent_change_24h) > 0 ? "high" : "low") . '">' . abs(esc_html($coin->percent_change_24h)) . '</small>';
                }

                $output .= '</p>';
                $output .= '</div></div><div class="mcwp-pricelabel">Price</div>';
                $output .= '<div class="mcwp-price">' . esc_html($this->mcwp_currency_convert($coin->price_usd)) . '</div>';
                $output .= '</div>';
                
                $output .= (is_array($data->crypto_card_columns) && in_array('fullwidth', $data->crypto_card_columns)) ? '' : '</div>';
            }
        }

        return $output;
    }

    public function label($output, $selectedcoins, $coins, $data) {
        
        foreach($coins as $coin) {

            if(in_array(strtolower($coin->cid), $selectedcoins)) {

                $output .= (is_array($data->crypto_card_columns) && in_array('fullwidth', $data->crypto_card_columns)) ? '' : '<div class="cc-label-col">';
                $output .= '<div class="mcwp-label mcwp-label-1 mcwp-label-white"';
                
                if($data->crypto_background_color !== '') {
                    $output .= ' style="background-color:' . esc_attr($data->crypto_background_color).';"';
                }
                
                $output .= '><div class="mcwp-label-dn1-head"><div class="mcwp-card-head">';
                $output .= '<div><img src="' . esc_url($this->mcwp_image_id($coin->img)) . '" alt="' . esc_attr($coin->cid) . '" />';
                $output .= '<p>';
                
                if(is_array($data->crypto_card_columns) && in_array('coingecko', $data->crypto_card_columns)) {
                    $output .= '<a rel="nofollow" href="https://coingecko.com/coins/' . esc_attr($coin->cid) . '" target="_blank">';
                }
                $output .= esc_html($coin->name) . ' (' . esc_html($coin->symbol) . ')';
                
                if(is_array($data->crypto_card_columns) && in_array('coingecko', $data->crypto_card_columns)) {
                    $output .= '</a>';
                }
                
                $output .= '</p>';
                $output .= '</div></div></div>';
                $output .= '<div class="mcwp-label-dn1-body"><b>'.esc_html($this->mcwp_currency_convert($coin->price_usd)).'</b>';

                if(is_array($data->crypto_card_columns) && in_array('percentage', $data->crypto_card_columns)) {
                    $output .= '<small class="' . (esc_attr($coin->percent_change_24h) > 0 ? "high" : "low") . '">' . abs(esc_html($coin->percent_change_24h)) . '</small>';
                }
                
                $output .= '</div></div>';
                $output .= (is_array($data->crypto_card_columns) && in_array('fullwidth', $data->crypto_card_columns)) ? '' : '</div>';
            }
        }

        return $output;
    }
}
}