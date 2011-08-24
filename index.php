<?php

$app = require 'lib/base.php';

$app->set('RELEASE', false);
$app->set('DEBUG', 3);
$app->set('CACHE', 'folder=cache/');
$app->set('tpdb', 'test.db'); # sqlite dbname; CHANGEME!
$app->set('GUI', 'tpl/');

$app->route('GET /', 'main->start');
$app->route('GET /add', 'main->showAdd');
$app->route('POST /add', 'main->add');
$app->route('GET /@pasteID/@lang', 'main->paste');
$app->route('GET /@pasteID', 'main->paste');
$app->route('GET /@pasteID/pw/@pass', 'main->paste');
$app->route('GET /@pasteID/pw/@pass/@lang', 'main->paste');

$app->run();

?>
