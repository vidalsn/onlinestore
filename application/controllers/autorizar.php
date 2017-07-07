<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'abstractcontroller.php';

class Autorizar extends AbstractController {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct(){
        parent::__construct();
    }


	public function index()
	{
	    if($this->session->userdata('login')) {
	        if($this->session->userdata('tipo')=='1')
                redirect('administrador');
            else
                redirect('indice');
        }
        else {

            
            if($this->is_post()){

                
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                
                $this->load->model('Usuario');
                
                $result = $this->Usuario->login($email,$password);
                               

                if($result) {

                    
                    $sess_array = array();
                    foreach ($result as $row) {
                        $sess_array = array(
                            'id' => $row->id,
                            'nombre' => $row->nombre.' '.$row->apellidos,
                            'tipo' => $row->usuarios_tipos_id,
                            'login' => TRUE
                        );
                        $this->session->set_userdata($sess_array);
                    }
                    if($this->session->userdata('tipo')=='1')
                    {
                        redirect('administrador');
                    }
                    else
                        redirect('indice');
                }
                else $this->load->view('autorizar/index',array('login'=>0));
            }
            else{

				$this->load->view('autorizar/index');

            }
		}
	   
    }

    public function salir(){
        $this->session->unset_userdata('login');
        session_destroy();
        redirect('autorizar', 'refresh');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */