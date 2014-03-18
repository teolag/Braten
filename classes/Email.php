<?php

class Email {
	private $to;
	private $from;
	private $reply;
	private $cc;
	private $bcc;
	private $subject;
	private $message;

	public function __construct() {
	}



	/**
	 * Adds an receiver to the created mail
	 * @access  public
	 * @param   string      $mail	Receivers e-mail address
	 * @param   string      $name	Name of the receiver 
	 */
	public function addReceiver($mail, $name="") {
		$this->to[$mail] = $name;
	}

	public function addCopy($mail, $name="") {
		$this->cc[$mail] = $name;
	}

	public function addHidden($mail, $name="") {
		$this->bcc[$mail] = $name;
	}

	public function setSender($mail, $name="") {
		$this->from[$mail] = $name;
	}
	
	public function setReply($mail, $name="") {
		$this->reply[$mail] = $name;
	}
	
	public function setSubject($text) {
		$this->subject = $text;
	}
	
	public function setMessage($text) {
		$this->message = $text;
	}
	
	public function send() {
		if(empty($this->to)) die("Email error: no receiver address");
		if(empty($this->from)) die("Email error: no sender address");
		
		if(empty($this->subject)) $subject="no-subject";
		else $subject="=?UTF-8?B?".base64_encode($this->subject)."?=\n";
				
		$headers = "From: " . $this->fixAddresses($this->from) . "\r\n";
		if(!empty($this->cc)) $headers .= "Cc: ". $this->fixAddresses($this->cc) . "\r\n";
		if(!empty($this->bcc)) $headers .= "Bcc: ". $this->fixAddresses($this->bcc) . "\r\n";
		if(!empty($this->reply)) $headers .= "Reply-To: ". $this->fixAddresses($this->reply) . "\n";
			
		$headers.= "Content-Type: text/html; charset=UTF-8; format=flowed\r\n"
				. "MIME-Version: 1.0\r\n"
				. "Content-Transfer-Encoding: 8bit\r\n"
				. "X-Mailer: PHP\r\n";
				
		return mail($this->fixAddresses($this->to), $subject, $this->message, $headers);
	}	


	private function fixAddresses($emails) {
		$out = array();
		foreach($emails as $a => $n) {
			$out[] = $n."<".$a.">";			
		}
		return implode(", ",$out);
	}
}
?>