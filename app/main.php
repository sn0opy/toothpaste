<?php

class main {

	function showAdd() {
		Base::instance()->set('template', 'add.html');
    }

    function add() {
		tp::instance()->addPaste();
    }

    function paste() {
       	Base::instance()->set('paste', tp::instance()->getPaste());
	}

	function pasteRaw() {
		header('Content-Type: text/plain');
		echo tp::instance()->getPaste(true);
		die();
	}

    function afterroute() {
        echo Template::instance()->render('main.html');
    }
}
