<?php

class main extends F3instance {
    function showAdd() {
        $this->set('template', 'add.tpl.php');
        $this->tpserve();
    }

    function add() {
        $tp = new tp;
        $tp->addPaste();
    }

    function paste() {
        $tp = new tp;
        $this->set('lang', $tp->langAlias($this->get('PARAMS.lang')));
        $this->set('paste', $tp->getPaste());
        $this->tpServe();
    }

    function tpServe() {
        echo Template::serve('main.tpl.php');
    }

    function start() {
        $this->reroute('add');
    }
}

?>