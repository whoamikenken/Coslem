<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emailcon extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function sendConfirmationEmail($message, $emp_email){
        // Set SMTP Configuration
        $emailConfig = array(
            'protocol' => 'smtp', 
            'smtp_host' => 'ssl://smtp.googlemail.com', 
            'smtp_port' => 465, 
            'smtp_user' => 'brgy163@gmail.com', 
            'smtp_pass' => 'capstone', 
            'mailtype' => 'html', 
            'wordrap' => TRUE,
            'charset' => 'iso-8859-1'
        );

        // Set your email information
        $from = array(
            'email' => 'brgy163@gmail.com',
            'name' => 'COMSLEM'
        );

        $emp_email = strtolower($emp_email);
        $to = array($emp_email);
        $subject = 'Account Confirmation';
        // Load CodeIgniter Email library
        // echo "<pre>";print_r($to);die;
        $this->load->library('email');

        $this->email->initialize($emailConfig);
        // Sometimes you have to set the new line character for better result
        $this->email->set_newline("\r\n");
        // Set email preferences
        $this->email->from($from['email'], $from['name']);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        // Ready to send email and check whether the email was successfully sent
        if (!$this->email->send()) {
            // Raise error message
            show_error($this->email->print_debugger());
        } else {
            // Show success notification or other things here
            // echo 'Success to send email';
        }
    }

    function sendEmail($message, $emp_email, $title){
        // Set SMTP Configuration
        $emailConfig = array(
            'protocol' => 'smtp', 
            'smtp_host' => 'ssl://smtp.googlemail.com', 
            'smtp_port' => 465, 
            'smtp_user' => 'brgy163@gmail.com', 
            'smtp_pass' => 'capstone', 
            'mailtype' => 'html', 
            'wordrap' => TRUE,
            'charset' => 'iso-8859-1'
        );

        // Set your email information
        $from = array(
            'email' => 'brgy163@gmail.com',
            'name' => 'COMSLEM'
        );

        $emp_email = strtolower($emp_email);
        $to = array($emp_email);
        $subject = $title;
        // Load CodeIgniter Email library
        // echo "<pre>";print_r($to);die;
        $this->load->library('email');

        $this->email->initialize($emailConfig);
        // Sometimes you have to set the new line character for better result
        $this->email->set_newline("\r\n");
        // Set email preferences
        $this->email->from($from['email'], $from['name']);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        // Ready to send email and check whether the email was successfully sent
        if (!$this->email->send()) {
            // Raise error message
            show_error($this->email->print_debugger());
        } else {
            // Show success notification or other things here
            // echo 'Success to send email';
        }
    }

}