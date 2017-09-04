<?php
namespace app\index\controller;
use app\index\controller\Basecommon;

class Index extends Basecommon{
    
    /*
    *首页
    */ 
    public function index(){

        $check = $this->is_login();

        if($check){
           
            $this->redirect('/total_view.html');          
        
        }else{
            
            $this->redirect('/login.html');          
        
        } 	   	
    }
       
}
