<?php
/**
 * Elgg friends of page
 *
 * @package Elgg.Core
 * @subpackage Social.Friends
 */

$owner = elgg_get_page_owner_entity();
if (!$owner) {
	// unknown user so send away (@todo some sort of 404 error)
	forward();
}

$title = elgg_echo("friends:title:followers");

elgg_push_breadcrumb(elgg_echo('friends:followers'));
elgg_push_breadcrumb($owner->name);

$options = array(
	'relationship' => 'friend',
	'relationship_guid' => $owner->getGUID(),
	'inverse_relationship' => TRUE,
	'type' => 'user',
	'full_view' => FALSE,
	'split_items' => 3,
	'size' => 'small',
);
$content = elgg_list_entities_from_relationship($options);
if (!$content) {
	$content = elgg_echo('friends:none');
}

$params = array(
	'content' => $content,
	'title' => $title,
	'filter' => false
);
$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);