<?php
$lumineConfig = array(
	'dialect' => 'MySQL',
	'database' => 'defensoria',
    'user' => 'joaopadilhacom',
    'password' => 'padilha10',
    'port' => '3306',
    'host' => 'mysql01.joaopadilha.com',
    'class_path' => dirname(__FILE__),
    'package' => 'application',
 
    'options' => array(
        'schema_name' => '',
        'generate_files' => '1',
        'generate_zip' => '',
        'class_sufix' => '',
        'remove_count_chars_start' => '',
        'remove_count_chars_end' => '',
        'remove_prefix' => '',
        'create_entities_for_many_to_many' => '',
        'plural' => 's',
        'many_to_many_style' => '',
        'create_controls' => '',
        'xml_validation_path' => '',
        'php_validator_path' => ''
    )
);