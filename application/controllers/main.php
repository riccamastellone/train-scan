<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

        
        function __construct() {
            parent::__construct();
            $this->load->helper('url');
            $this->load->library('assets');
            $this->load->model('scanner');
            $this->load->model('italotreno');
            $this->load->model('trenitalia');
        }
        
        
	public function index()
	{       
            $data['stazioni'] = implode('","',$this->italotreno->_stazioni);
            
            $this->_renderPage($data);
                
	}
        
        public function trenitalia() {
            $this->trenitalia->setData('2012-09-25');
            $this->scanner->setData('2012-09-25');
            $this->trenitalia->setStazioni('Milano','Firenze');
            $this->scanner->setStazioni('Milano','Firenze');
            $data['idPreventivo'] = (int)$this->scanner->checkPreventivo();
            print_r($this->trenitalia->getQuotazioni($data['idPreventivo']));
        }
        
        
        public function ajaxQuotazioni() {
            $post = $this->input->post();
            if(!empty($post)) {            
                $this->italotreno->setStazioni($this->input->post('stazionePartenza', TRUE),$this->input->post('stazioneArrivo', TRUE));
                $this->trenitalia->setStazioni($this->input->post('stazionePartenza', TRUE),$this->input->post('stazioneArrivo', TRUE));
                $this->scanner->setStazioni($this->input->post('stazionePartenza', TRUE),$this->input->post('stazioneArrivo', TRUE));
                $this->italotreno->setPersone();
                $this->italotreno->setData($this->input->post('dataPartenza', TRUE));
                $this->trenitalia->setData($this->input->post('dataPartenza', TRUE));
                $this->scanner->setData($this->input->post('dataPartenza', TRUE));
                
                $data['idPreventivo'] = (int)$this->scanner->checkPreventivo();
                //die(var_dump($data['idPreventivo']));
                
                $this->trenitalia->getQuotazioni($data['idPreventivo']);
                $this->italotreno->getQuotazioni($data['idPreventivo']);
                
                $data['quotazioni'] = $this->scanner->getPreventivoResult($data['idPreventivo']);
            } else $data['quotazioni'] = 'Nessun parametro passato';
            
            $this->load->view('row', $data);
            
        }
        
        protected function renderRow($data) {
        }
        
        protected function _renderPage($data) {
            
            $this->assets->add_js('bootstrap.min.js');
            $this->assets->add_js('main.js');
            $this->assets->add_css('bootstrap.min.css');
            $this->assets->add_external_js('http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js');
            
            $data['css_js'] = $this->assets->render_css_js();
            $this->load->view('home', $data);
        }
      
}
/*
 * 
 */
/* End of file main.php */
/* Location: ./application/controllers/main.php */