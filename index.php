<?php

$app = require 'lib/base.php';

$app->set('RELEASE', false);
$app->set('DEBUG', 3);
$app->set('CACHE', 'folder=cache/'); # see docs, for more informations <http://fatfree.sf.net>
$app->set('tpdb', 'test.db'); # sqlite dbname; CHANGEME!
$app->set('GUI', 'tpl/'); # do not change

$app->route('GET /', 'main->start');
$app->route('GET /add', 'main->showAdd');
$app->route('POST /add', 'main->add');
$app->route('GET /p/@pasteID/@lang', 'main->paste');
$app->route('GET /p/@pasteID', 'main->paste');

$app->run();

?>
