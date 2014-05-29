<?php

class MessagesController extends BaseController {
    
    public function formDashboard()
    {
        if(Auth::check()){
                $info = $this->countMessages();
                
	        return View::make('dashboard',array('info' => $info));
        } else {
        	return Redirect::to('users/login')->with('messageLogin', 'You need to log in first!');
        }    
    }
      
    public function formCreateMessage()
    {
        if(Auth::check()){	        
	        return View::make('message'); 
        } else {
        	return Redirect::to('users/login')->with('messageLogin', 'You need to log in first!');
        }    
    }       
    
    
    public function sendMessage()
    {        
        $v=$this->validateMessage(Input::all());
        $messages = $v->messages();
        $messagesString=array();        
        foreach ($messages->all() as $message) {
            $messagesString[]=$message;
        }
                
        try{          
            if($v->passes()) {
            	$user = User::where('email', '=', Input::get('toemail'))->first();
                if(!isset($user)) {
                    return Redirect::to('messages/create')->with('messageSendError', 'Email does not exist');
                }
            	if (Input::hasFile('image')) {
            		$file = Input::file('image');    
            		if ($file->isValid()) {            			
            			$db_image = $this->uploadImage($file);
            		}        		
            	}     
            	                
                $date_created = new DateTime();
                $date_insert = $date_created->format('Y-m-d H:i:s');
                
            	if(isset($db_image)) { 
            		$dataForDB = array('image' => $db_image, 
                                           'subject' => Input::get('subject'),
                                           'content' => Input::get('contentmessage'),
                                           'created_at' => $date_insert,
                                           'receiver_id' => $user->id,
                                           'sender_id' => Auth::user()->id,
                                           'read' => 1 
                                        );
            	} else { 
                    $dataForDB = array(    'subject' => Input::get('subject'),
                                           'content' => Input::get('contentmessage'),
                                           'read' => 1,
                                           'created_at' => $date_insert,
                                           'receiver_id' => $user->id,
                                           'sender_id' => Auth::user()->id
                                            
                                        );
                     
                }           	
            	
            	Message::create($dataForDB);            	 
            	return Redirect::to('messages/inbox')->with('message', 'Your message has been sent!');            
            } else {     
             	return Redirect::to('messages/create')->with('validateError', $messagesString);
            }        
       }
       catch (Exception $e){
             return Redirect::to('messages/create')->with('error','Ops!An error occurred');
       }
    }
    
    public function forwardMessage()
    {
        if(Auth::check()) {            
            $v=$this->validateEmail(Input::all());
            $messages = $v->messages();
            $messagesString=array();   
            foreach ($messages->all() as $message) {
                $messagesString[]=$message;
            }            
            try {          
                if($v->passes()) {  
                    $userTo = User::where('email', '=', Input::get('toemail'))->first();
                    if(!isset($userTo)) {
                        return Redirect::to('messages/view/'.Input::get('id_message'))->with('messageSendError', 'The email does not exist');
                    }                    
                    $date_created = new \DateTime;
                    $date_created_array = get_object_vars($date_created);            

                    $messageToForward = Message::where('id_message', '=', Input::get('id_message'))->first()->toArray();
                    $messageToForward['sender_id'] = Auth::user()->id;
                    $messageToForward['receiver_id'] = $userTo->id;          
                    $messageToForward['created_at'] = $date_created_array['date'];
                    $messageToForward['read'] = 1;
                    unset($messageToForward['id_message']);
                    
                    Message::create($messageToForward);	        
                    
                    return Redirect::to('messages/view/'.Input::get('id_message'))->with('messageLogin', 'Your message is sent');
                }
                else {
                    return Redirect::to('messages/view/'.Input::get('id_message'))->with('validateError', $messagesString);
               }
            } catch (Exception $e) {
                return Redirect::to('messages/view/'.Input::get('id_message'))->with('error','Ops!An error occurred');
            }
        } else {
        	return Redirect::to('users/login')->with('messageLogin', 'You need to log in first!');
        } 
    }
    
