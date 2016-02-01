<?php

class tp extends Prefab {

	public function addPaste() {
		$f3 = Base::instance();

		$hash = $this->_randString();
		$source = ($f3->get('FILES.file.size')) ? file_get_contents($f3->get('FILES.file.tmp_name')) : $f3->get('POST.source');

		if($source && mb_check_encoding($source, 'UTF-8')) {
			$pwString =  $this->_randString(12);

			$ax = new DB\Cortex($f3->get('DB'), 'tp_pastes', true);
			$ax->pasteSource = $source;
			$ax->pastePublicID = $hash;
			$ax->pasteDate = time();
			$ax->pastePass = ($f3->get('POST.private')) ? $pwString : null;
			$ax->save();

			if($f3->get('POST.private'))
				$f3->reroute('/'.$hash.'/pw/'.$pwString);
			else
				$f3->reroute('/' .$hash.'/');
		} else {
			$f3->reroute('/');
		}
	}


	public function getPaste($raw = false) {
		$f3 = Base::instance();

		$ax = new DB\Cortex($f3->get('DB'), 'tp_pastes', true);
		$ax->load(array('pastePublicID = ?', $f3->get('PARAMS.pasteID')));

		if(!$ax->dry()) {
			if(($ax->pastePass == $f3->get('PARAMS.pass')) || !$ax->pastePass) {
				$f3->set('template', 'paste.html');
				return $ax->pasteSource;
			}
		}

		$f3->set('template', '404.html');
		return;
	}

	private function _randString($l = 8) {
		return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, $l);
	}
}
