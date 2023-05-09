<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup_ extends CI_Controller {

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
  //       $mpdf = new \Mpdf\Mpdf();
		// $mpdf->WriteHTML('<h1>Hello world!</h1>');
		// $mpdf->Output();
    }

	public function index()
	{
		if(!$this->Main_->islogged()){            
            $this->Main_->showSetupPage('main/landing', array());
        }
	}

    public function loginPage(){
    	$this->Main_->showSetupPage("main/login","", "Login");
    }

    public function loadUserTable(){
    	$data = $this->input->post();
    	$data['record'] = $this->setup->getUserList("",$data["type"]);
    	$this->load->view("setup/userTable", $data);
    }

    public function loadLoanTable(){
    	$data = $this->input->post();
    	if ($this->session->userdata("type") == "member") {
    		$data['user_id'] = $this->session->userdata("id");
    		$data['id'] = "";
    	}else{
    		$data['id'] = "";
    		$data['user_id'] = "";
    	}
    	
    	$data['record'] = $this->setup->getUserLoan($data['id'],$data["user_id"]);
    	$this->load->view("setup/loanTable", $data);
    }

	public function updateTransactionStatus()
	{
		$data = $this->input->post();
		$updateData = array();
		if (!isset($data['status'])) $updateData['status'] = "APPROVED";

		$TrasactionType = $this->setup->getTransactionSingleData($data['code'], "type");
		$TransactionUser = $this->setup->getTransactionSingleData($data['code'], "user_id");
		$userMobile = $this->setup->getUserData($TransactionUser, "mobile");

		if ($TrasactionType == "Contribution") {
			$TransactionAmount = $this->setup->getTransactionSingleData($data['code'], "amount");
			
			$getUserFundsAvailable = $this->setup->getUserFundsSingleData($TransactionUser, "available");
			$getUserFundsContribution = $this->setup->getUserFundsSingleData($TransactionUser, "contribution");
			$getUserFundID = $this->setup->getUserFundsSingleData($TransactionUser, "id");

			$this->smsSender($userMobile, "Your contribution is posted amounting:₱" . $TransactionAmount.".00");

			// UPDATE USER FUNDS
			$userFundsData = array();
			$userFundsData['available'] = $getUserFundsAvailable + ($TransactionAmount * 3);
			$userFundsData['contribution'] = $getUserFundsContribution + $TransactionAmount;
			$this->setup->updateData("funds", $userFundsData, $getUserFundID);
		} elseif ($TrasactionType == "Loan Payment" || $TrasactionType == "Loan Fines") {

			$TransactionAmount = $this->setup->getTransactionSingleData($data['code'], "amount");
			$getUserFundsBalance = $this->setup->getUserFundsSingleData($TransactionUser, "balance");
			$getUserFundID = $this->setup->getUserFundsSingleData($TransactionUser, "id");

			// UPDATE USER FUNDS
			$userFundsData = array();
			$userFundsData['balance'] = $getUserFundsBalance - $TransactionAmount;

			$this->setup->updateData("funds", $userFundsData, $getUserFundID);

			if ($TrasactionType == "Loan Payment") {
				$getUserLoanID = $this->setup->getTransactionSingleData($data['code'], "base_id");
				$getUserRemmainingLoan = $this->setup->getUserLoanSingleData($getUserLoanID, "remaining_balance");

				// UPDATE REMAINING BALANCE MONTH
				$userLoanRemainingData = array();
				$userLoanRemainingData['remaining_balance'] = $getUserRemmainingLoan - $TransactionAmount;

				$this->smsSender($userMobile, "Your payment has been posted. Remaining balance is :₱". $userLoanRemainingData['remaining_balance'].".00");

				$this->setup->updateData("loan", $userLoanRemainingData, $getUserLoanID);
			}
		}

		$this->setup->updateData("transactions", $updateData, $data['code']);
		echo "success";
	}

    public function addTransactionFile(){
    	$data = $this->input->post();
    	$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'jpeg|jpg|png|gif|pdf|docx|doc';
        $config['max_size']             = 100000;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        $insertArray = array();
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
        	echo "<pre>";print_r($this->upload->display_errors());die;
        }

        $insertArray['file_link'] = $this->upload->data('file_name');
        $insertArray['file_type'] = $this->upload->data('file_type');
        $insertArray['file_name'] = $this->upload->data('orig_name');
        $insertArray['base_id'] = $data['transactionID'];
        $insertArray['user_id'] = $data['user_id'];
   
   		$this->setup->deleteDataFile("transaction_files", $data['transactionID']);

    	$this->setup->insertData("transaction_files",$insertArray);

    	$insert_id = $this->db->insert_id();

    	$updateData = array();
    	$updateData['file_id'] = $insert_id;

    	$this->setup->updateData("transactions", $updateData, $data['transactionID']);
        echo "success";
    }

    public function loadTransactionTable(){
    	$data = $this->input->post();
    	$id = "";
    	if ($this->session->userdata("type") == "member") $id = $this->session->userdata("id");
    	$data['record'] = $this->setup->getTransactionSetup("","",$id, "",'FIELD(`status`, "PENDING", "APPROVED")', "");
    	// echo "<pre>";print_r($this->db->last_query());die;
    	$this->load->view("setup/transactionTable", $data);
    }

    public function loadActivityTable(){
    	$data = $this->input->post();
    	$id = "";
    	// if ($this->session->userdata("type") == "admin") $id = $this->session->userdata("id");
    	$data['record'] = $this->setup->getTransactionSetup("","","", "",'FIELD(`status`,"APPROVED")', "");
    	$this->load->view("setup/activityTable", $data);
    }

    public function manageTransaction(){
    	$data = $this->input->post();
		if(isset($data['type'])) $type = $data['type'];
		else $type = "";
    	if ($this->session->userdata("type") == "member") {
    		$data['user_id'] = $this->session->userdata("id");
    	}else{
    		$data['user_id'] = "";
    	}
    	
    	if ($data['code'] != "add") {
    		$data['record'] = $this->setup->getTransactionSetup($data["code"]);
	    	$data['record'] = $data['record'][0];
	    }
	    
		$data['type'] = $type;
		// echo"<pre>";print_r($data);die;
		$data['user_list'] = $this->setup->getUserList("","member");
    	$this->load->view("setup/manageTransaction", $data);
    }

	public function loadAnnualTable(){
    	$data = $this->input->post();
    	$data['record'] = $this->setup->getAnnualSetup();
    	$this->load->view("setup/annualTable", $data);
    }

	public function manageAnnual(){
    	$data = $this->input->post();
    	
    	if ($data['code'] != "add") {
    		$data['record'] = $this->setup->getAnnualSetup($data["code"]);
	    	$data['record'] = $data['record'][0];
	    }
    	$this->load->view("setup/manageAnnual", $data);
    }

	public function saveAnnual(){
    	$data = $this->input->post();
		$data['created_by'] = $this->session->userdata("id");
    	if($data['code'] == "add"){
    		unset($data['code']);
    		$this->setup->insertData("annual", $data);
    	}else{
    		$id = $data['code'];
    		unset($data['code']);
    		$this->setup->updateData("annual", $data, $id);
    	}
    	echo "success";
    }

    public function manageLoan(){
    	$data = $this->input->post();
		if(isset($data['type'])) $type = $data['type'];
		else $type = "";
    	if ($this->session->userdata("type") == "member") {
    		$data['user_id'] = $this->session->userdata("id");
    	}else{
    		$data['user_id'] = "";
    	}
    	
    	if ($data['code'] != "add") {
    		$data['record'] = $this->setup->getUserLoan($data["code"]);
	    	$data['record'] = $data['record'][0];
	    }

		$data['user_list'] = $this->setup->getUserListWithFund($data['user_id'],"member");
		
		$data['user_funds'] = $this->setup->getUserFunds("",$data['user_id']);

		$data['current_interest'] = $this->setup->getAnnualInterest();

		$data['type'] = $type;
		// echo"<pre>";print_r($data);die;
    	$this->load->view("setup/manageLoan", $data);
    }

    public function manageUser(){
    	$data = $this->input->post();
    	if ($data['code'] != "add") {
    		$data['record'] = $this->setup->getUserList($data["code"]);
	    	$data['record'] = $data['record'][0];
	    }
	    $data['share'] = $this->setup->getAnnualShareAmount();
    	$this->load->view("setup/manageUser", $data);
    }

    public function saveUser(){
    	$data = $this->input->post();
    	if(isset($data['password']) && $data['password'] != "") $data['password'] = md5($data['password']);
    	else unset($data['password']);

    	$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['max_size']             = 100000;
        $config['max_width']            = 0;
        $config['max_height']           = 0;

        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                echo "<pre>";print_r($this->upload->display_errors());die;
            }
            $data['image_link'] = $this->upload->data('file_name');
        }
        // echo"<pre>";print_r($_FILES);die;
    	if($data['code'] == "add"){
    		unset($data['code']);
			$this->setup->insertData("users", $data);
			$id = $this->db->insert_id();
			if($data['type'] == "member" && $data['status'] == "Verified"){
				//Create Account Funds
				$dataFunds = array();
				$dataFunds['user_id'] = $id;
				$dataFunds['available'] = $data['contribution'] * 3;
				$dataFunds['balance'] = 0;
				$dataFunds['contribution'] = $data['contribution'];

				//create transaction
				$dataTransaction = array();
				$dataTransaction['user_id'] = $id;
				$dataTransaction['type'] = "Contribution";
				$dataTransaction['amount'] = $data['contribution'];
				$dataTransaction['created_by'] = $id;
				$dataTransaction['approve_by'] = $this->session->userdata("id");
				$dataTransaction['status'] = "APPROVED";
				$dataTransaction['remarks'] = "Member Contribution";

				// $this->load->model('Emailcon');
				
				// $message = $this->accountConfirmationEmail($data['name']);
				// $this->Emailcon->sendConfirmationEmail($message, $data['email']);
				$this->smsSender($data['mobile'],"Your account has been confirm and created you may try login your account in our system. ".base_url());
				$this->smsSender($data['mobile'],"We have receive your contribution amounting ".$data['contribution'].". You have an available amount of ".$dataFunds['available']);
				$this->setup->insertData("funds", $dataFunds);
				$this->setup->insertData("transactions", $dataTransaction);
			}

    	}else{
    		$id = $data['code'];
    		unset($data['code']);
    		unset($data['member']);
    		$checkIfNeedNotif = $this->setup->checkUserStatus($id);
    		$getFirstContri = $this->setup->getFirstcontribution($id);
    		if ($checkIfNeedNotif) {
	
	            $this->load->model('Emailcon');
	            
	            // $message = $this->accountConfirmationEmail($data['name']);
	            // $this->Emailcon->sendConfirmationEmail($message, $data['email']);
	            $this->smsSender($data['mobile'],"Your account has been confirm you may try login your account in our system");
	            
				if($data['type'] == "member"){
					//Create Account Funds
					$dataFunds = array();
					$dataFunds['user_id'] = $id;
					$dataFunds['available'] = $getFirstContri * 3;
					$dataFunds['balance'] = 0;
					$dataFunds['contribution'] = $getFirstContri;
	
					//create transaction
					$dataTransaction = array();
					$dataTransaction['user_id'] = $id;
					$dataTransaction['type'] = "Contribution";
					$dataTransaction['amount'] = $getFirstContri;
					$dataTransaction['created_by'] = $id;
					$dataTransaction['approve_by'] = $this->session->userdata("id");
					$dataTransaction['status'] = "APPROVED";
					$dataTransaction['remarks'] = "Member Contribution";

					$this->smsSender($data['mobile'],"We have receive your contribution amounting ".$getFirstContri.". You have an available amount of ".$dataFunds['available']);
					$this->setup->insertData("funds", $dataFunds);
					$this->setup->insertData("transactions", $dataTransaction);
				}

    		}
    		$this->setup->updateData("users", $data, $id);
    	}
    	echo "success";
    }

    public function saveTransaction(){
    	$data = $this->input->post();
    	
    	// echo"<pre>";print_r($data);die;
    	if($data['code'] == "add"){
    		unset($data['code']);
    		$data['created_by'] = $this->session->userdata('id');
			$data['status'] == "PENDING";
    		// if ($data['status'] == "APPROVED") $data['approve_by'] =$this->session->userdata('id');
    		$userMobile = $this->setup->getUserData($data['user_id'], "mobile");
    		$userEmail = $this->setup->getUserData($data['user_id'], "email");
    		$userAddress = $this->setup->getUserData($data['user_id'], "address");
    		$userName = $this->setup->getUserData($data['user_id'], "name");

    		$this->load->model('Emailcon');

    		$this->setup->insertData("transactions", $data);
    		$insert_id = $this->db->insert_id();

    		//Send email confirmation
    		$message = $this->loanRequestEmail($userName, $userAddress, $insert_id, $data['type']." Request ".ucfirst(strtolower($data['status'])), "A transaction has been created by ".$this->setup->getUserData($this->session->userdata('id'), "name"));
	        // $this->Emailcon->sendEmail($message, $userEmail, $data['type']." Request");
	        // $this->smsSender($userMobile,"Hello".$userName.", A ".$data['type']." transaction has been created by ".$this->setup->getUserData($this->session->userdata('id'), "name")." and is now ".ucfirst(strtolower($data['status'])).". Your reference number is:".$insert_id);
    	}
    	echo "success";
    }

    public function saveLoan(){
    	$data = $this->input->post();
    	
    	if($data['code'] == "add"){
    		unset($data['code']);
    		$data['requested_by'] = $this->session->userdata('id');
    		$data['remaining_balance'] = $data['monthly'] * $data['months_period'];
    		$data['total_loan_amount'] = $data["remaining_balance"];
    		$data['interest'] = $data['remaining_balance'] - $data['amount'];
    		$data['months_paid'] = 0;

			$activeLoanChecker = $this->setup->getUserLoan("", $data['user_id'], "ACTIVE");

			if(count($activeLoanChecker) > 2){
				echo "over";
				die;
			}

    		$userMobile = $this->setup->getUserData($data['user_id'], "mobile");
    		$userEmail = $this->setup->getUserData($data['user_id'], "email");
    		$userAddress = $this->setup->getUserData($data['user_id'], "address");
    		$userName = $this->setup->getUserData($data['user_id'], "name");

    		$this->load->model('Emailcon');

    		$this->setup->insertData("loan", $data);
    		$insert_id = $this->db->insert_id();
    		// $insert_id = "143";
    		//Send email confirmation
    		// $message = $this->loanRequestEmail($userName, $userAddress, $insert_id, "Loan Request Pending", "We have receive your loan request please wait for the approval of the admin.");
	        // $this->Emailcon->sendEmail($message, $userEmail, "Loan Request");
	       
	        //Send SMS notif to all admin
	        $userAdmin = $this->setup->getUserList("","admin");
	        foreach ($userAdmin as $key => $value) {
	        	$this->smsSender($value['mobile'],"There's a new loan request receive from ".$userName." amounting to ".$data['amount'].".");
	        }

	        //Send SMS notif to all treasurer
	        $userAdmin = $this->setup->getUserList("","treasurer");
	        foreach ($userAdmin as $key => $value) {
	        	$this->smsSender($value['mobile'],"There's a new loan request receive from ".$userName." amounting to ".$data['amount'].".");
	        }

	        $this->smsSender($userMobile,"We have receive your request on loaning an amount of ".$data['amount'].". Please wait for the confirmation of the admin to approve your request. Reference Number: ".$insert_id);
    	}else{
    		$id = $data['code'];
    		unset($data['code']);
    		unset($data['member']);
    		$checkIfNeedNotif = $this->setup->checkLoanStatus($id);
    		if (!$checkIfNeedNotif && $data['status'] == "APPROVED") {
    			$data['approve_by'] = $this->session->userdata("id");
	            $this->load->model('Emailcon');
	            $userMobile = $this->setup->getUserData($data['user_id'], "mobile");
	    		$userEmail = $this->setup->getUserData($data['user_id'], "email");
	    		$userAddress = $this->setup->getUserData($data['user_id'], "address");
	    		$userName = $this->setup->getUserData($data['user_id'], "name");

	    		$userAvailable = $this->setup->getUserFundsData($data['user_id'], "available");
	    		$balance = $this->setup->getUserFundsData($data['user_id'], "balance");
	    		//Update Account Funds
				$dataFunds = array();
				$dataFunds['available'] = $userAvailable - $data['amount'];
				$dataFunds['balance'] = $balance + $data['amount'];
				$this->setup->updateDataUserid("funds", $dataFunds, $data['user_id']);
				// echo "<pre>";print_r($this->db->last_query());die;
	    		//create transaction
				$dataTransaction = array();
				$dataTransaction['user_id'] = $data['user_id'];
				$dataTransaction['type'] = "Loan";
				$dataTransaction['amount'] = $data['amount'];

				$dataTransaction['created_by'] = $data['user_id'];
				$dataTransaction['approve_by'] = $this->session->userdata("id");
				$dataTransaction['status'] = "APPROVED";
				$dataTransaction['remarks'] = "Members Approved Loan";
				
				$this->setup->insertData("transactions", $dataTransaction);
				$insert_id = $this->db->insert_id();

				$this->smsSender($userMobile,"Your loan request has been approved please go to out nearest treasurer to claim your funds amounting ".$data['amount']);


	            // $message = $this->loanRequestEmail($userName, $userAddress, $insert_id, "Loan Request Approved", "Your loan request has been approved please go to out nearest treasurer to claim your funds amounting ".$data['amount'].". Reference Number: ".$insert_id);
	        	// $this->Emailcon->sendEmail($message, $userEmail, "Loan Request Approved");

	        	
	        	//Send SMS notif to all treasurer
		        // $userAdmin = $this->setup->getUserList("","treasurer");
		        // foreach ($userAdmin as $key => $value) {
		        // 	$this->smsSender($value['mobile'],"There's a loan request approved to ".$userName." amounting to ".$data['amount'].".");
		        // }

    		}elseif(!$checkIfNeedNotif && $data['status'] == "DISAPPROVED"){

    			// $message = $this->loanRequestEmail($userName, $userAddress, $insert_id, "Loan Request Disapproved", "Your loan request has been disapproved by our admin.");
	        	// $this->Emailcon->sendEmail($message, $userEmail, "Loan Request Approved");

	        	$this->smsSender($userMobile,"Your loan request has been disapproved by our admin.");
    		}

    		$this->setup->updateData("loan", $data, $id);
    	}
    	echo "success";
    }

	public function deleteLoan(){
    	$data = $this->input->post();
    	$this->setup->deleteData("loan", $data['code']);
    	echo "success";
    }

    function loanRequestEmail($name, $address, $ref, $title, $description){
        $data['name'] = $name;
        $data['address'] = $address;
        $data['ref'] = $ref;
        $data['title'] = $title;
        $data['description'] = $description;
        return $this->load->view("email/loanRequest", $data, TRUE);
    }

    function accountConfirmationEmail($name){
        $data['name'] = $name;
        return $this->load->view("email/accountConfirmation", $data, TRUE);
    }

    function smsSender($number,$msg){

        $sms = urlencode($msg);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"http://122.54.191.90:8085/goip_send_sms.html?username=root&password=root&port=2&recipients=".$number."&sms=".$sms);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close ($ch);
        return "success";
    }

    public function getUserTransactionPerMonth(){
		$annualYear = $this->setup->getAnnualSetup("", "ACTIVE");
    	// $months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');
		$start    = (new DateTime($annualYear[0]['from_date']))->modify('first day of this month');
		$end      = (new DateTime($annualYear[0]['to_date']))->modify('first day of next month');
		$interval = DateInterval::createFromDateString('1 month');
		$period   = new DatePeriod($start, $interval, $end);
		
		// echo"<pre>";print_r($annualYear);die;
    	$data = "[";
		$month = "[";
		foreach ($period as $dt) {
			$val = $this->setup->getDataMonthly($this->session->userdata("id"), $dt->format("m"), $dt->format("Y"));
    		if ($val[0]['total'] != "") {	
    			$data = $data.$val[0]['total'].",";
    		}else{
    			$data = $data."0,";
    		}
			$month = $month.'"'.$dt->format("F Y").'",';
		}
    	$data = substr($data, 0, -1); 
    	$data = $data."]";
		$month = substr($month, 0, -1); 
    	$month = $month."]";
		$return['data'] = $data;
		$return['month'] = $month;
		// echo"<pre>";print_r(json_encode($return));die;
    	echo json_encode($return);
    }

    public function getTotalFunds(){
    	$shareAmount = $this->setup->getAnnualShareAmount();
    	$annualMonthsPassed = $this->setup->getAnnualMonth();
    	$annualMonthsPassed += 1;
		$totalFunds = $this->setup->getTotalFundsPerUserShare();
		$totalFunds = ($shareAmount * $totalFunds[0]['total']) * $annualMonthsPassed;
		$currentFunds = $this->setup->getDataMonthly();
		$currentFunds = ($currentFunds[0]['total'])? $currentFunds[0]['total']:0;
		$totalLoan = $this->setup->getDataMonthly("","","","Loan");
		$totalLoan = ($totalLoan[0]['total'])? $totalLoan[0]['total']:0;
		$unpaidFunds = ($currentFunds - $totalFunds);
		$return['data'] = "[".$currentFunds.",".$totalLoan.",".$unpaidFunds."]";
		// echo"<pre>";print_r($shareAmount);die;
		// echo"<pre>";print_r(json_encode($return));die;
    	echo json_encode($return);
    }

    public function deleteUser(){
    	$data = $this->input->post();
    	$this->setup->deleteData("users", $data['code']);
    	echo "success";
    }

    public function deleteAnnual(){
    	$data = $this->input->post();
    	$this->setup->deleteData("annual", $data['code']);
    	echo "success";
    }

    public function loadRecentTransaction(){
    	$data['record'] = $this->setup->getRecentTransaction();
    	$this->load->view("setup/recentTransactionTable", $data);
    }

    function PDFprint(){
        $data = $this->input->post();
        $data['user_list'] = $this->setup->getUserList("","member");
        // echo"<pre>";print_r($data);die;
        $this->load->view('report_filter', $data);
    }

    function userReport(){
        $data = $this->input->post();
        // echo"<pre>";print_r($data);die;
        $this->load->view("pdf/userlistPDF", $data); 
    }

    function transactionReport(){
        $data = $this->input->post();
        // echo"<pre>";print_r($data);die;
        $this->load->view("pdf/transactionPDF", $data); 
    }

    function transactionIndiReport(){
        $data = $this->input->post();
        // echo"<pre>";print_r($data);dies;
        $this->load->view("pdf/transactionIndividualPDF", $data); 
    }

    function annualReport(){
        $data = $this->input->post();
        // echo"<pre>";print_r($data);die;
        $this->load->view("pdf/annualPDF", $data); 
    }
}
