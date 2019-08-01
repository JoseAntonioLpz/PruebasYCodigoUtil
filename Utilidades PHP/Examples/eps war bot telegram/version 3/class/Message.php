<?php

class Message{
	
	private $msg, $id_bot, $id_chat;

	private function __construct($msg){
		$this->msg = $msg;
		$this->id_bot = '903410626:AAHNQj1sZejA_ENOEZeYYX-3ABasr4NUxog';
		//$this->id_chat = '-1001174019148';
		$this->id_chat = '-1001364992090';
	}

	static public function sendMessage($msg){
		$message = new Message($msg);
		$message->send(); 
	}

	private function send(){
		$urlMsg = "https://api.telegram.org/bot{$this->id_bot}/sendMessage";
		 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $urlMsg);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "chat_id={$this->id_chat}&parse_mode=HTML&text=" . urlencode($this->msg));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 
		$server_output = curl_exec($ch);
		curl_close($ch);
	}
}