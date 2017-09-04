<?php
namespace app\agency\controller;
use app\agency\controller\Basecommon;

class Index extends Basecommon{
    
    /*
    *首页
    */ 
    public function index(){
        echo 123;die;
        $check = $this->is_login();

        if($check){
           
            $this->redirect('/agency_notice.html');          
        
        }else{
            
            $this->redirect('/agency_login.html');          
        
        } 	   	
    }
       
}