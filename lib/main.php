<?php

/**
 * 
 * @author Sascha Ohms
 * @copyright Copyright 2012, Sascha Ohms
 * @license http://www.gnu.org/licenses/lgpl.txt
 *   
 */

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
        $this->reroute('/add');
    }
}
