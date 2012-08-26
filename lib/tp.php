<?php

/**
 * 
 * @author Sascha Ohms
 * @copyright Copyright 2012, Sascha Ohms
 * @license http://www.gnu.org/licenses/lgpl.txt
 *   
 */

class tp extends F3instance {
    public function __construct() {      
		// create db and tables if not existent
        if(!file_exists($this->get('tpdb'))) {
            $this->set('DB', new DB('sqlite:'.$this->get('tpdb')));
            $this->get('DB')->sql('CREATE TABLE tp_pastes (
                       pasteID INTEGER PRIMARY KEY,
                       pasteSource TEXT,
                       pastePublicID VARCHAR,
                       pasteHits INTEGER,
                       pastePass VARCHAR,
                       pasteDate INTEGER);');
        }
        
        $this->set('DB', new DB('sqlite:'.$this->get('tpdb')));
    }

    public function addPaste() {
		// search for unused hash
        do {
            $pastePublicID = $this->randString();
            $ax = new Axon('tp_pastes');
            $ax->find(array('pastePublicID = :ppID', array('ppID' => $pastePublicID)));
        } while(!$ax->dry());

        $source = ($this->get('FILES.file.size')) ? file_get_contents($this->get('FILES.file.tmp_name')) : $this->get('POST.source');

		// check if code is non-Binary
        if($source && mb_check_encoding($source, 'UTF-8')) {
            $pwString =  $this->randString(12); // create pw with 12 random letters
            
            $ax = new Axon('tp_pastes');
            $ax->pasteSource = $source;
            $ax->pastePublicID = $pastePublicID;
            $ax->pasteHits = 1;
            $ax->pasteDate = time();
            $ax->pastePass = ($this->get('POST.private')) ? $pwString : null; // add pw string, if user sets to private
            $ax->save();
            
            if($this->get('POST.private'))
                $this->reroute('/'.$pastePublicID.'/pw/'.$pwString);
            else
                $this->reroute('/' .$pastePublicID.'/');            
        } else {
            $this->reroute('/');
        }
    }


    public function getPaste() {
        $ax = new Axon('tp_pastes');
        $ax->load(array('pastePublicID = :ppID', array(':ppID' => $this->get('PARAMS.pasteID'))));
        
        if(!$ax->dry()) {
            if(($ax->pastePass == $this->get('PARAMS.pass')) || !$ax->pastePass) {
                $this->raiseHits($ax->pastePublicID); // hits +1; currently unused, but why not?
                $this->set('template', 'paste.tpl.php');
                return str_replace('{', '&#123;', htmlspecialchars($ax->pasteSource)); // I have to use this, because of F3
            }
        }
        
        $this->set('template', '404.tpl.php');
		return;
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

        return $langs['text'];
    }

    private function raiseHits($pasteID) {
        $ax = new Axon('tp_pastes');
        $ax->load(array('pastePublicID = :ppID', array(':ppID' => $pasteID)));
        $ax->pasteHits++;
        $ax->save();
    }    

    private function randString($l = 8) {
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, $l);
    }
}
