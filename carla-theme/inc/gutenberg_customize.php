<?php
/**
 *  Gutenberg Bootstrap Customization 
 */
 

defined( 'ABSPATH' ) || exit;

function add_class_after_wp_block_details($content) 
{
  if (strpos($content, 'wp-block-details') !== false) 
  {
      $content = str_replace('wp-block-details', 'wp-block-details bg-light p-3 rounded mb-3 border', $content);
      $content = preg_replace('/<summary>/', '<summary class="d-flex justify-content-between align-items-center mb-3">', $content);
      $content = preg_replace('/<\/summary>/', ' <i class="fas fa-chevron-down"></i></summary>', $content);
  }
  return $content;
}
add_filter('the_content', 'add_class_after_wp_block_details');


function replace_gutenberg_classes_with_bootstrap($block_content, $block) {
    // Define an array mapping Gutenberg classes to Bootstrap classes
    $class_mapping = array(
        'wp-block-group' => 'container',
        'wp-block-columns' => 'row',
        'wp-block-column' => 'col',		
        'wp-container-core-columns-layout-' => '', // Replace 'custom-columns-layout' with the desired Bootstrap class
        'are-vertically-aligned-top' => 'align-items-start', 
        'are-vertically-aligned-center' => 'align-items-center', 
        'are-vertically-aligned-bottom' => 'align-items-end', 
        'are-vertically-aligned-middle' => 'align-middle', 
        'is-vertically-aligned-top' => 'align-self-start', 
        'is-vertically-aligned-center' => 'align-self-center', 
        'is-vertically-aligned-bottom' => 'align-self-end', 
        'is-content-justification-start' => 'justify-content-start', 
        'is-content-justification-end' => 'justify-content-end', 
        'is-content-justification-space-between' => 'justify-content-between', 
        'is-content-justification-space-around' => 'justify-content-around', 
        'is-content-justification-space-evenly' => 'justify-content-evenly', 
        'wp-block-buttons'=>  'd-flex', // check 
        'wp-container-core-columns-is-layout-' => 'wp-' ,
		'wp-block-button__link' => 'wp-link' 

        // need to work more below
        // 'has-contrast-background-color'=> 'bg-black', // black background
        // 'has-text-color'=> 'text-black', // black text
        // 'has-base-2-background-color'=> 'bg-white', // white background
        // 'has-base-2-color'=> 'text-white', // white text
    );
    // Loop through each mapping and replace Gutenberg classes with Bootstrap classes
    foreach ($class_mapping as $gutenberg_class => $bootstrap_class) {
        if ($bootstrap_class !== null) {
         $block_content = str_replace($gutenberg_class, $bootstrap_class, $block_content);
        }
    }
    return $block_content;
}
// Hook the function to the render_block filter with the correct number of arguments (10, 2)
add_filter('render_block', 'replace_gutenberg_classes_with_bootstrap', 10, 2);