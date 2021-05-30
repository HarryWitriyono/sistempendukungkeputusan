<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if (isset($_SESSION['_userid'])) {
			$this->load->view('header');
			$this->load->view('blank');
			$this->load->view('footer');
		} else {
			$this->load->view('login');
		}
	}
	public function menuutama()
	{
		if (isset($_SESSION['_userid'])) {
			$this->load->view('header');
			$this->load->view('blank');
			$this->load->view('footer');
		} else {
			session_destroy();
			$this->load->view('login');
		}
	}
	public function backupdb()
	{
		$this->load->view('header');
		$this->load->dbutil();
		$backup = $this->dbutil->backup();
		$this->load->helper('file');
		write_file('/path/to/spk.gz', $backup);
		$this->load->helper('download');
		force_download('spk.gz', $backup);
		$this->load->view('footer');
	}
	public function oldindex()
	{
		$this->load->view('welcome_message');
	}
}
