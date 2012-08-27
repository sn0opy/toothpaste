<?php

/**
 * 
 * @author Sascha Ohms
 * @copyright Copyright 2012, Sascha Ohms
 * @license http://www.gnu.org/licenses/lgpl.txt
 *   
 */

$app = require 'lib/base.php';

$app->set('DEBUG', 0);
$app->set('CACHE', false);
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
