<?php

require_once('vendor/autoload.php');

$app = Base::instance();
$app->set('AUTOLOAD', 'app/;app/inc/');
$app->set('UI', 'ui/');

$cfg = Config::instance();
if($cfg->ACTIVE_DB)
	$app->set('DB', storage::instance()->get($cfg->ACTIVE_DB));
else
	$app->error(500, 'Sorry, but there is no active DB setup.');

$app->route('GET /', 'main->showAdd');
$app->route('GET /add', 'main->showAdd');
$app->route('POST /add', 'main->add');
$app->route(array('GET /@pasteID', 'GET /@pasteID/pw/@pass'), 'main->paste');
$app->route(array('GET /@pasteID/raw', 'GET /@pasteID/pw/@pass/raw'), 'main->pasteRaw');

$app->run();
