<?php
/**
 * EventON html
 *
 *
 * @author 		AJDE
 * @category 	Admin
 * @package 	EventON/html
 * @version     0.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function _eventon_html_yesnobtn( $id='',$var='', $no='', $attr=''){

	$_attr = '';

	if(!empty($var))
		$no = ($var=='yes')? null: 'NO';

	if(!empty($attr)){
		foreach($attr as $at=>$av){
			$_attr .= $at.'="'.$av.'" ';
		}
	}

	return '<span id="'.$id.'" class="evo_yn_btn '.($no? 'NO':null).'" '.$_attr.'><span class="btn_inner"><span class="catchHandle"></span></span></span>';
	

}

function eventon_html_yesnobtn($args=''){

	$defaults = array(
		'id'=>'',
		'var'=>'',
		'no'=>'',
		'attr'=>'', // array
	);
	
	$args = shortcode_atts($defaults, $args);

	$_attr = $no = '';

	if(!empty($args['var'])){
		$no = ($args['var']	=='yes')? null: 'NO';
	}

	if(!empty($args['attr'])){
		foreach($args['attr'] as $at=>$av){
			$_attr .= $at.'="'.$av.'" ';
		}
	}

	return '<span id="'.$args['id'].'" class="evo_yn_btn '.($no? 'NO':null).'" '.$_attr.'><span class="btn_inner" style=""><span class="catchHandle"></span></span></span>';
	

}