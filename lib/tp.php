<?php

class tp {
    private $db;
    
    public function __construct() {       
        if(!file_exists(F3::get('tpdb'))) {
            $this->db = new db('sqlite:'.F3::get('tpdb'));
            $this->db->sql('CREATE TABLE tp_pastes (
                       pasteID INTEGER PRIMARY KEY,
                       pasteSource TEXT,
                       pastePublicID VARCHAR,
                       pasteHits INTEGER,
                       pasteDate INTEGER);');
        }
        
        $this->db = new db('sqlite:'.F3::get('tpdb'));
    }

    public function addPaste() {
        do {
            $pastePublicID = self::randString();
            $ax = new Axon('tp_pastes', $this->db);
            $ax->find('pastePublicID = "' .$pastePublicID. '"');
        } while(!$ax->dry());

        $source = (F3::get('FILES.file.size')) ? file_get_contents(F3::get('FILES.file.tmp_name')) : F3::get('POST.source');

        if($source) {
            $ax = new Axon('tp_pastes', $this->db);
            $ax->pasteSource = $source;
            $ax->pastePublicID = $pastePublicID;
            $ax->pasteHits = 1;
            $ax->pasteDate = time();
            $ax->save();
            F3::reroute('./p/' .$pastePublicID.'/');            
        } else {
            F3::reroute('./');
        }
    }


    public function getPaste() {
        $pastePublicID = F3::get('PARAMS.pasteID');
        $ax = new Axon('tp_pastes', $this->db);
        $ax->load('pastePublicID = "' .$pastePublicID. '"');

        if(!$ax->dry()) {
            self::raiseHits($ax->pasteID);
            F3::set('template', 'paste.tpl.php');
            return str_replace('{', '&#123;', $ax->pasteSource);
        }
        
        F3::set('template', '404.tpl.php');
    }
    

    public function langAlias($lang) {
        $lang = strtolower($lang);
        $langs = array(
            'js' => 'JScript', 'javascript' => 'JScript',
            'jscript' => 'JScript', 'applescript' => 'AppleScript',
            'actionscript' => 'AS3', 'as3' => 'AS3',
            'bash' => 'Bash', 'shell' => 'Bash',
            'cpp' => 'Cpp', 'c' => 'Cpp',
            'csharp' => 'CSharp', 'c#' => 'CSharp',
            'c-sharp' => 'CSharp', 'css' => 'Css',
            'delphi' => 'Delphi', 'pascal' => 'Delphi',
            'diff' => 'Diff', 'patch' => 'Diff',
            'pas' => 'Diff', 'java' => 'Java',
            'perl' => 'Perl', 'pl' => 'Perl',
            'php' => 'Php', 'text' => 'Plain',
            'plain' => 'Plain', 'python' => 'Python',
            'py' => 'Python', 'ruby' => 'Ruby',
            'rails' => 'Ruby', 'ror' => 'Ruby',
            'rb' => 'Ruby', 'sql' => 'Sql',
            'vb' => 'Vb', 'vbnet' => 'Vb',
            'xml' => 'Xml', 'xhtml' => 'Xml',
            'xslt' => 'Xml', 'html' => 'Xml',
            'htm' => 'Xml', '' => 'Plain',
            'sh' => 'Bash'
        );

        if(array_key_exists($lang, $langs))
            return $langs[$lang];

        return 'Plain';
    }

    private function raiseHits($pasteID) {
        $ax = new Axon('tp_pastes', $this->db);
        $ax->load('pastePublicID = "' .$pasteID. '"');
        $ax->pasteHits++;
        $ax->save();
    }    

    private function randString() {
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
    }
}

?>