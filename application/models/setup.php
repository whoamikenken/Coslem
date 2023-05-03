<?php 
set_time_limit(0);
ini_set('max_execution_time', 0);
ini_set("memory_limit",-1);

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup extends CI_Model {

    public function getUserList($id = "", $type = ""){
        $this->db->select('*');
        if ($id) $this->db->where('id', $id);
        if ($type) $this->db->where('type', $type);
        return $this->db->get('users')->result_array();
    }

    public function getUserLoan($id = "", $user_id = "", $isactive ="", $group_by = ""){
        $this->db->select('*');
        if ($id) $this->db->where('id', $id);
        if ($user_id) $this->db->where('user_id', $user_id);
        if ($isactive) $this->db->where('isactive', $isactive);
        if ($group_by) $this->db->group_by($group_by); 
        
        return $this->db->get('loan')->result_array();
    }

    public function getUserListWithFund($id = "", $type = "")
    {
        $wh = "";
        if ($id) $wh .= " AND id = '$id'";
        if ($type) $wh .= " AND type = '$type'";
        return $this->db->query("SELECT a.*, b. available FROM users a INNER JOIN funds b ON a.id = b.user_id WHERE 1 = 1 $wh")->result_array();
    }

    public function getUserFunds($id = "", $user_id = ""){
        $this->db->select('*');
        if ($id) $this->db->where('id', $id);
        if ($user_id) $this->db->where('user_id', $user_id);
        return $this->db->get('funds')->result_array();
    }

    public function getAnnualSetup($id = "", $status = ""){
        $this->db->select('*');
        if ($id) $this->db->where('id', $id);
        if ($status) $this->db->where('status', $status);
        return $this->db->get('annual')->result_array();
    }

    public function getTransactionSetup($id = "", $status = "", $user_id = "", $type = "", $order_by = "", $order_type = ""){
        $this->db->select('*');
        if ($id) $this->db->where('id', $id);
        if ($status) $this->db->where('status', $status);
        if ($user_id) $this->db->where('user_id', $user_id);
        if ($type) $this->db->where('type', $type);
        if ($order_by) $this->db->order_by($order_by, $order_type);
        return $this->db->get('transactions')->result_array();
    }

    public function getRecentTransaction(){
        $this->db->select('*');
        if ($this->session->userdata("type") == "member") $this->db->where('user_id', $this->session->userdata("id"));
        $this->db->order_by('timestamp', 'ASC');
        return $this->db->get('transactions')->result_array();
    }

    public function getDataMonthly($user_id = "", $month = "", $year = "", $type = "Contribution"){
        $this->db->select('SUM(amount) as total');
        if ($user_id && $this->session->userdata("type") == "member") $this->db->where('user_id', $user_id);
        if ($month) $this->db->where('MONTH(DATE(timestamp))', $month);
        if ($year) $this->db->where('YEAR(DATE(timestamp))', $year);
        $this->db->where('type', $type);
        return $this->db->get('transactions')->result_array();
    }

    public function getTotalFundsPerUserShare(){
        $this->db->select('SUM(share) as total');
        $this->db->where('type', 'member');
        return $this->db->get('users')->result_array();
    }
    
    public function getTotalContributionUser($dateFrom, $dateTo, $user_id= ""){
        $query = $this->db->query("SELECT SUM(amount) as total FROM transactions WHERE DATE(`timestamp`) BETWEEN '$dateFrom' AND '$dateTo' AND `user_id` = '$user_id' AND `type` = 'Contribution' AND `status` = 'APPROVED' ")->result_array();
        if ($query[0]['total'] != "") {
            return $query[0]['total'];
        }else{
            return 0;
        }
    }

    public function getUserLoanTotalAmount($user_id= ""){
        $query = $this->db->query("SELECT SUM(total_loan_amount) as total FROM loan WHERE `user_id` = '$user_id' AND `status` = 'APPROVED' ")->result_array();
        if ($query[0]['total'] != "") {
            return $query[0]['total'];
        }else{
            return 0;
        }
    }

    public function getUserLoanAmount($user_id= ""){
        $query = $this->db->query("SELECT SUM(amount) as total FROM loan WHERE `user_id` = '$user_id' AND `status` = 'APPROVED' ")->result_array();
        if ($query[0]['total'] != "") {
            return $query[0]['total'];
        }else{
            return 0;
        }
    }

    public function getUserLoanRemainingBalance($user_id= ""){
        $query = $this->db->query("SELECT SUM(remaining_balance) as total FROM loan WHERE `user_id` = '$user_id' AND `status` = 'APPROVED' ")->result_array();
        if ($query[0]['total'] != "") {
            return $query[0]['total'];
        }else{
            return 0;
        }
    }

    public function getUserLoanInterest($user_id= ""){
        $query = $this->db->query("SELECT SUM(interest) as total FROM loan WHERE `user_id` = '$user_id' AND `status` = 'APPROVED' ")->result_array();
        if ($query[0]['total'] != "") {
            return $query[0]['total'];
        }else{
            return 0;
        }
    }

    public function getTotalLoanUser($dateFrom, $dateTo, $user_id= ""){
        $query = $this->db->query("SELECT SUM(amount) as total FROM transactions WHERE DATE(`timestamp`) BETWEEN '$dateFrom' AND '$dateTo' AND `user_id` = '$user_id' AND `type` = 'Loan Payment' AND `status` = 'APPROVED' ")->result_array();
        if ($query[0]['total'] != "") {
            return $query[0]['total'];
        }else{
            return 0;
        }
    }

    public function updateDataUserid($table, $data, $user_id){
        $this->db->where('user_id', $user_id);
        return $this->db->update($table, $data);
    }

    public function insertData($table, $data){
        return $this->db->insert($table, $data);
    }

    public function updateData($table, $data, $id){
        $this->db->where('id', $id);
        return $this->db->update($table, $data);
    }

    public function deleteData($table, $id){
        $this->db->where('id', $id);
        return $this->db->delete($table);
    }

    public function deleteDataFile($table, $id){
        $this->db->where('base_id', $id);
        return $this->db->delete($table);
    }

    public function checkUserStatus($id){
        $this->db->select('*');
        if ($id) $this->db->where('id', $id);
        $res = $this->db->get('users')->result_array();
        if (count($res) > 0 && $res[0]['status'] == 'Unverified') {
            return true;
        }else{
            return false;
        }
    }

    public function countPendingContribution(){
        $this->db->select('*');
        if ($this->session->userdata("type") == "member") $this->db->where('user_id', $this->session->userdata("id"));
        $this->db->where('type', "Contribution");
        $this->db->where('status', "PENDING");
        $res = $this->db->get('transactions')->result_array();
        if (count($res) > 0) {
            return count($res);
        }else{
            return 0;
        }
    }

    public function countPendingLoan(){
        $this->db->select('*');
        $this->db->where('status', "PENDING");
        $res = $this->db->get('loan')->result_array();
        if (count($res) > 0) {
            return count($res);
        }else{
            return 0;
        }
    }

    public function checkLoanStatus($id){
        $this->db->select('*');
        if ($id) $this->db->where('id', $id);
        $res = $this->db->get('loan')->result_array();
        if (count($res) > 0 && $res[0]['status'] == 'APPROVED') {
            return true;
        }else{
            return false;
        }
    }

    public function getFirstcontribution($id){
        $this->db->select('contribution');
        if ($id) $this->db->where('id', $id);
        $res = $this->db->get('users')->result_array();
        if (count($res) > 0) {
            return $res[0]['contribution'];
        }else{
            return "false";
        }
    }

    public function getUserName($id){
        $this->db->select('name');
        if ($id) $this->db->where('id', $id);
        $res = $this->db->get('users')->result_array();
        if (count($res) > 0) {
            return $res[0]['name'];
        }else{
            return "false";
        }
    }

    public function getUserData($id, $column){
        $this->db->select($column);
        if ($id) $this->db->where('id', $id);
        $res = $this->db->get('users')->result_array();
        if (count($res) > 0) {
            return $res[0][$column];
        }else{
            return "false";
        }
    }

    public function getUserFundsData($user_id, $column){
        $this->db->select($column);
        if ($user_id) $this->db->where('user_id', $user_id);
        $res = $this->db->get('funds')->result_array();
        if (count($res) > 0) {
            return $res[0][$column];
        }else{
            return "false";
        }
    }

    public function getAnnualShareAmount(){
        $this->db->select('share');
        $this->db->where('status', "ACTIVE");
        $res = $this->db->get('annual')->result_array();
        if (count($res) > 0) {
            return $res[0]['share'];
        }else{
            return "false";
        }
    }

    public function getAnnualInterest()
    {
        $this->db->select('loan_interest');
        $this->db->where('status', "ACTIVE");
        $res = $this->db->get('annual')->result_array();
        if (count($res) > 0) {
            return $res[0]['loan_interest'];
        } else {
            return "5";
        }
    }

    public function getAnnualInterestPenaltyAmount()
    {
        $this->db->select('loan_penalty');
        $this->db->where('status', "ACTIVE");
        $res = $this->db->get('annual')->result_array();
        if (count($res) > 0) {
            return $res[0]['loan_penalty'];
        } else {
            return "false";
        }
    }

    public function getAnnualMonth(){
        $this->db->select('TIMESTAMPDIFF(MONTH, from_date, CURRENT_DATE) AS `month`');
        $this->db->where('status', "ACTIVE");
        $res = $this->db->get('annual')->result_array();
        if (count($res) > 0) {
            return $res[0]['month'];
        }else{
            return "false";
        }
    }

    public function getUserLoanDataActive($user_id, $column){
        $this->db->select("SUM(monthly) AS monthly, SUM(remaining_balance) AS remaining_balance");
        if ($user_id) $this->db->where('user_id', $user_id);
        $this->db->where('status', "APPROVED");
        $this->db->where('CURRENT_DATE BETWEEN', "from_date AND to_date", false);
        $res = $this->db->get('loan')->result_array();
        if (count($res) > 0) {
            return $res[0][$column];
        }else{
            return "false";
        }
    }

    public function getUserLoanDataForMonthlyBilling(){
        $this->db->select("loan.*, users.mobile, users.email, users.name, users.address");
        // if ($user_id) $this->db->where('user_id', $user_id);
        $this->db->where('loan.status', "APPROVED");
        $this->db->where('loan.isactive', "ACTIVE");
        $this->db->where('CURRENT_DATE BETWEEN', "loan.from_date AND loan.to_date", false);
        $this->db->from('loan');
        $this->db->join('users', 'loan.user_id = users.id');
        return $this->db->get()->result_array();
    }

    public function countUser($type = ""){
        $this->db->select('count(*) as total');
        if ($type) $this->db->where('type', $type);
        $res = $this->db->get('users')->result_array();
        if (count($res) > 0) {
            return $res[0]['total'];
        }else{
            return "0";
        }
    }

    public function countTransaction($type = ""){
        $this->db->select('count(*) as total');
        if ($type) $this->db->where('type', $type);
        $res = $this->db->get('transactions')->result_array();
        if (count($res) > 0) {
            return $res[0]['total'];
        }else{
            return "0";
        }
    }

    function getUserImage($id){
        $this->db->select('*');
        if ($id) $this->db->where('id', $id);
        $data = $this->db->get('users')->result_array();
        if (isset($data[0]['image_link'])) {
            return base_url()."uploads/".$data[0]['image_link'];
        }else{
            return base_url()."images/user.png";
        }
    }

    function monthCouter($date1, $date2){
        $begin = new DateTime( $date1 );
        $end = new DateTime( $date2 );
        // $end = $end->modify( '+1 month' );

        $interval = DateInterval::createFromDateString('1 month');

        $period = new DatePeriod($begin, $interval, $end);
        $counter = 0;
        foreach($period as $dt) {
            $counter++;
        }

        return $counter;
    }

    function getFileLink($id){
        $this->db->select('*');
        if ($id) $this->db->where('id', $id);
        $data = $this->db->get('transaction_files')->result_array();
        return base_url()."uploads/".$data[0]['file_link'];
    }

    public function generateRandomPasswordNumber($length = 6){
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getTransactionSingleData($id, $column)
    {
        $this->db->select($column);
        if ($id) $this->db->where('id', $id);
        $res = $this->db->get('transactions')->result_array();
        if (count($res) > 0) {
            return $res[0][$column];
        } else {
            return "false";
        }
    }

    public function getUserFundsSingleData($id, $column)
    {
        $this->db->select($column);
        if ($id) $this->db->where('user_id', $id);
        $res = $this->db->get('funds')->result_array();
        if (count($res) > 0) {
            return $res[0][$column];
        } else {
            return "false";
        }
    }

    public function getUserSingleData($id, $column)
    {
        $this->db->select($column);
        if ($id) $this->db->where('id', $id);
        $res = $this->db->get('users')->result_array();
        if (count($res) > 0) {
            return $res[0][$column];
        } else {
            return "false";
        }
    }

    public function getUserLoanSingleData($id, $column)
    {
        $this->db->select($column);
        if ($id) $this->db->where('id', $id);
        $res = $this->db->get('loan')->result_array();
        if (count($res) > 0) {
            return $res[0][$column];
        } else {
            return "false";
        }
    }
}


