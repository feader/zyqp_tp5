<?php
namespace app\index\controller;
use \think\Controller;
use \think\Session;
use \think\Db;
use \think\Request;
use \think\Paginator;
use app\index\model\Agencymanage as amanage;

class Agencymanage extends Auth{

	private $gid;

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

        $this->gid = $gid;

        $this->handle_power($gid,$view);
               
    }

    /*
	*消耗钻石列表
	*/ 
	public function agency_list(){

		$view = $this->view;
       
        $view->header_title = '代理列表';

        $get = input('get.');

        $agencymanage = new amanage();

        $all_info = array();

        $where = array();

        if(!empty($get)){

        	if(!empty($get['uid'])){

        		$where['uid'] = $get['uid'];
        	
        	}

        	if(!empty($get['uber_agency'])){

        		$where['uber_agency'] = $get['uber_agency'];
        	
        	}
        	      				
			if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where['register_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
			  		
        }

        $all_info = $agencymanage->get_all_agency_info($where,365);
       
        $page = $all_info->render();	
		
		$view->page = $page;
		
        $view->all_info = $all_info; 
							      
	    // 模板输出
	    return $this->fetch();
	}

	/*
	*excel导出玩家反馈列表
	*/ 
	public function agency_list_down_excel(){
		
		$get = input('get.');

        $where = array();

        if(!empty($get)){

        	if(!empty($get['uid'])){

        		$where['uid'] = $get['uid'];
        	
        	}

        	if(!empty($get['uber_agency'])){

        		$where['uber_agency'] = $get['uber_agency'];
        	
        	}
      				
			if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where['register_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
			  		
        }

        $all_info = Db::connect($this->db_config)->name("agency")->field('uid,grade,uber_agency,nick_name,recharge_dimond,recharge_money,note,register_time')->where($where)->order(['register_time'=>'desc'])->select();

        foreach ($all_info as $k => $v) {
        	
        	$all_info[$k]['register_time'] = date('Y-m-d h:i:s',$v['register_time']);

        	if($v['note']==''){

        		$all_info[$k]['note'] = '无';
        	
        	}   

        	if($v['nick_name']==''){

        		$all_info[$k]['nick_name'] = '无';
        	
        	}   

        	if($v['uber_agency']==''){

        		$all_info[$k]['uber_agency'] = '无上级';
        	
        	}   
			
			switch ($v['grade']) {
	        	case 1:
	        		$all_info[$k]['grade'] = '皇冠';
	        		break;
	        	case 2:
	        		$all_info[$k]['grade'] = '钻石';
	        		break;
	        	case 3:
	        		$all_info[$k]['grade'] = '白金';
	        		break;
	        	case 4:
	        		$all_info[$k]['grade'] = '水晶';
	        		break;			
	        	
	        	default:
	        		$all_info[$k]['grade'] = '未知';
	        		break;
	        }
			        
        }

        $header=['代理UID','代理级别','上级代理','呢称','充值房卡','充值金额','备注','生成时间'];

        $setWidth = [
        'D'=>'15','G'=>'15','H'=>'20'
        ];
        
        self::excel('代理列表',$header,$all_info,$setWidth);
        
	}

	/*
	*代理资料编辑
	*/ 
	public function agency_edit(){

		$view = $this->view;
       
        $view->header_title = '代理编辑';

        $get = input('param.');

        $agencymanage = new amanage();

        $agency_info = array();

        $where = array();

        if(!empty($get)){

        	if(!empty($get['uid'])){

        		$where['uid'] = $get['uid'];
        	
        	}       	
			  		
        }

        $gid = $this->gid;

        $agency_info = $agencymanage->get_one_agency_info($where);

        $game_id = $agencymanage->get_system_setting_info('system_setting','setting_value',"setting_name='game_id'");

        $fx_url = $agencymanage->get_system_setting_info('system_setting','setting_value',"setting_name='fx_url'");

        $view->agency_info = $agency_info; 
        
        $view->gid = $gid; 
        
        $view->game_id = $game_id; 
        
        $view->fx_url = $fx_url; 
							      
	    // 模板输出
	    return $this->fetch();
	}

	/*
    *代理信息修改    
    */
    public function agency_info_save(){

    	$post = input('post.');
    	
    	$data = array();

        if(!empty($post['password'])){

            $data['password'] = md5($post['password']);

        }
    	    	
    	$data['grade'] = $post['grade'];
    	
    	$data['note'] = $post['note'];
    	
    	$where = array();
    	
    	$where['uid'] = $post['uid'];
    	
    	$where['id'] = $post['id'];

    	$agencymanage = new amanage();

    	$res = $agencymanage->handle_agency_info_update($data,$where);

    	if($res){
    		
    		$this->success($res['msg'],'/agency_list.html');
    	
    	}else{
    		
    		$this->error($res['msg'],'/agency_list.html');
    	
    	}

    }

    /*
    *代理删除    
    */
    public function agency_del(){

    	$id = input('param.id');
    	
    	$uid = input('param.uid');

    	$agencymanage = new amanage();

    	$res = $agencymanage->del_agency($id,$uid);
    	
    	if($res){
    		$this->success($res['msg'],'/agency_list.html');
    	}else{
    		$this->error($res['msg'],'/agency_list.html');
    	}
    }

    /*
	*代理银行信息列表
	*/ 
	public function agency_bank_info_list(){

		$view = $this->view;
       
        $view->header_title = '代理银行信息列表';

        $get = input('get.');

        $agencymanage = new amanage();

        $all_info = array();

        $where = array();

        if(!empty($get)){

        	if(!empty($get['uid'])){

        		$where['uid'] = $get['uid'];
        	
        	}

        	if(isset($get['action'])){

        		if($get['action']=='down_excel'){

	        		$all_info = Db::name("agency_bank_info")->field('uid,weixin,alipay,opening_bank,branch,bank_name,bank_account')->where($where)->select();
			       
			        $header=['代理账号','微信','支付宝','开户行','分行','开户名','开户账号'];

			        $setWidth = [
			        // 'D'=>'15','G'=>'15','H'=>'20'
			        ];
			        
			        self::excel('代理银行资料',$header,$all_info,$setWidth);
	        		die;
	        	}  		
        	
        	}
			
        }

        $gid = $this->gid;

        $all_info = $agencymanage->get_all_agency_bank_info($where,100);
       
        $page = $all_info->render();	
		
		$view->page = $page;
		
        $view->all_info = $all_info; 

        $view->gid = $gid; 
							      
	    // 模板输出
	    return $this->fetch();
	}

	/*
	*代理银行资料编辑
	*/ 
	public function agency_bank_info_edit(){

		$view = $this->view;
       
        $view->header_title = '代理银行资料编辑';

        $get = input('param.');

        $agencymanage = new amanage();

        $agency_bank_info = array();

        $where = array();

        if(!empty($get)){

        	if(!empty($get['uid'])){

        		$where['uid'] = $get['uid'];
        	
        	}       	
			  		
        }

        $agency_bank_info = $agencymanage->get_one_agency_bank_info($where);
       
        $view->agency_bank_info = $agency_bank_info; 
              						      
	    // 模板输出
	    return $this->fetch();
	}

	/*
    *代理银行资料修改    
    */
    public function agency_bank_info_save(){

    	$post = input('post.');
    	
    	$data = array();

        if(!empty($post)){

            $data['weixin'] = $post['weixin'];
    	
    		$data['alipay'] = $post['alipay'];
    		
    		$data['opening_bank'] = $post['opening_bank'];
    		
    		$data['branch'] = $post['branch'];
    		
    		$data['bank_name'] = $post['bank_name'];

    		$data['bank_account'] = $post['bank_account'];

        }
    	    	   	
    	$where = array();
    	
    	$where['uid'] = $post['uid'];
    	
    	$where['id'] = $post['id'];

    	$agencymanage = new amanage();

    	$res = $agencymanage->handle_agency_bank_info_update($data,$where);

    	if($res){
    		
    		$this->success($res['msg'],'/agency_bank_info_list.html');
    	
    	}else{
    		
    		$this->error($res['msg'],'/agency_bank_info_list.html');
    	
    	}

    }

    /*
	*代理首页公告编辑
	*/ 
	public function agency_index_note(){

		$view = $this->view;
       
        $view->header_title = '代理首页公告编辑';

        $post = input('post.');

        $agencymanage = new amanage();

        $agency_index_note = array();
        
        if(!empty($post)){

        	$data = array();
        	
        	$where = array();

        	$data['setting_value'] = $post['setting_value'];

        	$where['id'] = $post['id'];

        	$res = $agencymanage->handle_agency_index_note_info_update($data,$where);

        	if($res){
    		
	    		$this->success($res['msg'],'/agency_index_note.html');
	    	
	    	}else{
	    		
	    		$this->error($res['msg'],'/agency_index_note.html');
	    	
	    	}
			  		
        }

        $agency_index_note = $agencymanage->get_index_note_info('system_setting','*',"setting_name='agency_index_note'",$this->db_config);

        $view->agency_index_note = $agency_index_note; 
              						      
	    // 模板输出
	    return $this->fetch();
	}

	/*
	*代理返卡列表
	*/ 
	public function agency_get_dimond_back_log(){

		$view = $this->view;
       
        $view->header_title = '代理返卡列表';

        $get = input('get.');

        $agencymanage = new amanage();

        $all_info = array();

        $where = array();

        if(!empty($get)){
        	       	      				
			if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where['create_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
			  		
        }

        $all_info = $agencymanage->get_all_agency_get_dimond_back_log_info($where,100);
 
        $page = $all_info->render();	
		
		$view->page = $page;
		
        $view->all_info = $all_info; 
							      
	    // 模板输出
	    return $this->fetch();
	}

	/*
	*代理返现列表
	*/ 
	public function agency_get_money_back_log(){

		$view = $this->view;
       
        $view->header_title = '代理返现列表';

        $get = input('get.');

        $agencymanage = new amanage();

        $all_info = array();

        $where = array();
        
        $where1 = array();

        if(!empty($get)){
        	       	      				
			if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where['handle_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
				
				$where1['back_create_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
			  		
        }

        $all_info = $agencymanage->get_all_agency_money_back_log_info($where,100);

        $all_info1 = $agencymanage->get_all_agency_every_month_money_back_info($where1,100);

        $page = $all_info->render();	
		
		$view->page = $page;
		
        $view->all_info = $all_info; 
       
        $view->all_info1 = $all_info1; 
							      
	    // 模板输出
	    return $this->fetch();
	}

	/*
	*代理返现处理
	*/ 
	public function handle_give_money(){

		$get = input('get.');

		$agencymanage = new amanage();

		$where = array();

		$where['id'] = $get['id'];

		$data = array();

		$data['back_time'] = time();
		
		$data['status'] = 1;

		$res = $agencymanage->handle_agency_give_money_update($data,$where);

		echo json_encode($res);die;
	
	}

	/*
	*代理返卡处理
	*/ 
	public function handle_give_dimond(){

		$get = input('get.');

		$agencymanage = new amanage();

		$where = array();

		$where['id'] = $get['id'];

		$data = array();

		$data['handle_time'] = time();
		
		$data['status'] = 1;

		$res = $agencymanage->handle_agency_give_dimond_update($data,$where);

		echo json_encode($res);die;
	
	}

	/*
	*新增代理
	*/ 
	public function agency_add(){

		$view = $this->view;
       
        $view->header_title = '代理生成';

        $post = input('post.');

        $agencymanage = new amanage();

        if(!empty($post)){

        	$rand_num = $this->rand_num();
        	
        	$check_rand_num = $this->check_agency_rand_num($rand_num);

        	$data = array();
        	
        	if($post['act']=='grade1'){

        		$data['uid'] = 'hg' . $check_rand_num;	
        		
        		$data['grade'] = 1;	

        	}

        	if($post['act']=='grade2'){

        		$data['uid'] = 'zs' . $check_rand_num;	
        		
        		$data['uber_agency'] = $post['uber_agency'];	
        		
        		$data['grade'] = 2;	

        	}

        	if($post['act']=='grade3'){

        		$data['uid'] = 'bj' . $check_rand_num;	

        		$data['uber_agency'] = $post['uber_agency'];	
        		
        		$data['grade'] = 3;	

        	}


        	$data['register_time'] = time();

        	$data['password'] = $this->rand_num(8);

        	$where = array();

        	$where['uid'] = $data['uid'];

        	$insert_res = $agencymanage->handle_agency_add($data,$where);

        	echo json_encode($insert_res);die;

        }

        

        // 模板输出
	    return $this->fetch();
	}


	/*
	*随机数字
	*/ 
	public function rand_num($length=4) { 
		// 密码字符集，可任意添加你需要的字符 
		$chars = '0123456789'; 
		$password =''; 
		for ( $i = 0; $i < $length; $i++ ) { 
			// 这里提供两种字符获取方式 
			// 第一种是使用 substr 截取$chars中的任意一位字符； 
			// 第二种是取字符数组 $chars 的任意元素 
			// $password .= substr($chars, mt_rand(0, strlen($chars) – 1), 1); 
			$password .= $chars[ mt_rand(0, strlen($chars) - 1) ]; 
		} 
		return $password; 
	} 

	/*
	*检查代理随机数
	*/ 
	public function check_agency_rand_num($rand_num){

		$where = array();

		$where['uid'] = ['like',"%$rand_num%"];

		$res = Db::connect($this->db_config)->name('agency')->where($where)->find();

		if(!empty($res)){

			$rand_num1 = $this->rand_num();

			$this->check_agency_rand_num($rand_num1);

			return $rand_num1;

		}

		return $rand_num;

	}


}    