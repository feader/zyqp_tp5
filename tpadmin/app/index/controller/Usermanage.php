<?php
namespace app\index\controller;
use \think\Controller;
use \think\Session;
use \think\Db;
use \think\Request;
use \think\Paginator;
use app\index\model\Usermanage as umanage;
use PHPExcel_IOFactory;
use PHPExcel;

class Usermanage extends Auth{

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
	*查询玩家用户信息
	*@ $uid玩家的uid
	*/ 
    public function get_one_user_info(){
    	
    	$view = $this->view;
       
        $view->header_title = '用户查询';

        $post = input('post.');

        $one_info = array();

        if(!empty($post) && $post['act']=='find'){

        	$uid = $post['uid'];
      				
			$usermanage = new umanage();

			$one_info = $usermanage->get_one_play_info($uid);

			$view->one_info = $one_info; 

			return $this->fetch();
			       	
        }

        $view->one_info = $one_info; 
								      
	    // 模板输出
	    return $this->fetch();
    }

    /*
	*可公用接口调用
	*@ $uid玩家的uid
	*/ 
	public function curl_url(){
		
		$get = input('get.');

		$part = $get['part'];

		$uid = $get['uid'];

		$admin_user = Session::get('admin_user',$this->database.'_admin');

		$log_data = $this->get_action_content($part);

		$usermanage = new umanage();

		$web_server = $usermanage->get_system_setting("setting_name = 'web_server'");
		
		$port = $usermanage->get_system_setting("setting_name = 'interface_port_num'");

		$data = array();

		$data['uid'] = $uid;
			
		$data['action_time'] = time();
		
		$data['handler'] = $admin_user;

		$data['content'] = $log_data['content'];
	
		$data['action_type'] = $log_data['action_type'];
		
		$curl_handle = $usermanage->common_curl_handle($web_server,$part,$uid,$port);

		$log = $usermanage->common_curl_log('ban_log',$data);

		$return = json_decode($curl_handle,true);

		if($return['errorcode']==0){
			
			$res = 1;
		
		}else{

			$res = 0;

		}

		echo json_encode($res);

	}

	/*
	*用户列表
	*/ 
	public function user_list(){

		$view = $this->view;
       
        $view->header_title = '用户列表';

        $get = input('get.');

        $usermanage = new umanage();

        $all_info = array();

        $where = array();

        if(!empty($get)){

        	if(!empty($get['uid'])){

        		$where['uid'] = $get['uid'];
        	
        	}

        	if(!empty($get['username'])){

        		$where['username'] = $get['username'];
        	
        	}
      				
			if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where['register_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
			  		
        }

        $all_info = $usermanage->get_all_play_info($where,100);

        $page = $all_info->render();	
		
		$view->page = $page;

        $view->all_info = $all_info; 
							      
	    // 模板输出
	    return $this->fetch();
	}

	/*
	*excel导出用户列表
	*/ 
	public function userlist_down_excel(){
		
		$get = input('get.');

        $where = array();

        if(!empty($get)){

        	if(!empty($get['uid'])){

        		$where['uid'] = $get['uid'];
        	
        	}

        	if(!empty($get['username'])){

        		$where['username'] = $get['username'];
        	
        	}
      				
			if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where['register_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
			  		
        }

        $all_info = Db::name("game_user")->field('uid,username,register_time,last_login_time,dimond,sum_dimond')->where($where)->order('register_time desc')->select();

        foreach ($all_info as $k => $v) {
        	
        	$all_info[$k]['register_time'] = date('Y-m-d h:i:s',$v['register_time']);   
			
			$all_info[$k]['last_login_time'] = date('Y-m-d h:i:s',$v['last_login_time']); 
        
        }

        $header=['玩家ID','呢称','注册日期','最后登录日期','钻石余额','总充值钻石'];

        $setWidth = ['C'=>'20','D'=>'20','F'=>'15'];
        
        self::excel('玩家数据',$header,$all_info,$setWidth);
        
	}

	/*
	*代理推广用户列表
	*/ 
	public function agency_wx_tg_list(){

		$view = $this->view;
       
        $view->header_title = '推广用户列表';

        $get = input('get.');

        $usermanage = new umanage();

        $all_info = array();

        $where = array();

        if(!empty($get)){

        	if(!empty($get['uid'])){

        		$where['uid'] = $get['uid'];
        	
        	}
        				  		
        }
			    
        $all_wx_tg_info = $usermanage->get_all_wx_info($where,100);
        
        $all_wx_tg_info_by_ip = $usermanage->get_all_ip_info($where,100);

        $res1 = object2array($all_wx_tg_info);

        $res2 = object2array($all_wx_tg_info_by_ip);

        $res = array_merge($res1,$res2);

        $page = $all_wx_tg_info->render();	
		
		$view->page = $page;

        $view->all_wx_tg_info = $res; 
        							      
	    // 模板输出
	    return $this->fetch();

	}

	/*
	*用户大师分调整
	*/ 
	public function master_point(){
		
		$view = $this->view;
       
        $view->header_title = '大师分调整';

        // 模板输出
	    return $this->fetch();
	}

	/*
	*大师分用户查询
	*/ 
	public function check_user_info(){
		
		$get = input('get.');

		$uid = $get['uid'];
		
		$usermanage = new umanage();

		$user_info = $usermanage->get_one_play_info($uid);

		$result = array();

		if(!empty($user_info)){

			$result['code'] = 1;

			$result['msg'] = '用户存在！用户名：'.$user_info['username'].'，用户UID：'.$user_info['uid'];

			$result['uid'] = $user_info['uid'];
		
		}else{

			$result['code'] = 0;

			$result['msg'] = '用户不存在!';
		
		}

		echo json_encode($result);die;
	}

	/*
	*大师分处理
	*/
	public function master_point_handle(){
		
		$get = input('get.');

		$data = array();

		$data['uid'] = $get['uid'];
		
		$data['add_point'] = $get['add_point'];

		$usermanage = new umanage();

		$check = $usermanage->get_one_play_info($get['uid']);

		if($check['uid'] == $get['uid']){

			$web_server = $usermanage->get_system_setting("setting_name = 'web_server'");
		
			$port = $usermanage->get_system_setting("setting_name = 'interface_port_num'");

			$part = 'gm/add_point';

			$master_point_handle = $usermanage->master_point_handle($web_server,$part,$data,$port);

			$res = json_decode($master_point_handle,true);

			$result = array();

			if($res['errorcode']==0){

				$result['code'] = 1;

				$result['msg'] = '修改成功！';

			}else{

				$result['code'] = 0;

				$result['msg'] = '修改失败！';
			}

		}else{

			$result['code'] = 0;

			$result['msg'] = '玩家UID错误！';
		
		}

		echo json_encode($result);die;
		
	}


	/*
	*可公用接口的日志记录信息
	*@ $str接口信息
	*/ 
	private function get_action_content($str){
	
		switch ($str) {
			case 'gm/kick_down':
				$content = '清除卡线';
				$action_type = 0;
				break;
			case 'gm/clear_diamond':
				$content = '房卡清零';
				$action_type = 0;
				break;
			case 'gm/ban_account':
				$content = '封号';
				$action_type = 1;
				break;
			case 'gm/dis_ban_account':
				$content = '解封';
				$action_type = 2;
				break;					
			default:
				$content = '未知';
				$action_type = 0;
				break;
		}
		
		$data = array();
		
		$data['content'] = $content;
		
		$data['action_type'] = $action_type;
		
		return $data;
	}


	













}	