    public function replyMessage()
    {
        if(Auth::check()) { 
            try {   
                    $messageForDB = Input::all();                                        
                    if(isset($messageForDB) && isset($messageForDB['receiver_id'])) {
                        
                         $date_created = new \DateTime;
                         $date_created_array = get_object_vars($date_created);            
                         
                         $messageForDB['created_at'] = $date_created_array['date'];
                         $messageForDB['read'] = 1; 
                         $messageForDB['content'] = $messageForDB['contentmessage'];
                         unset($messageForDB['_token']);
                         unset($messageForDB['contentmessage']);
                         
                         $idInserted = Message::create($messageForDB)->id;	
                        
                         return Redirect::to('messages/view/'.$idInserted)->with('messageLogin', 'Your reply was sent');
                    }
                                        
                    return Redirect::back()->with(array('user' => $user_object, 'messageLogin' => 'Please refresh the page'));
                
            } catch (Exception $e) {                
                return Redirect::back()->with(array('error' => 'Ops!An error occurred'));
            }
        } else {          
        	return Redirect::to('users/login')->with('messageLogin', 'You need to log in first!');
        } 
    }
   
    public function deleteMessage($id)
    {
    	if(Auth::check()){
        	$deleteData = Message::where('id_message', '=', $id)->first();
        	$this->deleteImage($deleteData->image);
        	$deleteData -> delete();
			return Redirect::to('messages/inbox')->with('message', 'Your message is deleted!');
    	}else{
    		return Redirect::to('users/login')->with('messageLogin', 'You need to log in first!');}
    }

    public function viewMessage($id)
    {
    	if (Auth::check()) {
            $viewData = Message::where('id_message', '=', $id)->first();
            
            if (Auth::user()->id == $viewData->sender_id) {
                $toUserEmail = User::find($viewData->receiver_id)->email;
                $pageh2 = 'Sent';
            } else {
                $toUserEmail = User::find($viewData->sender_id)->email;
                $pageh2 = 'Inbox';
                if($viewData->read == '1') {   
                    $updateReadField = Message::where('id_message', '=', $id)
                        ->limit(1)
                        ->update( array('read' => 0));                
                }
            }
            return View::make('viewmessage', array('inboxmessage' => $viewData, 
                                                   'toemail' => $toUserEmail, 
                                                   'pageh2' => $pageh2));
    	} else {
            return Redirect::to('users/login')->with('messageLogin', 'You need to log in first!');                
        }
    }
   
    public function listMessageInbox()
    {          
        if (Auth::check()) {
            $messages = new Message();            
            $usersInboxMessages = Message::join('users','users.id','=','messages.sender_id')
                                    ->where('receiver_id', '=', Auth::user()->id)
                                    ->orderBy('messages.id_message','DESC')
                                    ->get();
                   
            return View::make('inboxmessages', array('messagesinbox' => $usersInboxMessages));
        } else {
            return Redirect::to('users/login')
                            ->with('messageLogin', 'You need to log in first!');
        }
    }
    
    public function listMessageSent()
    {              
       if (Auth::check()) {
            $usersSentMessages = Message::join('users','users.id','=','messages.receiver_id')
                                    ->where('sender_id', '=', Auth::user()->id)
                                    ->orderBy('messages.id_message','DESC')
                                    ->get();                                    
            
            return View::make('sentmessages', array('messagessent' => $usersSentMessages));
        } else {
            return Redirect::to('users/login')
                            ->with(array('messageLogin' => 'You need to log in first!'));
        }
    }
    
    
    
    public function validateMessage($post)
    {
        $rules = array(
            'toemail'=>'Required|email|Min:3|Max:1000|',
            'subject'=>'Required|Min:3|Max:100|',
            'contentmessage'=>'Required|Min:3|Max:5100000',  
            'image'=>'Image|Mimes:jpeg,bmp,png,gif|Max:5101010'           
                 );        
        return Validator::make($post, $rules);
    }
    
    public function validateEmail($post)
    {
        $rules = array(
            'toemail'=>'Required|email|Min:3|Max:1000|',                       
                 );        
        return Validator::make($post, $rules);
    }
    
    public function countMessages() {
        $allUnread = Message::where('receiver_id', '=', Auth::user()->id)
                            ->where('read', '=', '1', 'AND')
                            ->count();
        $allInbox = Message::where('receiver_id', '=', Auth::user()->id)->count();
        $allSent = Message::where('sender_id', '=', Auth::user()->id)->count();
        echo "inbox";
       
        $countAll = array('inbox' => $allInbox, 
                          'sent' => $allSent,
                          'unread' => $allUnread
                );
        return $countAll;        
    }
   
      

}