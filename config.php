<?php
defined('_SECURE_') or die('Forbidden');

$callback_url = '';
if (!$core_config['daemon_process']) {
	$callback_url = $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/plugin/gateway/saicom/callback.php";
	$callback_url = str_replace("//", "/", $callback_url);
	$callback_url = ($core_config['ishttps'] ? "https://" : "http://") . $callback_url;
}

$data = registry_search(0, 'gateway', 'saicom');
$plugin_config['saicom'] = $data['gateway']['saicom'];
$plugin_config['saicom']['name'] = 'saicom';
$plugin_config['saicom']['default_url'] = 'http://example.api.url/handler.php?user={SAICOM_API_USERNAME}&pwd={SAICOM_API_PASSWORD}&sender={SAICOM_SENDER}&msisdn={SAICOM_TO}&message={SAICOM_MESSAGE}';
$plugin_config['saicom']['default_callback_url'] = $callback_url;
if (!trim($plugin_config['saicom']['url'])) {
	$plugin_config['saicom']['url'] = $plugin_config['saicom']['default_url'];
}
if (!trim($plugin_config['saicom']['callback_url'])) {
	$plugin_config['saicom']['callback_url'] = $plugin_config['generic']['default_callback_url'];
}
if (!trim($plugin_config['saicom']['callback_url_authcode'])) {
	$plugin_config['saicom']['callback_url_authcode'] = sha1(_PID_);
}

// smsc configuration
$plugin_config['saicom']['_smsc_config_'] = array(
	'url' => _('Saicom send SMS URL'),
	'api_username' => _('API username'),
	'api_password' => _('API password'),
	'module_sender' => _('Module sender ID'),
	'datetime_timezone' => _('Module timezone') 
);
