<?php
namespace app\index\controller;
use \think\Controller;
use \think\Session;
use \think\Db;

class Login extends Controller{

	private $database;

	public function _initialize(){

		// $database = config("database.database");
		
		// $this->database = $database;
	}

	/*
	*登陆页
	*/ 
	public function index(){
		
		$view = $this->view;      
        // 模板输出
        return $this->fetch();

	}

	/*
	*登陆处理
	*/ 
	public function sign_up(){    	
    	  	
    	$checkcode = input('request.checkcode');    

	    if(!captcha_check($checkcode)){
	      
	       //验证失败	    	
	       return $this->error("验证码错误");	   
	   
	    }

	    $admin_name = input('request.username');
	   
	    $admin_passwd = input('request.password');
	    
	    $db_num = input('request.db_num');
	    
        $res = $this->login_handle($admin_name,$admin_passwd,$db_num); 

	    if($res){	    	         
	    	
	    	$this->success('登陆成功！','/total_view.html');

	    }else{

	    	Session::delete('admin_user',$this->database.'_admin');

	    	$this->error('登陆失败！','/login.html');

	    }

    }

    /*
	*登陆验证
	*@$admin_name 用户名
	*@$admin_passwd 用户密码
	*@$db_num 数据库选项
	*/ 
    private function login_handle($admin_name,$admin_passwd,$db_num){
		
		$where = array();
	    
	    $where['username'] = $admin_name;
	    
	    $where['passwd'] = md5($admin_passwd);
	    
	    $base = model('Base');
	    
	    $res = $base->get_admin_info($where);

	    $db_config = \think\Config::get('db'.$db_num);
	    
	    Session::set('admin_user',$res['username'],$db_config['database'].'_admin'); 
	   
	    Session::set('admin_uid',$res['uid'],$db_config['database'].'_admin'); 
	    
	    Session::set('admin_group_id',$res['gid'],$db_config['database'].'_admin');
	    
	    Session::set('db_config',$db_config,'db_config');
        
        return $res;

	}

	/*
	*登出处理
	*/ 
	public function logout(){
        
        Session::clear($this->database.'_admin');
       
        Session::clear('db_config');
        
        $this->success('登出成功！','/login.html');
    
    }


























}	   