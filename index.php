<?

require 'lib/base.php';

F3::set('RELEASE', false);
F3::set('DEBUG', 3);
F3::set('CACHE', 'folder=cache/'); # see docs, for more informations <http://fatfree.sf.net>
F3::set('tpdb', 'test.db'); # sqlite dbname; CHANGEME!
F3::set('GUI', 'tpl/'); # do not change

F3::route('GET /', 'main->start');
F3::route('GET /add', 'main->showAdd');
F3::route('POST /add', 'main->add');
F3::route('GET /p/@pasteID/@lang', 'main->paste');
F3::route('GET /p/@pasteID', 'main->paste');

F3::run();

?>
