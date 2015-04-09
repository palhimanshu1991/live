<?php

class InviteController extends BaseController {

	/*
	* Adding a new invite request
	*/
	public function add() {
		
		$email = Input::get('email');
	
		if($this->check($email)){
			
		
		} else {
		
			DB::table('invite_requests')->insert(
				array(
				'ir_email' => $email,
				'requested_at' => date('d M Y H:i:s', time())
				)
			);			
		
		}	
		
	}
	
	/*
	* Deleting an invite request. 
	*/
	public function delete() {
		
		$email = Input::get('email');
	
		DB::table('invite_requests')->where('ir_email', $email)->delete();
		
	}	
	
	/*
	* Check if invite request already exists. 
	*/
	public function check($email) {
	
		return DB::table('invite_requests')->where('ir_email', $email)->first();
		
	}		
	

	/*
	* Adding a new invite to friend
	*/
	public function friend() {
		
		$email = Input::get('email');
	
		$check = DB::table('invite_codes')->where('ic_usr_id',Auth::user()->id)->where('ic_friend_email','=',$email)->where('ic_sent','=','1')->first();
		
		if($check){

			return 'false';
		
		} else {
		
			$code = DB::table('invite_codes')->where('ic_usr_id',Auth::user()->id)->where('ic_sent','=','0')->first();
		
			DB::table('invite_codes')
				->where('ic_usr_id',Auth::user()->id)
				->where('ic_code',$code->ic_code)
				->update(array(
							'ic_friend_email' => $email,
							'ic_sent' => '1'						
							));
			
			$this->inviteMail($email,$code->ic_code);			
		}					
	}	
	
	/*
	* Send email invitation
	*/
	public function email($email) {
	
		return DB::table('invite_requests')->where('ir_email', $email)->first();
		
	}		
	
	/*
	* Create 5 invite codes for a new user
	*/
	public function createCodes($id) {
	
		for($i = 0; $i < 5; $i++) {
			$code = $this->generateRandomString();
			DB::table('invite_codes')->insert(
				array(
					'ic_code' => $code, 
					'ic_usr_id' => $id
				)
			);
		}
	}		
	
	
	/*
	* Update invitation code details when invite code is used
	*/
	public function updateInvite($code) {
	
		DB::table('invite_codes')
			->where('ic_code',$code)
			->update(
				array(
				'ic_status' => '1',
				'ic_date' => date('d M Y H:i:s', time())
				)
			);
		
	}	
	
	/*
	* Generating random string
	*/
	public 	function generateRandomString($length = 50) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
			}
		return $randomString;
	}		
	
	
	
    public function inviteMail($email,$code) {

        $subjectEmail = $email;
        $subjectName = '';
        $emailSubject = 'Hello, ' . Auth::user()->usr_fname . ' ' . Auth::user()->usr_lname . ' is inviting you to Berdict';

        $data = array(
            'subjectName' => '',
            'objectName' => Auth::user()->usr_fname . ' ' . Auth::user()->usr_lname,
            'objectUsername' => Auth::user()->username,
            'objectId' => Auth::user()->id,
            'objectImage' => Auth::user()->usr_image,
			'code' => $code,
        );

        Mail::queue('emails.invite', $data, function($message) use ($subjectEmail, $subjectName, $emailSubject) {
            $message->to($subjectEmail, $subjectName);
            $message->subject($emailSubject);
            $message->from('no-reply@berdict.com', 'Berdict');
        });

    }	

}
