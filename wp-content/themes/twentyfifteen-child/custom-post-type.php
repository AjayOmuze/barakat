<?php

// Add new post type
function add_post_type($name, $args = array()) {
  add_action('init', function() use($name, $args) {
    $upper = ucwords($name);
    $name = strtolower(str_replace(" ", "", $name));

    $args = array_merge(
            array(
        'public' => true,
        'label' => "All $upper" . "s",
        'labels' => array(
            "add_new_item" => "Add New " . str_replace("_", " ", $upper),
            "menu_name" => "All " . str_replace("_", " ", $upper),
            "all_items" => "All " . str_replace("_", " ", $upper),
            "edit_item" => "Edit " . str_replace("_", " ", $upper),
        ),
        'supports' => array('title', 'editor', 'comments')
            ), $args
    );

    register_post_type($name, $args);
  });
}

// Add New Taxanomy
function add_taxanomy($name, $post_type, $args = array()) {
  $name = strtolower($name);
  add_action('init', function() use($name, $post_type, $args) {

    $args = array_merge(
            array(
        'label' => ucwords(str_replace("_", " ", $name))
            ), $args
    );

    register_taxonomy($name, $post_type, $args);
  });
}

function add_sidebar($name, $id, $args = array()) {

  add_action('init', function() use($name, $id, $args) {


    $args = array_merge(
            array(
        'name' => __($name, 'theme_text_domain'),
        'id' => $id,
        'description' => '',
        'class' => '',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '')
            , $args
    );

    register_sidebar($args);
  });
}

?>