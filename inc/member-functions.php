<?php
function affinia_get_profile_completion( $user_id ) {
	$fields = array( get_userdata($user_id)->display_name, get_user_meta($user_id,'affinia_bio',true), get_user_meta($user_id,'affinia_age',true), get_user_meta($user_id,'affinia_location',true), get_user_meta($user_id,'affinia_avatar',true), get_user_meta($user_id,'affinia_interests',true) );
	$filled = 0; foreach($fields as $v){ if(!empty($v)) $filled++; }
	return round(($filled/count($fields))*100);
}
function affinia_get_suggestions( $user_id ) { return array(); }
function affinia_get_user_favorites( $user_id ) {
	$ids = get_user_meta($user_id,'affinia_favorites',true);
	if(!is_array($ids)||empty($ids)) return array();
	$favs = array();
	foreach($ids as $fid){ $u=get_userdata($fid); if($u) $favs[]=array('id'=>$fid,'name'=>$u->display_name,'age'=>get_user_meta($fid,'affinia_age',true),'location'=>get_user_meta($fid,'affinia_location',true),'photo'=>get_user_meta($fid,'affinia_avatar',true)); }
	return $favs;
}
function affinia_get_mutual_favorites( $user_id ) {
	$my = get_user_meta($user_id,'affinia_favorites',true); if(!is_array($my)) return array();
	$mutual = array();
	foreach($my as $fid){ $their=get_user_meta($fid,'affinia_favorites',true); if(is_array($their)&&in_array($user_id,$their)){ $u=get_userdata($fid); if($u) $mutual[]=array('id'=>$fid,'name'=>$u->display_name); } }
	return $mutual;
}
function affinia_get_unread_count( $user_id ) { return 0; }
function affinia_get_conversations( $user_id ) { return array(); }
function affinia_get_messages( $conversation_id ) { return array(); }
function affinia_get_conversation_partner( $cid, $uid ) { return array('id'=>0,'name'=>'','status'=>'Hors ligne'); }
function affinia_get_notifications( $user_id ) { return array(); }
function affinia_count_unread_notifications( $user_id ) { return 0; }

add_action('wp_ajax_affinia_toggle_favorite', function(){
	check_ajax_referer('affinia_nonce','nonce');
	$uid=get_current_user_id(); $tid=absint($_POST['target_id']);
	if(!$uid||!$tid) wp_send_json_error();
	$favs=get_user_meta($uid,'affinia_favorites',true); if(!is_array($favs)) $favs=array();
	if(in_array($tid,$favs)){ $favs=array_diff($favs,array($tid)); $a='removed'; } else { $favs[]=$tid; $a='added'; }
	update_user_meta($uid,'affinia_favorites',array_values($favs));
	wp_send_json_success(array('action'=>$a));
});

add_action('wp_ajax_affinia_send_message', function(){
	check_ajax_referer('affinia_nonce','nonce');
	$uid=get_current_user_id(); $msg=sanitize_textarea_field($_POST['message']);
	if(!$uid||empty($msg)) wp_send_json_error();
	wp_send_json_success(array('message'=>$msg,'time'=>current_time('H:i')));
});

add_action('init', function(){
	if(!isset($_POST['affinia_profile_nonce'])) return;
	if(!wp_verify_nonce($_POST['affinia_profile_nonce'],'affinia_update_profile')) return;
	$uid=get_current_user_id(); if(!$uid) return;
	if(isset($_POST['display_name'])) wp_update_user(array('ID'=>$uid,'display_name'=>sanitize_text_field($_POST['display_name'])));
	foreach(array('affinia_age','affinia_location','affinia_bio') as $f){ if(isset($_POST[$f])) update_user_meta($uid,$f,sanitize_text_field($_POST[$f])); }
	if(isset($_POST['affinia_interests'])) update_user_meta($uid,'affinia_interests',array_map('sanitize_text_field',$_POST['affinia_interests']));
	wp_redirect(add_query_arg('updated','1',wp_get_referer())); exit;
});

add_action('init', function(){
	if(!isset($_POST['affinia_settings_nonce'])) return;
	if(!wp_verify_nonce($_POST['affinia_settings_nonce'],'affinia_update_settings')) return;
	$uid=get_current_user_id(); if(!$uid) return;
	update_user_meta($uid,'affinia_email_notifs',isset($_POST['affinia_email_notifs'])?'on':'off');
	update_user_meta($uid,'affinia_push_notifs',isset($_POST['affinia_push_notifs'])?'on':'off');
	update_user_meta($uid,'affinia_visibility',sanitize_text_field($_POST['affinia_visibility']??'visible'));
	update_user_meta($uid,'affinia_location_precision',sanitize_text_field($_POST['affinia_location_precision']??'approximate'));
	wp_redirect(add_query_arg('updated','1',wp_get_referer())); exit;
});
