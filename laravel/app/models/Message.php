<?php


class Message extends Eloquent  {
    
     protected $table = 'messages';
     public $timestamps = false;
     
     //protected $fillable = array('title', 'title_alias','intro_text','full_text','image');
     protected $fillable = array('id_message','subject', 'content','read','created_at','updated_at','sender_id','receiver_id');
     /*
     public function widgets(){
         return $this->belongsToMany('Widget');
     }*/
   
}

