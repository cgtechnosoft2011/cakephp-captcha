<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');

class PagesController extends AppController {

	public $components = array('Captcha');

	public function beforeFilter(){
		$this->Auth->allow('get_captcha_image');
	}

	public function get_captcha_image(){
		$this->autoRender = false;
		if($this->request->is('ajax')){			
			echo $captcha_image_name = $this->Captcha->show_captcha();
		} else {
			$this->Session->setFlash(__('Unauthorized Access.'), 'error');
			$this->redirect(array('controller' => 'index', 'action' => 'index'));
		}
	}
	
	public function index($id = NULL){	
		
		if($this->request->is('post') || $this->request->is('put')){
			//start mail code
			if($this->Session->read('captcha') == $this->request->data['User']['security_code']){

			    //Success Section

			} else {
				//Wrong Captcha Section
				$this->Session->setFlash(__('Please enter correct security code.'), 'error');
			}			
		}

	}
}