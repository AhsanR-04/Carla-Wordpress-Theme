<?php 
/*
* Google fonts - customize panel setting
*/
function mytheme_customize_register($wp_customize)
{
    // Fetch Google Fonts data using cURL (more reliable for server-side execution)
    $url = "https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBLr63fTmeR6qGAeqcNFPItHPzugYiPTEU";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Check for errors during fetch
    if (curl_errno($ch)) {
        echo "Error fetching Google Fonts: " . curl_error($ch);
        exit;
    }

    $data = json_decode($response, true);  // Decode JSON response

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Error decoding JSON data from Google Fonts.";
        exit;
    }

    $fonts = $data['items'];  // Extract font data

    // Close cURL session
    curl_close($ch);

    // Add section for fonts
    $wp_customize->add_section('font_settings', array(
        'title' => __('Font Settings', 'mytheme'),
        'priority' => 30,
    )
    );

    // Add control for selecting Heading Font
    $wp_customize->add_setting('heading_font', array(
        'default' => 'Roboto',
        'sanitize_callback' => 'sanitize_text_field',
    )
    );

    $font_choices = array();

   
    foreach ($fonts as $font) {
        $fontName = $font['family'];
        $font_choices[$fontName] = $fontName;
    }

    // Add font control to WordPress theme customization
    $wp_customize->add_control(
        'heading_font_control',
        array(
            'label' => __('Select Heading Font', 'mytheme'),
            'section' => 'font_settings',
            'settings' => 'heading_font',
            'type' => 'select',
            'choices' => $font_choices, 
        )
    );
	
	// Add control for selecting Heading Font Weight
    $wp_customize->add_setting('heading_font_weight', array(
        'default' => 'normal',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('heading_font_weight', array(
        'label' => __('Heading Font Weight', 'mytheme'),
        'section' => 'font_settings',
        'type' => 'select',
        'choices' => array(
            'normal' => 'Normal',
            'bold' => 'Bold',
            'bolder' => 'Bolder',
           
        ),
    ));

    // Add control for entering Heading Font Size
    $wp_customize->add_setting('h1_size', array(
        'default' => '36px',
        'sanitize_callback' => 'sanitize_text_field',
    )
    );

    $wp_customize->add_control('h1_size_control', array(
        'label' => __('Heading 1 Font Size (e.g., 36px)', 'mytheme'),
        'section' => 'font_settings',
        'settings' => 'h1_size',
        'type' => 'text',
    )
    );

    $wp_customize->add_setting('h2_size', array(
        'default' => '24px',
        'sanitize_callback' => 'sanitize_text_field',
    )
    );

    $wp_customize->add_control('h2_size_control', array(
        'label' => __('Heading 2 Font Size (e.g., 24px)', 'mytheme'),
        'section' => 'font_settings',
        'settings' => 'h2_size',
        'type' => 'text',
    )
    );

    $wp_customize->add_setting('h3_size', array(
        'default' => '20px',
        'sanitize_callback' => 'sanitize_text_field',
    )
    );

    $wp_customize->add_control('h3_size_control', array(
        'label' => __('Heading 3 Font Size (e.g., 20px)', 'mytheme'),
        'section' => 'font_settings',
        'settings' => 'h3_size',
        'type' => 'text',
    )
    );

    $wp_customize->add_setting('h4_size', array(
        'default' => '18px',
        'sanitize_callback' => 'sanitize_text_field',
    )
    );

    $wp_customize->add_control('h4_size_control', array(
        'label' => __('Heading 4 Font Size (e.g., 18px)', 'mytheme'),
        'section' => 'font_settings',
        'settings' => 'h4_size',
        'type' => 'text',
    )
    );
	
    // Add control for selecting Body Font
    $wp_customize->add_setting('body_font', array(
        'default' => 'Roboto',
        'sanitize_callback' => 'sanitize_text_field',
    )
    );

    $wp_customize->add_control('body_font_control', array(
        'label' => __('Select Body Font', 'mytheme'),
        'section' => 'font_settings',
        'settings' => 'body_font',
        'type' => 'select',
        'choices' => $font_choices, 
    )
    );

    // Add control for selecting Body Font Weight
    $wp_customize->add_setting('body_font_weight', array(
        'default' => 'normal',
        'sanitize_callback' => 'sanitize_text_field',
    )
    );

    $wp_customize->add_control('body_font_weight', array(
        'label' => __('Body Font Weight', 'mytheme'),
        'section' => 'font_settings',
        'type' => 'select',
        'choices' => array(
            'normal' => 'Normal',
            'bold' => 'Bold',
            'bolder' => 'Bolder',
           
        ),
    )
    );

    // Add control for entering Body Font Size
    $wp_customize->add_setting('body_font_size', array(
        'default' => '16px',
        'sanitize_callback' => 'sanitize_text_field',
    )
    );

    $wp_customize->add_control('body_font_size_control', array(
        'label' => __('Body Font Size (e.g., 16px)', 'mytheme'),
        'section' => 'font_settings',
        'settings' => 'body_font_size',
        'type' => 'text',
    )
    );
}
add_action('customize_register', 'mytheme_customize_register');

$font_choices = get_theme_mod('heading_font', 'Roboto');
$heading_font_weight = get_theme_mod('heading_font_weight', 'bold');
$h1_size = get_theme_mod('h1_size', '36px');
$h2_size = get_theme_mod('h2_size', '24px');
$h3_size = get_theme_mod('h3_size', '20px');
$h4_size = get_theme_mod('h4_size', '18px');
$body_font = get_theme_mod('body_font', 'Roboto');
$body_font_weight = get_theme_mod('body_font_weight', 'normal');
$body_font_size = get_theme_mod('body_font_size', '16px');
$all_font_weight = '1,400;1,500;1,600;1,700;1,800;1,900';

// Map customizer font weight options to Google Fonts weight values
$google_font_weights = [
    'normal' => '400',
    'bold' => '700',
    'bolder' => '800', 
];

// Get the corresponding Google Fonts weight value based on the selected option
$heading_font_weight_value = isset($google_font_weights[$heading_font_weight]) ? $google_font_weights[$heading_font_weight] : '';

// Build the Google Fonts URL with font weights
$font_query = [
    $font_choices . ':' . $all_font_weight,
    $body_font . ':' . $all_font_weight,
];

$fonts_url = 'https://fonts.googleapis.com/css?family=' . urlencode(implode('|', $font_query)) . '&display=swap';

// Enqueue selected fonts
function enqueue_font_styles()
{
    global $fonts_url ;
    wp_enqueue_style('google-fonts', $fonts_url, array(), null);
}
add_action('wp_enqueue_scripts', 'enqueue_font_styles');

// Output inline styles
function output_custom_inline_styles(){
    global $font_choices, $body_font, $heading_font_weight_value, $h1_size, $h2_size, $h3_size, $h4_size, $body_font_weight, $body_font_size;
    ?>
<style>
:root {
    --font-choices: <?php echo $font_choices; ?>;
    --body-font: <?php echo $body_font; ?>;
    --heading-font-weight: <?php echo $heading_font_weight_value; ?>;
    --h1-size: <?php echo $h1_size; ?>;
    --h2-size: <?php echo $h2_size; ?>;
    --h3-size: <?php echo $h3_size; ?>;
    --h4-size: <?php echo $h4_size; ?>;
    --body-font-weight: <?php echo $body_font_weight; ?>;
    --body-font-size: <?php echo $body_font_size; ?>;
}
</style>
<?php
}
add_action('wp_head', 'output_custom_inline_styles', 999); 