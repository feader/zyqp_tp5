<?php
namespace app\index\controller;
use \think\Controller;
use \think\Session;
use \think\Db;
use app\index\model\Main as main_model;

class Main extends Auth{

	protected $database;

	/*
	*根据用户权限自动加载左侧菜单栏并判断当前选择的是哪个菜单
	*/ 
	public function _initialize(){

		$db_config = Session::get('db_config','db_config');
	        
        $this->database = $db_config;

		$this->jump_login($this->is_login());
        
        $view = $this->view; 
        
        $this->set_action($view);

        $gid = Session::get('admin_group_id',$this->database['database'].'_admin');

        $this->handle_power($gid,$view);
  
    }

 	/*
    *登陆后的总览页    
    */          
    public function total_view(){
    		
        $view = $this->view;
       
        $view->header_title = '总览页';       

        $main_model = new main_model();

        $today_zero = strtotime(date("Y-m-d"));
		
		$today_end = strtotime(date("Y-m-d"))+86400-1;

        $where = array();

        $where['dateline'] = ['between',[$today_zero,$today_end]];

        $get = input('get.');

        if(!empty($get)){

        	$where1 = array();
        	
        	if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where1['dateline'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}

			$all_info = Db::name("online_log")->field('dateline,online')->where($where1)->order('dateline asc')->select();

	        foreach ($all_info as $k => $v) {
	        	
	        	$all_info[$k]['dateline'] = date('Y-m-d H:i:s',$v['dateline']);   
				
	        }

	        $header=['时间','在线人数'];

	        $setWidth = ['A'=>'20'];
	        
	        self::excel('在线人数',$header,$all_info,$setWidth);
        }

        $online_log = $main_model->get_one_day_online_data_log($where,$this->database);
        //总注册人数
        $all_reg_num = Db::connect($this->database)->name('game_user')->where('LENGTH(unionid)=28')->count();
        //当前在线人数
        $now_online = Db::connect($this->database)->name('online_log')->field('online')->order('`dateline` DESC')->find();
        //今天消耗的钻石
        $today_diamond = Db::connect($this->database)->name('user_dimond_log')->where("use_time between $today_zero and $today_end")->sum('use_dimond');
        //总消耗的钻石
        $all_diamond = Db::connect($this->database)->name('user_dimond_log')->sum('use_dimond');
        //总销售的钻石	
        $all_sell_dimond = Db::connect($this->database)->name('sell_log')->sum('dimond_num');
       
        $flag = false;
       
        $today_data = '';
       
        foreach($online_log as $k=>$v){
		
			if($flag){
		
				$today_data .= ',';
		
			}	
		
			$tmp = '[Date.UTC('.strftime("%Y,%m,%d,%H,%M,%S",$v['dateline']).'),'.$v['online'].']';
	
			$today_data .= $tmp;
	
			$flag = true;
	
		}

		$show_data = array();

		$show_data['all_reg_num'] = $all_reg_num;
		$show_data['now_online'] = $now_online['online'];
		$show_data['today_diamond'] = $today_diamond ? $today_diamond : 0;
		$show_data['all_diamond'] = $all_diamond;
		$show_data['all_sell_dimond'] = $all_sell_dimond;

        $view->today_data = $today_data; 
       
        $view->show_data = $show_data; 

	    // 模板输出
	    return $this->fetch();
    }

    /*
    *数据统计页    
    */  
    public function data_count(){
    	
    	$view = $this->view;
       
        $view->header_title = '数据统计';       

        $main_model = new main_model();

        $today_zero = strtotime(date("Y-m-d"));
		
		$today_end = strtotime(date("Y-m-d"))+86400-1;

        $where = array();

        $where['dateline'] = ['between',[$today_zero,$today_end]];

        $acu_total = Db::connect($this->database)->name('online_log')->where($where)->sum('online');
        //实时平均在线人数
        $acu = number_format($acu_total/((time()-$today_zero)/60),1,".","");

        $get = input('get.');

        $where1 = array();

        if(!empty($get)){
        	
        	if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where1['create_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
        	
        }

        $all_info = $main_model->get_all_data_count_log($where1,$this->database);

        $page = $all_info->render();	
		
		$view->page = $page;

        $view->all_info = $all_info; 
       
        $view->acu = '<span style="color:red;">'.date('Y-m-d',time()).'实时平均在线人数：</span>'.$acu; 
        
	    // 模板输出
	    return $this->fetch();

    }

    /*
    *房间记录    
    */  
    public function room_log(){
    	
    	$view = $this->view;
       
        $view->header_title = '房间记录';       

        $main_model = new main_model();
        
        $where = array();

        $get = input('get.');
        
        if(!empty($get)){
        	
        	if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where['action_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}

			if(!empty($get['uid'])){
				
				$uid = $get['uid'];
				
				$where['uids'] = ['like',"%$uid%"];
			
			}
        	
        }

        $all_info = $main_model->get_all_room_log($where,$this->database);

        $page = $all_info->render();	
		
		$view->page = $page;

        $view->all_info = $all_info; 
               
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