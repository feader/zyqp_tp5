<?php
namespace app\index\controller;
use \think\Controller;
use \think\Session;
use \think\Db;
use \think\Request;
use \think\Paginator;
use app\index\model\Rechargemanage as rmanage;

class Rechargemanage extends Auth{

    protected $db_config;
    
	/*
	*根据用户权限自动加载左侧菜单栏并判断当前选择的是哪个菜单
	*/ 
	public function _initialize(){

        $db_config = Session::get('db_config','db_config');
        
        $this->db_config = $db_config;

		$this->jump_login($this->is_login());
        
        $view = $this->view; 
        
        $this->set_action($view);

        $gid = Session::get('admin_group_id',$this->db_config['database'].'_admin');

        $this->handle_power($gid,$view);
               
    }

    /*
	*充值列表
	*/ 
	public function recharge_list(){

		$view = $this->view;
       
        $view->header_title = '充值管理';

        $get = input('get.');

        $rechargemanage = new rmanage();

        $all_info = array();

        $where = array();

        if(!empty($get)){

        	if(!empty($get['uid'])){

        		$where['uid'] = $get['uid'];
        	
        	}

        	if(!empty($get['order_id'])){

        		$where['order_id'] = $get['order_id'];
        	
        	}

        	if(!empty($get['alipay_order_id'])){

        		$where['alipay_order_id'] = $get['alipay_order_id'];
        	
        	}
      				
			if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where['create_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
			  		
        }

        $all_recharge = Db::connect($this->db_config)->name("recharge_log")->where('order_status=1')->sum('money_number');

        $all_info = $rechargemanage->get_all_user_recharge_info($where,100);

        $page = $all_info->render();	
		
		$view->page = $page;
		
		$view->all_recharge = $all_recharge/100;

        $view->all_info = $all_info; 
							      
	    // 模板输出
	    return $this->fetch();
	}

	/*
	*excel导出充值列表
	*/ 
	public function rechargelist_down_excel(){
		
		$get = input('get.');

        $where = array();

        if(!empty($get)){

        	if(!empty($get['uid'])){

        		$where['uid'] = $get['uid'];
        	
        	}

        	if(!empty($get['order_id'])){

        		$where['order_id'] = $get['order_id'];
        	
        	}

        	if(!empty($get['alipay_order_id'])){

        		$where['alipay_order_id'] = $get['alipay_order_id'];
        	
        	}
      				
			if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where['create_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
			  		
        }

        $all_info = Db::connect($this->db_config)->name("recharge_log")->field('uid,order_id,alipay_order_id,money_number,dimond_number,create_time,finish_time,pay_way,order_status')->where($where)->order(['order_status'=>'desc','create_time'=>'desc'])->select();

        foreach ($all_info as $k => $v) {
        	
        	$all_info[$k]['create_time'] = date('Y-m-d h:i:s',$v['create_time']);   
			
			$all_info[$k]['finish_time'] = date('Y-m-d h:i:s',$v['finish_time']); 
			
			$all_info[$k]['money_number'] = $v['money_number']/100; 
			
			$all_info[$k]['order_status'] = $v['order_status']==1 ? '已支付' : '未支付'; 
			
			$all_info[$k]['pay_way'] = $v['pay_way']=='alipay' ? '支付宝' : '微信'; 
        
        }

        $header=['代理UID','订单号','支付号','充值金额','房卡','订单创建时间','订单结束时间','支付方式','支付状态'];

        $setWidth = [
        'B'=>'25','C'=>'30','F'=>'20','G'=>'20'
        ];
        
        self::excel('充值管理',$header,$all_info,$setWidth);
        
	}

	/*
	*流水列表
	*/ 
	public function recharge_query(){

		$view = $this->view;
       
        $view->header_title = '流水查询';

        $get = input('get.');

        $rechargemanage = new rmanage();

        $all_info = array();

        $where = array();

        if(!empty($get)){
      				
			if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where['write_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
			  		
        }

        $all_recharge = Db::connect($this->db_config)->name("everyday_total_dimond_log")->sum('today_total_dimond');

        $all_info = $rechargemanage->get_all_recharge_query_info($where,100);

        $page = $all_info->render();	
		
		$view->page = $page;
		
		$view->all_recharge = $all_recharge;

        $view->all_info = $all_info; 
							      
	    // 模板输出
	    return $this->fetch();
	}

	/*
	*代理出售房卡给代理列表
	*/ 
	public function sell_to_agency_list(){

		$view = $this->view;
       
        $view->header_title = '出售钻石（代理）';

        $get = input('get.');

        $rechargemanage = new rmanage();

        $all_info = array();

        $where = array();

        if(!empty($get)){

        	if(!empty($get['sell_agency_uid'])){

        		$where['sell_agency_uid'] = $get['sell_agency_uid'];
        	
        	}

        	if(!empty($get['buy_agency_uid'])){

        		$where['buy_agency_uid'] = $get['buy_agency_uid'];
        	
        	}
        	      				
			if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where['create_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
			  		
        }

        //今天代理给玩家售卡数
		$beginToday = mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		$where_dotay = array();
		$where_dotay['create_time'] = ['between',[$beginToday,$endToday]];
		$today = $rechargemanage->get_sum('agency_sell_to_agency','dimond_num',$where_dotay);

		//昨天代理给玩家售卡数
		$beginYesterday = mktime(0,0,0,date('m'),date('d')-1,date('Y'));
		$endYesterday = mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
		$where_yesterday = array();
		$where_yesterday['create_time'] = ['between',[$beginToday,$endToday]];
		$yesterday = $rechargemanage->get_sum('agency_sell_to_agency','dimond_num',$where_yesterday);

		//上周代理给玩家售卡数
		$beginLastweek = mktime(0,0,0,date('m'),date('d')-7,date('Y'));
		$endLastweek = mktime(23,59,59,date('m'),date('d')-1,date('Y'))-1;
		$where_lastweek = array();
		$where_lastweek['create_time'] = ['between',[$beginToday,$endToday]];
		$lastweek = $rechargemanage->get_sum('agency_sell_to_agency','dimond_num',$where_lastweek);

		$where_all = array();
        $all_recharge = $rechargemanage->get_sum('agency_sell_to_agency','dimond_num',$where_all);

        $charge_info = array();
        $charge_info['today'] = $today;
        $charge_info['yesterday'] = $yesterday;
        $charge_info['lastweek'] = $lastweek;
        $charge_info['all_recharge'] = $all_recharge;

        $all_info = $rechargemanage->get_all_sell_to_agency_info($where,100);

        $page = $all_info->render();	
		
		$view->page = $page;
		
		$view->charge_info = $charge_info;

        $view->all_info = $all_info; 
							      
	    // 模板输出
	    return $this->fetch();
	}


	/*
	*excel导出代理出售给代理列表
	*/ 
	public function sell_to_agency_list_down_excel(){

		$get = input('get.');

        $where = array();

        if(!empty($get)){
    
        	if(!empty($get['sell_agency_uid'])){

        		$where['sell_agency_uid'] = $get['sell_agency_uid'];
        	
        	}

        	if(!empty($get['buy_agency_uid'])){

        		$where['buy_agency_uid'] = $get['buy_agency_uid'];
        	
        	}
      				
			if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where['create_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
			  		
        }

        $all_info = Db::connect($this->db_config)->name("agency_sell_to_agency")->field('sell_agency_uid,buy_agency_uid,dimond_num,create_time')->where($where)->select();

        foreach ($all_info as $k => $v) {
        	
        	$all_info[$k]['create_time'] = date('Y-m-d h:i:s',$v['create_time']);   
			       
        }

        $header=['出售代理UID','购买代理UID','房卡数','购买时间'];

        $setWidth = [
        'A'=>'15','B'=>'15','C'=>'10','D'=>'20'
        ];
        
        self::excel('代理出售给代理',$header,$all_info,$setWidth);
        
	}

	/*
	*代理出售房卡给用户
	*/ 
	public function sell_to_user_list(){

		$view = $this->view;
       
        $view->header_title = '出售钻石（玩家）';

        $get = input('get.');

        $rechargemanage = new rmanage();

        $all_info = array();

        $where = array();

        if(!empty($get)){

        	if(!empty($get['seller_uid'])){

        		$where['seller_uid'] = $get['seller_uid'];
        	
        	}

        	if(!empty($get['buyer_uid'])){

        		$where['buyer_uid'] = $get['buyer_uid'];
        	
        	}
        	      				
			if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where['action_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
			  		
        }

        //今天代理给玩家售卡数
		$beginToday = mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		$where_dotay = array();
		$where_dotay['action_time'] = ['between',[$beginToday,$endToday]];
		$today = $rechargemanage->get_sum('sell_log','dimond_num',$where_dotay);

		//昨天代理给玩家售卡数
		$beginYesterday = mktime(0,0,0,date('m'),date('d')-1,date('Y'));
		$endYesterday = mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
		$where_yesterday = array();
		$where_yesterday['action_time'] = ['between',[$beginToday,$endToday]];
		$yesterday = $rechargemanage->get_sum('sell_log','dimond_num',$where_yesterday);

		//上周代理给玩家售卡数
		$beginLastweek = mktime(0,0,0,date('m'),date('d')-7,date('Y'));
		$endLastweek = mktime(23,59,59,date('m'),date('d')-1,date('Y'))-1;
		$where_lastweek = array();
		$where_lastweek['action_time'] = ['between',[$beginToday,$endToday]];
		$lastweek = $rechargemanage->get_sum('sell_log','dimond_num',$where_lastweek);

		$where_all = array();
        $all_recharge = $rechargemanage->get_sum('sell_log','dimond_num',$where_all);

        $charge_info = array();
        $charge_info['today'] = $today;
        $charge_info['yesterday'] = $yesterday;
        $charge_info['lastweek'] = $lastweek;
        $charge_info['all_recharge'] = $all_recharge;

        $all_info = $rechargemanage->get_all_sell_to_user_info($where,100);

        $page = $all_info->render();	
		
		$view->page = $page;
		
		$view->charge_info = $charge_info;

        $view->all_info = $all_info; 
							      
	    // 模板输出
	    return $this->fetch();
	}


	/*
	*excel导出代理出售给玩家列表
	*/ 
	public function sell_to_user_list_down_excel(){

		$get = input('get.');

        $where = array();

        if(!empty($get)){
    
        	if(!empty($get['seller_uid'])){

        		$where['seller_uid'] = $get['seller_uid'];
        	
        	}

        	if(!empty($get['buyer_uid'])){

        		$where['buyer_uid'] = $get['buyer_uid'];
        	
        	}
      				
			if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where['action_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
			  		
        }

        $all_info = Db::connect($this->db_config)->name("sell_log")->field('seller_uid,buyer_uid,buyer_name,dimond_num,action_time')->where($where)->select();

        foreach ($all_info as $k => $v) {
        	
        	$all_info[$k]['action_time'] = date('Y-m-d h:i:s',$v['action_time']);   
			       
        }

        $header=['出售代理UID','购买玩家UID','玩家名','房卡数','购买时间'];

        $setWidth = [
        'A'=>'15','B'=>'15','C'=>'20','E'=>'20'
        ];
        
        self::excel('代理出售给玩家',$header,$all_info,$setWidth);
        
	}

}