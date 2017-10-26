<?php
namespace app\index\controller;
use \think\Controller;
use \think\Session;
use \think\Db;
use \think\Request;
use \think\Paginator;
use app\index\model\Gamemanage as gmanage;

class Gamemanage extends Auth{

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
	*消耗钻石列表
	*/ 
	public function dimond_log(){
   
        $this->view->header_title = '消耗钻石';

        $get = input('get.');

        $gamemanage = new gmanage();

        $all_info = array();

        $where = array();

        if(!empty($get)){
        	      				
			if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where['write_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
			  		
        }

        $all_cost = Db::connect($this->db_config)->name("everyday_user_dimond_log")->order('write_time desc')->sum('everyday_total_use');

        $all_info = $gamemanage->get_all_dimond_log_info($where,365,$this->db_config);

        $everyday_total_use = 0;

        foreach ($all_info as $k => $v) {
        	$everyday_total_use += $v['everyday_total_use'];
        }

        $page = $all_info->render();	
		
		$this->view->page = $page;
		
		$this->view->all_cost = $all_cost;
		
		$this->view->search_cost = $everyday_total_use;

        $this->view->all_info = $all_info; 
							      
	    // 模板输出
	    return $this->fetch();
	}

	/*
	*excel导出代理出售给代理列表
	*/ 
	public function dimond_log_down_excel(){

		$get = input('get.');

        $where = array();

        if(!empty($get)){
            	      				
			if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where['write_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
			  		
        }

        $all_info = Db::connect($this->db_config)->name("everyday_user_dimond_log")->field('date_time,everyday_total_use')->where($where)->order('write_time desc')->select();

        $header=['日期','每日钻石消耗'];

        $setWidth = [
        'A'=>'15','B'=>'15'
        ];
        
        self::excel('消耗钻石',$header,$all_info,$setWidth);
        
	}

	/*
	*玩家反馈列表
	*/ 
	public function user_complain(){

		$view = $this->view;
       
        $view->header_title = '玩家反馈';

        $get = input('get.');

        $gamemanage = new gmanage();

        $all_info = array();

        $where = array();

        if(!empty($get)){

        	if(!empty($get['uid'])){

        		$where['uid'] = $get['uid'];
        	
        	}

        	if(!empty($get['handler'])){

        		$where['handler'] = $get['handler'];
        	
        	}
        	      				
			if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where['create_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
			  		
        }
       
        $all_info = $gamemanage->get_all_user_complain_info($where,100,$this->db_config);
       
        $page = $all_info->render();	
		
		$view->page = $page;
		
        $view->all_info = $all_info; 
							      
	    // 模板输出
	    return $this->fetch();
	}

	/*
	*excel导出玩家反馈列表
	*/ 
	public function user_complain_down_excel(){
		
		$get = input('get.');

        $where = array();

        if(!empty($get)){

        	if(!empty($get['uid'])){

        		$where['uid'] = $get['uid'];
        	
        	}

        	if(!empty($get['handler'])){

        		$where['handler'] = $get['handler'];
        	
        	}
      				
			if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where['create_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
			  		
        }

        $all_info = Db::connect($this->db_config)->name("user_complain")->field('uid,contact_way,status,content,call_back,handler,create_time,update_time')->where($where)->order(['create_time'=>'desc'])->select();

        foreach ($all_info as $k => $v) {
        	
        	$all_info[$k]['create_time'] = date('Y-m-d h:i:s',$v['create_time']);   
			
			$all_info[$k]['update_time'] = date('Y-m-d h:i:s',$v['update_time']); 
			
			$all_info[$k]['status'] = $v['status']==1 ? '已回复' : '未回复'; 
			        
        }

        $header=['玩家UID','联系方式','状态','内容','回复','处理人','生成时间','回复时间'];

        $setWidth = [
        'B'=>'20','D'=>'30','E'=>'30','G'=>'20','H'=>'20'
        ];
        
        self::excel('玩家反馈',$header,$all_info,$setWidth);
        
	}

	/*
	*钻石明细列表
	*/ 
	public function dimond_used(){

		$view = $this->view;
       
        $view->header_title = '钻石明细';

        $get = input('get.');

        $gamemanage = new gmanage();

        $all_info = array();

        $where = array();

        if(!empty($get)){

        	if(!empty($get['uid'])){

        		$where['uid'] = $get['uid'];
        	
        	}
       	        	      				
			if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where['create_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
			  		
        }
       
        $all_info = $gamemanage->get_all_dimond_used_info($where,100,$this->db_config);

        $all_dimond_used = Db::connect($this->db_config)->name("user_dimond_log")->order('use_time desc')->sum('use_dimond');

        $page = $all_info->render();	
		
		$view->page = $page;
		
        $view->all_info = $all_info; 
        
        $view->all_dimond_used = $all_dimond_used; 
							      
	    // 模板输出
	    return $this->fetch();
	}

	/*
	*excel导出钻石消耗列表
	*/ 
	public function dimond_used_down_excel(){
		
		$get = input('get.');

        $where = array();

        if(!empty($get)){

        	if(!empty($get['uid'])){

        		$where['uid'] = $get['uid'];
        	
        	}

			if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where['create_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
			  		
        }

        $all_info = Db::connect($this->db_config)->name("user_dimond_log")->field('uid,use_dimond,use_time')->where($where)->order(['use_time'=>'desc'])->select();

        foreach ($all_info as $k => $v) {
        	
        	$all_info[$k]['use_time'] = date('Y-m-d h:i:s',$v['use_time']);   
			        
        }

        $header=['玩家UID','消耗钻石','消耗时间'];

        $setWidth = [
        'C'=>'20',
        ];
        
        self::excel('钻石明细',$header,$all_info,$setWidth);
        
	}

	/*
	*玩家反馈列表
	*/ 
	public function admin_action_log(){

		$view = $this->view;
       
        $view->header_title = '日志管理';

        $get = input('get.');

        $gamemanage = new gmanage();

        $all_info = array();

        $where = array();

        if(!empty($get)){

        	if(!empty($get['uid'])){

        		$where['uid'] = $get['uid'];
        	
        	}

        	if(!empty($get['content'])){

        		$where['content'] = $get['content'];
        	
        	}

        	if(!empty($get['handler'])){

        		$where['handler'] = $get['handler'];
        	
        	}
        	      				
			if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where['action_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
			  		
        }
       
        $all_info = $gamemanage->get_all_ban_log_info($where,100,$this->db_config);

        $page = $all_info->render();	
		
		$view->page = $page;
		
        $view->all_info = $all_info; 
							      
	    // 模板输出
	    return $this->fetch();
	}

	/*
	*excel导出日志记录列表
	*/ 
	public function admin_action_log_down_excel(){
		
		$get = input('get.');

        $where = array();

        if(!empty($get)){

        	if(!empty($get['uid'])){

        		$where['uid'] = $get['uid'];
        	
        	}

        	if(!empty($get['content'])){

        		$where['content'] = $get['content'];
        	
        	}

        	if(!empty($get['handler'])){

        		$where['handler'] = $get['handler'];
        	
        	}

			if(!empty($get['date_begin']) && !empty($get['date_end'])){

				$where['action_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
			  		
        }

        $all_info = Db::connect($this->db_config)->name("ban_log")->field('uid,content,handler,action_type,action_time')->where($where)->order(['action_time'=>'desc'])->select();

        foreach ($all_info as $k => $v) {
        	
        	$all_info[$k]['action_time'] = date('Y-m-d h:i:s',$v['action_time']);   
        	 			        
        	switch ($v['action_type']) {
	        	case 0:
	        		$all_info[$k]['action_type'] = '默认';
	        		break;
	        	case 1:
	        		$all_info[$k]['action_type'] = '封禁';
	        		break;
	        	case 2:
	        		$all_info[$k]['action_type'] = '解封';
	        		break;		
	        	
	        	default:
	        		$all_info[$k]['action_type'] = '错误';
	        		break;
	        }
        }



        $header=['玩家UID','内容','操作者','类型','操作时间'];

        $setWidth = [
        'B'=>'40','E'=>'20',
        ];
        
        self::excel('日志记录',$header,$all_info,$setWidth);
        
	}

	/*
	*线下赛玩家列表
	*/ 
	public function offline_player_list(){

		$view = $this->view;
       
        $view->header_title = '线下赛';

        $get = input('get.');

        $gamemanage = new gmanage();

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

				$where['create_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
			  		
        }
       
        $all_info = $gamemanage->get_all_offline_player_list_info($where,100,$this->db_config);

        $page = $all_info->render();	
		
		$view->page = $page;
		
        $view->all_info = $all_info; 
							      
	    // 模板输出
	    return $this->fetch();
	}

	/*
	*excel导出线下赛记录列表
	*/ 
	public function offline_player_list_down_excel(){
		
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

				$where['create_time'] = ['between',[strtotime($get['date_begin']),strtotime($get['date_end'])]];
			
			}
			  		
        }

        $all_info = Db::connect($this->db_config)->view('offline_play','uid,create_time')
			    ->view('game_user','username','offline_play.uid=game_user.uid','LEFT')	
			    ->where($where)			
			    ->order(['create_time'=>'desc'])
			    ->select();

        foreach ($all_info as $k => $v) {
        	
        	$all_info[$k]['create_time'] = date('Y-m-d h:i:s',$v['create_time']);   
        	 			                	
        }

        $header=['玩家UID','操作时间','玩家名'];

        $setWidth = [
        'B'=>'20','C'=>'30',
        ];
        
        self::excel('线下赛',$header,$all_info,$setWidth);
        
	}

    /*
    *游戏公告
    */ 
    public function game_notice(){
        
        $view = $this->view;
       
        $view->header_title = '游戏公告';

        $post = input('post.');

        $gamemanage = new gmanage();

        if(!empty($post)){

            $data = array();
            
            $where = array();

            $data['setting_value'] = $post['setting_value'];

            $where['id'] = $post['id'];

            $res = $gamemanage->handle_game_note_info_update($data,$where,$this->db_config);

            if($res){

                $interface_port_num = $gamemanage->get_system_setting_info('system_setting','setting_value',"setting_name='interface_port_num'",$this->db_config);

                $web_server = $gamemanage->get_system_setting_info('system_setting','setting_value',"setting_name='web_server'",$this->db_config);

                $curl = $this->game_notice_setting_curl($web_server,'gm/set_billboard_content',$data,$interface_port_num);

                $this->success($res['msg'],'/game_notice.html');
            
            }else{
                
                $this->error($res['msg'],'/game_notice.html');
            
            }
                    
        }

        $game_notice_info = $gamemanage->get_game_notice_info($this->db_config);

        $view->game_notice_info = $game_notice_info; 
                                  
        // 模板输出
        return $this->fetch();

    }

    /*
    *线下赛设置
    */
    public function game_notice_setting_curl($web_server,$part,$data,$port){
        $content = $data['setting_value'];
        $url = $web_server.':'.$port.'/'.$part."?content=$content";
        //var_dump($url);die;
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        //释放curl句柄
        curl_close($ch);
        //打印获得的数据       
        return $output;
    }


}