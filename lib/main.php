<?
class main {
    function showAdd() {
        F3::set('template', 'add.tpl.php');
        self::tpserve();
    }

    function add() {
        $tp = new tp;
        $tp->addPaste();
    }

    function paste() {
        $tp = new tp;
        F3::set('lang', $tp->langAlias(F3::get('PARAMS.lang')));
        F3::set('paste', $tp->getPaste());
        self::tpServe();
    }

    function tpServe() {
        echo Template::serve('main.tpl.php');
    }

    function start() {
        F3::reroute('add');
    }
}
?>