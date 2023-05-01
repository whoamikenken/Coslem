<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_ extends CI_Controller {

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

	function __construct(){
        parent::__construct();
    }

	public function index()
	{
		if(!$this->islogged()){    
            $this->showSetupPage('main/landing', array(),"COSLEM", false);
        }else{
            $data['user_funds'] = $this->setup->getUserFunds("",$this->session->userdata("id"));
            $data['memberCount'] = $this->setup->countUser("member");
            $data['treasurerCount'] = $this->setup->countUser("treasurer");
            $data['adminCount'] = $this->setup->countUser("admin");
            $data['transactionCount'] = $this->setup->countTransaction();
            $data['loanAmountMontly'] = $this->setup->getUserLoanDataActive($this->session->userdata("id"), "monthly");
            $data['remainingBalance'] = $this->setup->getUserLoanDataActive($this->session->userdata("id"), "remaining_balance");
            // echo "<pre>";print_r($data);die;
        	$this->showSetupPage("includes/dashboard",$data, "Dashboard");
        }
	}

	public function site(){
        if(!$this->islogged()){            
            $this->loginPage();
            return;
        }

        $data['title'] = $this->input->post("titlebar");
        $data['sitename'] = $this->input->post("sitename");
        $data['autoload'] = '';
        
      
        if($data['sitename'] != "")
		$this->showSetupPage($data['sitename'], $data, $data['title']);
        else
          $this->index();
    }

	public function islogged(){
        return $this->session->userdata("logged_in");
    }

    public function loginPage(){
    	$this->showSetupPage("main/login","", "Login", false);
    }

    public function signUpPage(){
    	$this->showSetupPage("main/singUp","", "Sign-Up", false);
    }

	public function showSetupPage($view, $data, $title = "COSLEM", $nav = true){
		$this->load->view('includes/header', array('title' => $title));
		if($nav) $this->load->view('includes/nav-header');
		$this->load->view('includes/modal');
		$this->load->view($view, $data);
		$this->load->view('includes/footer');
	}

	public function validateLogin(){
        $uname = $this->input->post("username");
        $upass = $this->input->post("password");
        $this->db->where('username',$uname);
        $this->db->where('password',md5($upass));
        $query = $this->db->get('users');
        $queryLogin = $query->result_array();
        
        
        if(count($queryLogin) > 0 && $queryLogin[0]['status'] == "Unverified"){
            echo "Unverified";
        }elseif(count($queryLogin) > 0){
            $queryLogin = $queryLogin[0];
            $queryLogin['logged_in'] = TRUE;
            $sess = $queryLogin;
            $this->session->set_userdata($sess);

            $this->session->sess_expiration = 2400; 
            echo "success";        
        }else echo "failed";  
    }

    public function logout(){
    	$this->session->sess_destroy();
    }

    public function registerUser(){
    	$data = $this->input->post();
    	$data['type'] = 'member';
		$data['status'] = 'Unverified';
		$data['password'] = md5($data['password']);
    	$this->setup->insertData("users", $data);
    	$this->smsSenderMain($data['mobile'],"Hello, ".$data["name"].". Please pay your ".$data['contribution']." contribution in one of our treasurer to confirm your application");
    	echo "success";
    }

    public function createTransactionMonthlyLoan()
    {
        $this->load->model('Emailcon');
        if (date("d") == 01) {
            $record = $this->setup->getUserLoanDataForMonthlyBilling();
            // echo "<pre>";print_r($this->db->last_query());die;
            // echo"<pre>";print_r($record);die;
            foreach ($record as $key => $value) {
               // Create Transaction monthly for loan
                $dataTransaction = array();
                $dataTransaction['user_id'] = $value['user_id'];
                $dataTransaction['base_id'] = $value['id'];
                $dataTransaction['type'] = "Loan Payment";
                $dataTransaction['amount'] = $value['monthly'];
                $dataTransaction['created_by'] = "1";
                $dataTransaction['approve_by'] = "1";
                $dataTransaction['status'] = "PENDING";
                $dataTransaction['remarks'] = "Monthly Loan Payment";
                $this->setup->insertData("transactions", $dataTransaction);
                $insert_id = $this->db->insert_id();

                $this->smsSenderMain($value['mobile'] ,"Hello, ".$value["name"].". Please pay your ₱".$value['monthly'].".00 loan in one of our treasurer.");

                // $message = $this->loanRequestEmailMain($value['name'], $value['address'], $insert_id, "Loan Payment", "Please pay your loan amounting ".$value['amount'].".00 to any of our treasurer.");
                // $this->Emailcon->sendEmail($message, $value['email'], "Loan Request Payment");
            }
        }
    }

    public function createMonthlyTransactionTest()
    {
        $this->load->model('Emailcon');
        // if (date("d") == 01) {
        $record = $this->setup->getUserLoanDataForMonthlyBilling();
        // echo "<pre>";print_r($this->db->last_query());die;
        // echo"<pre>";print_r($record);die;
        foreach ($record as $key => $value) {
            // Create Transaction monthly for loan
            $dataTransaction = array();
            $dataTransaction['user_id'] = $value['user_id'];
            $dataTransaction['base_id'] = $value['id'];
            $dataTransaction['type'] = "Loan Payment";
            $dataTransaction['amount'] = $value['monthly'];
            $dataTransaction['created_by'] = "1";
            $dataTransaction['approve_by'] = "1";
            $dataTransaction['status'] = "PENDING";
            $dataTransaction['remarks'] = "Monthly Loan Payment";
            $this->setup->insertData("transactions", $dataTransaction);
            $insert_id = $this->db->insert_id();

            $this->smsSenderMain($value['mobile'], "Hello, " . $value["name"] . ". Please pay your ₱" . $value['monthly'] . ".00 loan in one of our treasurer.");

            // $message = $this->loanRequestEmailMain($value['name'], $value['address'], $insert_id, "Loan Payment", "Please pay your loan amounting ".$value['amount'].".00 to any of our treasurer.");
            // $this->Emailcon->sendEmail($message, $value['email'], "Loan Request Payment");
        }
        // }
    }

    public function createTransactionMonthlyContribution()
    {
        $this->load->model('Emailcon');
        if (date("d") == 20) {
            $record = $this->setup->getUserList("", "member");
            foreach ($record as $key => $value) {
               // Create Transaction monthly for loan
                $dataTransaction = array();
                $dataTransaction['user_id'] = $value['id'];
                $dataTransaction['type'] = "Contribution";
                $dataTransaction['amount'] = $value['contribution'];
                $dataTransaction['created_by'] = "1";
                $dataTransaction['approve_by'] = "1";
                $dataTransaction['status'] = "PENDING";
                $dataTransaction['remarks'] = "Members Monthly Saving";
                $this->setup->insertData("transactions", $dataTransaction);
                $insert_id = $this->db->insert_id();

                $this->smsSenderMain($value['mobile'] ,"Hello, ".$value["name"].". Please pay your ₱".$value['contribution']." contribution in one of our treasurer.");

                // $message = $this->loanRequestEmailMain($value['name'], $value['address'], $insert_id, "Contribution Payment", "Please pay your contribution amounting ".$value['contribution']." to any of our treasurer. Reference Number: ".$insert_id);
                // $this->Emailcon->sendEmail($message, $value['email'], "Contribution Request Payment");
            }   
        }
    }

    function smsSenderMain($number,$msg){

        $sms = urlencode($msg);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"http://122.54.191.90:8085/goip_send_sms.html?username=root&password=root&port=2&recipients=".$number."&sms=".$sms);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close ($ch);
        return "success";
    }

    function loanRequestEmailMain($name, $address, $ref, $title, $description){
        $data['name'] = $name;
        $data['address'] = $address;
        $data['ref'] = $ref;
        $data['title'] = $title;
        $data['description'] = $description;
        return $this->load->view("email/loanRequest", $data, TRUE);
    }

    public function sendSecurityCode(){
        $uname = $this->input->post("username");
        $this->db->where('username',$uname);
        $query = $this->db->get('users');
        $queryLogin = $query->result_array();
        // echo "<pre>";print_r($this->db->last_query());die;
        $number = $queryLogin[0]['mobile'];

        if (isset($queryLogin[0]['mobile'])) {
            $key = $this->setup->generateRandomPasswordNumber();
            $this->smsSenderMain($queryLogin[0]['mobile'], "Hello, ".$queryLogin[0]["name"].". This is your OTP code:".$key);
            echo $key;
        }else{
            echo "nonumber";
        }
    }
}
