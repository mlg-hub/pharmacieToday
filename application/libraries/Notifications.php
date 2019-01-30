<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notifications
{
	protected $CI;

	public function __construct()
	{
	    $this->CI = & get_instance();
      $this->CI->load->library('email');
      $this->CI->load->model('Model');
	}



function send_mail($emailTo = array(), $subjet, $cc_emails = array(), $message, $attach = array()) {

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://twiga.afriregister.co.ke';
        $config['smtp_port'] = 465;
        $config['smtp_user'] = 'helpdesk_comesa@mediabox.bi';
        $config['smtp_pass'] = 'mediabox@comesa2018';
        $config['mailtype'] = 'html';
        $config['charset'] = 'UTF-8';
        $config['wordwrap'] = TRUE;
        $config['smtp_timeout'] = 20;
        $config['newline'] = "\r\n";
        $this->CI->email->initialize($config);
        $this->CI->email->set_mailtype("html");

    
        $this->CI->email->from('noc@mediabox.bi', 'Experts projet');
        $this->CI->email->to($emailTo);
       // $this->CI->email->bcc('ismael@mediabox.bi');
        if (!empty($cc_emails)) {
            foreach ($cc_emails as $key => $value) {
                $this->CI->email->cc($value);
            }
        }
        $this->CI->email->subject($subjet);
        $this->CI->email->message($message);

        if (!empty($attach)) {
            foreach ($attach as $att)
                $this->CI->email->attach($att);
        }
        if (!$this->CI->email->send()) {
            show_error($this->CI->email->print_debugger());
        } 
            else;
       // echo $this->CI->email->print_debugger();
    }


   public function smtp_mail($emailTo,$subjet,$cc_emails=NULL,$message,$attach=NULL)
   {     
        $this->CI = & get_instance();
        $this->CI->load->library('email');
        $config['protocol'] = 'smtp';
        //$config['smtp_crypto'] = 'tls';
        $config['smtp_host'] = 'ssl://twiga.afriregister.co.ke';
        $config['smtp_port'] = 465;
        $config['smtp_user'] = 'helpdesk_comesa@mediabox.bi';
        $config['smtp_pass'] = 'mediabox@comesa2018';
        $config['mailtype'] = 'html';
        $config['charset'] = 'UTF-8';
        $config['wordwrap'] = TRUE;
        $config['smtp_timeout'] = 20;
       // $config['priority'] = '1';


        $this->CI->email->initialize($config);
        $this->CI->email->set_mailtype("html");

        // Load email library and passing configured values to email library 
        $this->CI->load->library('email', $config);
        $this->CI->email->set_newline("\r\n");

        $this->CI->email->from('helpdesk_comesa@mediabox.bi', 'Case hospital');
        $this->CI->email->to($emailTo);
        //$this->CI->email->bcc('ismael@mediabox.bi');

          if (!empty($cc_emails)) {
          foreach ($cc_emails as $key => $value) {
          $this->CI->email->cc($value);
          }
          }
         
        $this->CI->email->subject($subjet);
        $this->CI->email->message($message);
        
        if(!empty($attach))
          {
            $this->email->attach($attach);
         }

        if (!$this->CI->email->send()) {
            show_error($this->CI->email->print_debugger());
        } else
            echo $this->CI->email->print_debugger();
   }

   public function send_sms($string_tel = NULL,$string_msg)
   {
        $data = '{"urns": ["' . $string_tel . '"],"text":"' . $string_msg . '"}';

        $header = array();
        $header [0] = 'Authorization:Token 8ae3e567ec75aeac4fab42a43c64edf52f0eb736';  //pas d'espace entre Authori et : et Token
        $header [1] = 'Content-Type:application/json';
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, 'https://sms.ubuviz.com/api/v2/broadcasts.json');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($curl);
       // $result = json_decode($result);

        return $result;
   }


   public function generate_UIID($taille)
   {
     $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789'; 
      $QuantidadeCaracteres = strlen($Caracteres); 
      $QuantidadeCaracteres--; 

      $Hash=NULL; 
        for($x=1;$x<=$taille;$x++){ 
            $Posicao = rand(0,$QuantidadeCaracteres); 
            $Hash .= substr($Caracteres,$Posicao,1); 
        }

        return $Hash; 
   }

    public function generate_password($taille)
   {
     $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789'; 
      $QuantidadeCaracteres = strlen($Caracteres); 
      $QuantidadeCaracteres--; 

      $Hash=NULL; 
        for($x=1;$x<=$taille;$x++){ 
            $Posicao = rand(0,$QuantidadeCaracteres); 
            $Hash .= substr($Caracteres,$Posicao,1); 
        }
        return $Hash; 
   }

}

?>
