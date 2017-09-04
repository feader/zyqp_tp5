<?php
namespace app\index\controller;
use \think\Controller;
use \think\Session;
use \think\Db;

class Main extends Auth{

	/*
	*根据用户权限自动加载左侧菜单栏并判断当前选择的是哪个菜单
	*/ 
	public function _initialize(){

		$this->jump_login($this->is_login());
        
        $view = $this->view; 
        
        $this->set_action($view);

        $gid = Session::get('admin_group_id','admin');

        $this->handle_power($gid,$view);
  
    }

 	/*
    *登陆后的总览页    
    */          
    public function total_view(){
    	
        $view = $this->view;
       
        $view->header_title = '总览页';        
    	      
	    // 模板输出
	    return $this->fetch();
    }


	public function test(){
	   
	    $view = $this->view;
	   
	    $view->header_title = '测试页';

	    $sql = "select * from t_online_log where dateline between 1503964800 and 1504022400";

$res = Db::query($sql);
// foreach ($res as $k => $v) {
// 	$n=1;
// 	if($v['dateline']-$res){

// 	}
// 	# code...
// }
// $count = count($res);
// $n = 1;
// 	$m = 0;
// for ($i=0; $i < count($res)-1; $i++) { 
	
// 	if($res[$i+$n-1]['dateline']-$res[$i]['dateline']<60){
// 		$n++;
// 	}else{
// 		$m++;
// 	}
// }

// var_dump($count);
// var_dump($n);
// var_dump($m);



	    //$this->handle_power1(3,$view);
die;
	    return $this->fetch();
    }









	
}