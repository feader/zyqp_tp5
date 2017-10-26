<?php
namespace app\agency\controller;
use \think\Controller;
use \think\Session;
use \think\Db;
use \think\Config;

class Login extends Controller{

	/*
	*登陆页
	*/ 
	public function index(){

		$param = input('param.');
			
		$view = $this->view;  

		$view->did = $param['did']; 

        // 模板输出
        return $this->fetch();

	}

	/*
	*登陆处理
	*/ 
	public function agency_sign_up(){    	
    	  	
    	$checkcode = input('request.checkcode');    

	    if(!captcha_check($checkcode)){
	      
	       //验证失败	    	
	       return $this->error("验证码错误");	   
	    
	    }

	    $uid = input('request.uid');
	   
	    $password = input('request.password');
	    
	    $did = input('request.did');
	    
        $res = $this->login_handle($uid,$password,$did); 

        var_dump($res);die;

	    if($res){	    	         
	    	
	    	$this->success('登陆成功！','/agency_main.html');

	    }else{

	    	Session::clear('agency');

	    	$this->error('登陆失败！','/login.html');

	    }

    }

    /*
	*登陆验证
	*@$admin_name 用户名
	*@$admin_passwd 用户密码
	*/ 
    private function login_handle($admin_name,$admin_passwd,$db_num){
		
		$where = array();
	    
	    $where['uid'] = $admin_name;
	    
	    $where['password'] = md5($admin_passwd);

	    $db_config = Config::get('db'.$db_num);
	    
	    $base = model('Base');
	    
	    $res = $base->get_one_agency_info($where,$db_config);
	    	   
	    Session::set('agency_uid',$res['uid'],'agency'); 
	    	    
	    Session::set('db_config',$db_config,'agency');
        
        return $res;

	}

	/*
	*登出处理
	*/ 
	public function logout(){
        
        Session::clear('agency');
        
        $this->success('登出成功！','/login.html');
    
    }


























}	   