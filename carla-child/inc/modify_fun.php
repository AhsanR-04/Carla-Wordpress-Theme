<?php
	
	if ( ! function_exists( 'get_string_between' ) )
	{
		function get_string_between($string, $start, $end)
		{
			$string = ' ' . $string;
			$ini = strpos($string, $start);
			if ($ini == 0) return '';
			$ini += strlen($start);
			$len = strpos($string, $end, $ini) - $ini;
			return substr($string, $ini, $len);
		}				
	}
	
	
	if (!function_exists('create_quick_cta_shortcode'))
	{
		/*
			[quick_cta ott="general" server="US (Reccommended server : New York)"  platform="" provider="nord"] 
			[quick_cta ott="bbc-iplayer" server="UK" platform="BBC iPlayer"] 
			[quick_cta ott="hbo-max" server="US" platform="HBO Max"] 
			[quick_cta ott="disney" server="US" platform="Disney"] 
			[[quick_cta ott="hulu" server="US" platform="Hulu" heading=""] 
			[quick_cta ott="amazon-prime" server="US" platform="Amazon Prime"] 
			[quick_cta ott="netflix" server="US" platform="Netflix"] 
			[quick_cta ott="servus-tv" server="US" platform="Servus Tv"] 
			[quick_cta ott="itv" server="US" platform="iTv"]
		*/
		function create_quick_cta_shortcode($atts)
		{
			global $post;
			$post_slug	  = isset($post->post_name) ? $post->post_name : '';
			$lang 		  = (defined('ICL_LANGUAGE_CODE')) ? ICL_LANGUAGE_CODE : 'en';
			$site_url = parse_url(get_site_url());
			$domain = $site_url['host'];
			
			#$data_param	  = '/?data1='.$post_slug;
			$data_param	  = '/?subID1='.$post_slug.'&subID2='.$domain.'&subID3='.$lang;
			$data_nord	  = '/?aff_sub='.$post_slug.'&aff_sub2='.$domain.'&aff_sub3='.$lang;
			
			$atts				= shortcode_atts(array('ott' => 'general','server' => 'US (Reccommended server : New York)','platform' => '','heading' => '', 'follow_text' => '', 'btn' => '', 'btn_text' => '', 'provider' => 'pia'), $atts,'quick_cta');
			$ott_name 		= $atts['ott'];
			$server 			= $atts['server'];
			$c_platform		= $atts['platform'];
			$heading			= $atts['heading'];
			$btn				= $atts['btn'];
			$btn_text		= $atts['btn_text'];
			$follow_text	= $atts['follow_text'];
			$provider		= $atts['provider'];
			$express_url 	= 'stream/expressvpn';				
			$site_url 		= get_site_url();
			$s_title	 		= get_the_title();
			$express_url 	= '/stream/expressvpn';
			$nord_url 		= '/stream/nord';
			$pia_url 		= '/pia/stream';
			$parsed			= get_string_between($s_title, '&#8216;', '&#8217;');
			if($parsed == '')
			{
				$parsed 	= get_string_between($s_title, '‘', '’');
			}
			
			
			#$follow_text		= $final_text 		= ($parsed == '') ? $s_title : $parsed;
			$final_text 		= ($parsed == '') ? 'your favorite movie or show' : '<span class="strong">'.$parsed.'</span>';
			$final_btn_text		= ($btn_text != '') ? $btn_text : (($parsed == '') ? $s_title : $parsed);
			$final_text_new		= ($parsed == '') ? 'your favorite content' : $parsed;
			$ott_special 		= '';
			$platform 			= ($c_platform != '') ? $c_platform : 'your streaming platform';
			
			#$final_ott			= ($btn == '') ? (($c_platform != '') ? $c_platform : '') : $btn;
			$final_ott			= ($c_platform != '') ? $c_platform : '';
			
			$ott_arr = array(
			array('name' => 'hotstar', 				'link' => 'https://www.hotstar.com/'),
			array('name' => 'bbc iplayer', 			'link' => 'https://www.bbc.co.uk/iplayer/'),
			array('name' => 'disney plus', 			'link' => 'https://www.disneyplus.com/en-ca/'),
			array('name' => 'paramount plus', 		'link' => 'https://www.paramountplus.com/'),
			array('name' => 'paramount', 		'link' => 'https://www.paramountplus.com/'),
			array('name' => 'hulu', 				'link' => 'https://www.hulu.com/'),
			array('name' => 'peacock tv', 			'link' => 'https://www.peacocktv.com/'),
			array('name' => 'peacock', 			'link' => 'https://www.peacocktv.com/'),
			array('name' => 'hbo max', 				'link' => 'https://www.max.com/'),
			array('name' => 'hbo', 				'link' => 'https://www.max.com/'),
			array('name' => 'apple tv+', 			'link' => 'https://tv.apple.com/'),
			array('name' => 'amazon prime video', 	'link' => 'https://www.primevideo.com/'),
			array('name' => 'prime video', 			'link' => 'https://www.primevideo.com/'),
			array('name' => 'cbs', 					'link' => 'https://www.cbs.com/'),
			array('name' => 'shudder', 				'link' => 'https://www.shudder.com/'),
			array('name' => 'lifetime', 			'link' => 'https://www.mylifetime.com/'),
			array('name' => 'tlc', 					'link' => 'https://www.tlc.com/'),
			array('name' => 'amc+',					'link' => 	'https://www.amcplus.com/'),
			array('name' => 'a&e', 					'link' => 'https://www.aetv.com/'),
			array('name' => 'discovery channel', 	'link' => 'https://www.discovery.com/'),
			array('name' => 'vice tv', 				'link' => 'https://www.vicetv.com/'),
			array('name' => 'tnt', 					'link' => 'https://www.tntdrama.com/'),
			array('name' => '10 play', 				'link' => '	https://10play.com.au/'),
			array('name' => 'freeform', 			'link' => 'https://www.freeform.com/'),
			array('name' => 'adult swim', 			'link' => 'http://www.adultswim.com/'),
			array('name' => 'pbs', 					'link' => 'https://www.pbs.org/'),
			array('name' => 'bounce tv', 			'link' => 'https://www.bouncetv.com/'),
			array('name' => 'abc',  				'link' => 'https://abc.com/'),
			array('name' => 'fxx',  				'link' => 'https://www.fxnetworks.com/'),
			array('name' => 'starz', 				'link' => 'https://www.starz.com/us/en/'),
			array('name' => 'tbs', 					'link' => 'https://www.tbs.com/'),
			array('name' => 'mtv', 					'link' => 'https://www.mtv.com/'),
			array('name' => 'bet+', 				'link' => 'https://www.bet.com/topic/bet-plus'),
			array('name' => 'bravo tv', 			'link' => 'https://www.bravotv.com/'),
			array('name' => 'youtube tv', 			'link' => 'https://tv.youtube.com/welcome/'),
			array('name' => 'directv now', 			'link' => 'https://streamtv.directv.com/'),
			array('name' => 'jiocinema', 			'link' => 'https://www.jiocinema.com/'),
			array('name' => 'the cw', 				'link' => 'https://www.cwtv.com/'),
			array('name' => 'itvx', 				'link' => 'https://www.itv.com/'),
			array('name' => 'channel 5', 			'link' => 'https://www.channel5.com/'),
			array('name' => 'channel 4', 			'link' => 'https://www.channel4.com/'),
			array('name' => 'hallmark', 			'link' => 'https://www.hallmark.com/'),
			array('name' => 'roku channel', 		'link' => 'https://therokuchannel.roku.com/'),
			array('name' => 'history channel', 		'link' => 'https://www.history.com/'),
			array('name' => 'food network', 		'link' => 'https://www.foodnetwork.com/'),
			array('name' => 'mgm+', 				'link' => 'https://www.mgmplus.com/'),
			array('name' => 'amazon freevee', 		'link' => 'https://play.google.com/store/apps/details?id=com.amazon.imdb.tv.mobile.app/'),
			);
			
			
			$lowercaseOtt 	= strtolower($final_ott);
			$names 			= array_column($ott_arr, 'name');
			$key 			= array_search($lowercaseOtt, array_map('strtolower', $names));
			
			if ($key !== false) {
				$foundLink = $ott_arr[$key]['link'];
				$final_ott = '<a href="' . $foundLink . '" target="_blank" rel="nofollow" class="ott_link_anchor">' . $final_ott . '</a>';
			}
			
			$c_heading			= ($heading == '') ? 'Quick Steps: Watch '.$final_text.' from anywhere' : $heading;
			$final_button_text 	= 'Watch '.$final_btn_text.' with ExpressVPN';			
			#$final_button_text 	= 'Watch '.$final_btn_text.' with PIA VPN';			
			switch($ott_name)
			{
				case 'bbc-iplayer';
				$express_url = '/bbc-iplayer-vpn/expressvpn';
				break;
				case 'hbo-max';
				$express_url = '/hbo-vpn/expressvpn';
				break;
				case 'disney';
				$express_url = '/disney-vpn/expressvpn';
				break;
				case 'hulu';
				$express_url = '/hulu-vpn/expressvpn';
				break;
				case 'amazon-prime';
				$express_url = '/amazon-prime-vpn/expressvpn';
				break;
				case 'netflix';
				$express_url = '/netflix-vpn/expressvpn';
				break;
				case 'servus-tv';
				$express_url = '/exprevpn/servus-tv-vpn';
				break;
				case 'itv';
				$express_url = '/expressvpn/itv';
				break;
			}
			$final_express 	= $site_url.$express_url.$data_param;
			$final_nord 	= $site_url.$nord_url.$data_nord;
			$final_pia 		= $site_url.$pia_url.$data_nord;
			$initial_prov	= '<span class="strong"><a href="'.$final_nord.'" class="cta_1 nordvpn inline_link" target="_blank" rel="nofollow">NordVPN</a></span>';
			switch($provider)
			{
				case 'nord':
				$initial_prov = $initial_prov;
				break;
				case 'pia':
				$initial_prov	= '<span class="strong"><a href="'.$final_pia.'" class="cta_1 piavpn inline_link" target="_blank" rel="nofollow">PIAVPN</a></span>';
				break;
				case 'express':
				$initial_prov	= '<span class="strong"><a href="'.$final_express.'" class="cta_1 expressvpn inline_link" target="_blank" rel="nofollow">ExpressVPN</a></span>';
				break;
			}
			
			$cta_text = '<div class="quick_cta_div">
			<div class="fold_heading quick_atc">'.$c_heading.'</div>
			<p>Follow these simple steps to watch '.$follow_text.'</p>
			<ol class="fold_ol">
			<li>
			<p>
			<span class="strong">Download</span> a reliable VPN [we recommend <span class="strong"><a href="'.$final_express.'" class="cta_1 expressvpn inline_link" target="_blank" rel="nofollow">ExpressVPN</a></span> OR '.$initial_prov.' as it provides exceptional streaming experience globally]
			</p>
			</li>
			<li>
			<p>
			<span class="strong">Download</span> and install <span class="strong">VPN app!</span>
			</p>
			</li>
			<li>
			<p>
			<span class="strong">Connect</span> to a server in the <span class="strong">'.$server.'</span>
			</p>
			</li>
			<li>
			<p>
			<span class="strong">Login</span> to '.$final_ott.'
			</p>
			</li>
			<li>
			<p>
			<span class="strong">Watch</span> '.$final_text_new.' on '.$platform.'
			</p>
			</li>
			</ol>
			<div class="text-center">
			<div class="wp-block-button btn-block-div">
			<a class="wp-block-button__link cta_quick_step expressvpn" href="'.$final_express.'" target="_blank" rel="nofollow">
			'.$final_button_text.'
			</a>
			</div>
			</div>
			</div>
			';
			return $cta_text;
		}
		add_shortcode( 'quick_cta', 'create_quick_cta_shortcode' );
	}
	
	
	if (!function_exists('create_bestvpn_cta_shortcode'))
	{
		/*
			[bestvpn_cta ott="general" server="US"  platform=""] 
			[bestvpn_cta ott="bbc-iplayer" server="UK" platform="BBC iPlayer"] 
			[bestvpn_cta ott="hbo-max" server="US" platform="HBO Max"] 
			[bestvpn_cta ott="disney" server="US" platform="Disney"] 
			[bestvpn_cta ott="hulu" server="US" platform="Hulu"] 
			[bestvpn_cta ott="amazon-prime" server="US" platform="Amazon Prime"] 
			[bestvpn_cta ott="netflix" server="US" platform="Netflix"] 
			[bestvpn_cta ott="servus-tv" server="US" platform="Servus Tv"] 
			[bestvpn_cta ott="itv" server="US" platform="iTv"] 
		*/
		function create_bestvpn_cta_shortcode($atts)
		{
			$atts 			= shortcode_atts(array('ott' => 'general', 'server' => 'US [Reccommended server : New York]', 'platform' => ''), $atts, 'bestvpn_cta');
			$ott_name 		= $atts['ott'];
			$server 		= $atts['server'];
			$c_platform		= $atts['platform'];
			$express_url 	= '/stream/expressvpn';				
			$nord_url 		= '/stream/nord';				
			$site_url 		= get_site_url();
			$s_title	 	= get_the_title();
			$express_url 	= '/stream/expressvpn';
			$parsed			= get_string_between($s_title, '&#8216;', '&#8217;');
			if($parsed == '')
			{
				$parsed 	= get_string_between($s_title, '‘', '’');
			}
			
			$final_text 		= ($parsed == '') ? 'your favorite movie or show' : '<span class="strong">'.$parsed.'</span>';
			$final_express_text = ($parsed == '') ? 'Stream with ExpressVPN' : 'Watch '.$parsed.' with ExpressVPN';
			$final_pia_text 	= ($parsed == '') ? 'Stream with PIA VPN' : 'Watch '.$parsed.' with PIA VPN';
			$final_nord_text 	= ($parsed == '') ? 'Stream with NordVPN' : 'Watch '.$parsed.' with NordVPN';
			$ott_special 		= '';
			$platform 			= ($c_platform != '') ? $c_platform : 'your streaming platform';
			$final_ott			= ($c_platform != '') ? $c_platform : '';
			switch($ott_name)
			{
				case 'bbc-iplayer';
				$express_url = '/bbc-iplayer-vpn/expressvpn';
				break;
				case 'hbo-max';
				$express_url = '/hbo-vpn/expressvpn';
				break;
				case 'disney';
				$express_url = '/disney-vpn/expressvpn';
				break;
				case 'hulu';
				$express_url = '/hulu-vpn/expressvpn';
				break;
				case 'amazon-prime';
				$express_url = '/amazon-prime-vpn/expressvpn';
				break;
				case 'netflix';
				$express_url = '/netflix-vpn/expressvpn';
				break;
				case 'servus-tv';
				$express_url = '/exprevpn/servus-tv-vpn';
				break;
				case 'itv';
				$express_url = '/expressvpn/itv';
				break;
			}
			$final_express 	= $site_url.$express_url;
			$final_nord 	= $site_url.$nord_url;
			$cta_img_url 	= get_theme_file_uri().'/assets/img/';
			
			$output = 	'<div class="cta-main">
			<h2 class="cta-heading">ExpressVPN</h2>
			<div class="express-cta">
			<div class="cta-iconbox">
			<img src="'.$cta_img_url.'privacy-protection.webp" title="Privacy-Protection" alt="Privacy-Protection" width="120" height="120">
			<p>Privacy Protection</p>
			</div> 
			<div class="cta-iconbox">
			<img src="'.$cta_img_url.'customizable-feature.webp" title="Customizable-Feature" alt="Customizable-Feature" width="120" height="120">
			<p> Customizable Feature</p>
			</div>
			<div class="cta-iconbox">
			<img src="'.$cta_img_url.'money-back.webp" title="Money-Back-Guarantee" alt="Money-Back-Guarantee" width="120" height="120">
			<p> Money Back Guarantee</p>
			</div>
			<div class="cta-iconbox">
			<img src="'.$cta_img_url.'privacy-protection.webp" title="Unlimited-Accessibility" alt="Unlimited-Accessibility" width="120" height="120">
			<p> Unlimited Accessibility</p>
			</div>
			<div class="cta-iconbox">
			<img src="'.$cta_img_url.'customizable-feature.webp" title="No-Bandwidth-Cap" alt="No-Bandwidth-Cap" width="120" height="120">
			<p> No Bandwidth Cap</p>
			</div>
			<div class="cta-iconbox">
			<img src="'.$cta_img_url.'money-back.webp" title="Multi-Device-Compatibility" alt="Multi-Device-Compatibility" width="120" height="120">
			<p> Multi Device Compatibility</p>
			</div>
			</div>			
			<div class="cta-btn-div">
			<a class="cta-btn-1 expressvpn"  href="'.$final_express.'" target="_blank" rel="nofollow">'.$final_express_text.'</a>
			</div>
			<h2 class="cta-heading">Nord VPN</h2>
			<div class="express-cta">
			<div class="cta-iconbox">
			<img src="'.$cta_img_url.'protection-of-identity.webp" title="Privacy-Protection" alt="Privacy-Protection" width="120" height="120">
			<p>Privacy Protection</p>
			</div> 
			<div class="cta-iconbox">
			<img src="'.$cta_img_url.'high-speed-searches.webp" title="Customizable-Feature" alt="Customizable-Feature" width="120" height="120">
			<p> Customizable Feature</p>
			</div>
			<div class="cta-iconbox">
			<img src="'.$cta_img_url.'multi-device-connectivity.webp" title="Money-Back-Guarantee" alt="Money-Back-Guarantee" width="120" height="120">
			<p> Money Back Guarantee</p>
			</div>
			<div class="cta-iconbox">
			<img src="'.$cta_img_url.'increased-device-compatibility.webp" title="Unlimited-Accessibility" alt="Unlimited-Accessibility" width="120" height="120">
			<p> Unlimited Accessibility</p>
			</div>
			<div class="cta-iconbox">
			<img src="'.$cta_img_url.'allows-torrenting.webp" title="No-Bandwidth-Cap" alt="No-Bandwidth-Cap" width="120" height="120">
			<p> No Bandwidth Cap</p>
			</div>
			<div class="cta-iconbox">
			<img src="'.$cta_img_url.'global-accessibility.webp" title="Multi-Device-Compatibility" alt="Multi-Device-Compatibility" width="120" height="120">
			<p> Multi Device Compatibility</p>
			</div>
			</div>
			<div class="cta-btn-div">
			<a class="cta-btn cta2-btn nordvpn"  href="'.$final_nord.'" target="_blank" rel="nofollow">'.$final_nord_text.'</a>
			</div>
			</div>';
			#return $output;
			return '';
		}
		add_shortcode( 'bestvpn_cta', 'create_bestvpn_cta_shortcode' );
	}
	
	
	
		function generate_button_cta($vpn)
		{
			
			global $post;
			$post_slug	  = isset($post->post_name) ? $post->post_name : '';
			$lang = (defined('ICL_LANGUAGE_CODE')) ? ICL_LANGUAGE_CODE : 'en';
			$site_url = parse_url(get_site_url());
			$domain = $site_url['host'];
			$data_param	  = '/?subID1='.$post_slug.'&subID2='.$domain.'&subID3='.$lang;
			$data_aff	  = '/?aff_sub='.$post_slug.'&aff_sub2='.$domain.'&aff_sub3='.$lang;
			$data_data	  = '/?data1='.$post_slug.'&data2='.$domain.'&data3='.$lang;
			
			$vpn_img	  = '<img src="wp-content/uploads/2023/11/ExpressVPN_Horizontal_Logo_Red-svg.webp" alt="ExpressVPN Logo" height="50" width="175" />';
			$url 		  = 'express/blackfriday';
			
			$site_url 		= get_site_url();
			$output = '';
			switch($vpn) 
			{
				case 'express':
				$vpn_img = '<img src="'.$site_url.'/wp-content/uploads/2023/11/ExpressVPN_Horizontal_Logo_Red-svg.webp" alt="ExpressVPN Logo" height="50" width="175" />';
				$url = '/express/blackfriday'.$data_param;
				break;			
				case 'nord':
				$vpn_img = '<img src="'.$site_url.'/wp-content/uploads/2023/11/NordVPN-Hor.webp" alt="NordVPN Logo" height="50" width="175" />';
				$url = '/stream/nord'.$data_aff;
				break;
				case 'surfshark':
				$vpn_img = '<img src="'.$site_url.'/wp-content/uploads/2023/11/surfvpn.webp" alt="Surfshark Logo" height="50" width="175" />';
				$url = '/stream/surfshark'.$data_aff;
				break;
				
				case 'pia':
				$vpn_img = '<img src="'.$site_url.'/wp-content/uploads/2023/11/privvpn.webp" alt="PIA Logo" height="50" width="175" />';
				$url = '/pia/blackfriday'.$data_aff;
				break;
				
				case 'cyberghost':
				$vpn_img = '<img src="'.$site_url.'/wp-content/uploads/2023/11/CyberGhost-VPN-Hor.webp" alt="CyberGhost Logo" height="50" width="175" />';
				$url = '/cyberghost/blackfriday'.$data_aff;
				break;
				
				case 'pure':
				$vpn_img = '<img src="'.$site_url.'/wp-content/uploads/2023/11/purevpn.webp" alt="PureVPN Logo" height="50" width="175" />';
				$url = '/purevpn/blackfriday'.$data_data;
				break;
				
				case 'ivacy':
				$vpn_img = '<img src="'.$site_url.'/wp-content/uploads/2023/11/ivacyvpn-removebg-preview.webp" alt="Ivacy Logo" height="50" width="175" />';
				$url = '/ivacy/blackfriday'.$data_data;
				break;;
			}
			$final_url 		= $site_url.$url;
			
			$arr = array('final_url' => $final_url, 'vpn_img' => $vpn_img);
			return $arr;
		}
		
		// Using functions.php in your theme
		function best_vpn_function($atts)
		{
			// Extract shortcode attributes
			$atts = shortcode_atts(
			array(
			'vpn' => 'express',
			'price' => '',
			'package' => '',
			'btn_text' => 'Get Deals',
			'layout' => 'box',
			),
			$atts,
			'best_vpn'
			);
			$output = '';
			$vpn 		= $atts['vpn'];
			$price 		= $atts['price'];
			$package 	= $atts['package'];
			$vpn 		= $atts['vpn'];
			$btn_text 	= $atts['btn_text'];
			$layout 	= $atts['layout'];
			$final_arr = generate_button_cta($vpn);
			
			switch($layout)
			{
				case 'box':
				$output .= '<div class="row '.$layout.'">
				<div class="col-md-12 col-sm-12 col-12 p-0">
				<div class="vpn-1 w-100 rounded py-4 px-4  position-relative" style="border: 3px solid #B70000; background-color: #F9F8F2;">
				<div class="row align-items-center">
				<div class="col-md-3 text-center">
				'.$final_arr['vpn_img'].'
				</div>
				<div class="col-md-6 d-flex flex-column justify-content-center align-items-center ">
				<p class="vpn-con mt-2 fw-bold mb-1 text-center fs-5"> ' .$package. ' </p>
				<p class="vpn-pre m-0 mb-2 text-center"> ' .$price. '  </p>
				</div>
				<div class="col-md-3 text-center">
				<a class="wp-block-button__link text-decoration-none text-white rounded py-2 px-4 '.$vpn.'" style="background-color: #C91A18;" href="'.$final_arr['final_url'].'" target="_blank" rel="nofollow">'.$btn_text.'</a>
				</div>
				</div>
				</div>
				</div>
				</div>'.PHP_EOL;
				break;		
				case 'single_btn':
				$output .= '
				<div class="text-center">
				<a class="wp-block-button__link text-decoration-none text-white rounded fs-5 py-2 px-4 '.$vpn.'  '.$layout.'" style="background-color: #C91A18;" href="'.$final_arr['final_url'].'" target="_blank" rel="nofollow">'.$btn_text.'</a>
				</div>
				'.PHP_EOL;
				break;		
			}
			
			return $output;
		}
		
		add_shortcode('best_vpn', 'best_vpn_function');
		