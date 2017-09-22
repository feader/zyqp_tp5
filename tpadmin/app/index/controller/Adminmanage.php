<?php
namespace app\index\controller;
use \think\Controller;
use \think\Session;
use \think\Db;
use \think\Request;
use \think\Paginator;
use app\index\model\Adminmanage as amanage;

class Adminmanage extends Auth{

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
    *登陆后的总览页    
    */          
    public function admin_list(){
    	
        $view = $this->view;
       
        $view->header_title = '管理员列表';
      
        $gid = Session::get('admin_group_id',$this->db_config['database'].'_admin');

        $get = input('param.');
      
        $where = array();

        if(isset($get) && !empty($get)){
        	   	
        	if(!empty($get['uid'])){
        		$where['uid'] = $get['uid'];  		
        	}
        	if(!empty($get['username'])){
        		$where['username'] = $get['username'];       		
        	}
        	
        }

        switch ($gid) {
        	case 1:
        		$admin_info = amanage::get_all_admin_list($where,$this->db_config);
        		break;
        	case 2:
        		$admin_info = amanage::below_level_admin_list($where,$gid,$this->db_config);
        		break;	
        	case 3:
        		$admin_info = array();
        		break;		
        	
        	default:
        		$admin_info = array();
        		break;
        }

        $page = $admin_info->render();	
		
		$view->page = $page;
				      
    	$view->admin_info = $admin_info; 
    	
    	$view->gid = $gid; 

	    // 模板输出
	    return $this->fetch();
    }

    /*
    *管理员编辑页    
    */ 
    public function admin_edit(){

    	$view = $this->view;

    	$view->header_title = '管理员编辑';

    	$uid = input('param.uid');
   	
    	$admin_info = amanage::get_one_admin_info($uid,$this->db_config);

    	$group = amanage::get_all_admin_group($this->db_config);

    	$view->admin_info = $admin_info; 
    	
    	$view->group = $group; 

	    // 模板输出
	    return $this->fetch();
    }

    /*
    *管理员编辑页    
    */ 
    public function admin_add(){

    	$gid = Session::get('admin_group_id',$this->database.'_admin');

    	if($gid!=1){
    		$this->error('权限不够','/admin_list.html');
    	}

    	$view = $this->view;

    	$view->header_title = '管理员新增';
    	
    	$group = amanage::get_all_admin_group($this->db_config);
    	
    	$view->group = $group; 
    	
    	$view->gid = $gid; 

	    // 模板输出
	    return $this->fetch();
    }

    /*
    *管理员信息修改    
    */
    public function admin_info_save(){

    	$post = input('post.');
    	
    	$data = array();

        if(!empty($post['password'])){

            $data['passwd'] = md5($post['password']);

        }
    	    	
    	$data['gid'] = $post['gid'];
    	
    	$where = array();
    	
    	$where['uid'] = $post['uid'];
    	
    	$where['username'] = $post['username'];

    	$res = amanage::handle_admin_info_update($data,$where,$this->db_config);

    	if($res){
    		
    		$this->success($res['msg'],'/admin_list.html');
    	
    	}else{
    		
    		$this->error($res['msg'],'/admin_list.html');
    	
    	}

    }

    /*
    *新增管理员    
    */
    public function admin_add_save(){

    	$post = input('post.');
    	
    	$data = array();

    	$data['passwd'] = md5($post['password']);
    	
    	$data['gid'] = $post['gid'];
    	
    	$data['username'] = $post['username'];
    	
    	$where = array();
    		
    	$where['username'] = $post['username'];

    	$res = amanage::handle_admin_add($data,$where,$this->db_config);

    	if($res){
    		
    		$this->success($res['msg'],'/admin_list.html');
    	
    	}else{
    		
    		$this->error($res['msg'],'/admin_list.html');
    	
    	}

    }

    /*
    *管理员删除    
    */
    public function admin_del(){

    	$id = input('param.id');
    	
    	$username = input('param.username');

    	$res = amanage::del_admin($id,$username,$this->db_config);
    	
    	if($res){
    		$this->success($res['msg'],'/admin_list.html');
    	}else{
    		$this->error($res['msg'],'/admin_list.html');
    	}
    }

    /*
    *管理组群列表页    
    */          
    public function admin_group(){
        
        $view = $this->view;
       
        $view->header_title = '管理员组群';
      
        $gid = Session::get('admin_group_id',$this->db_config['database'].'_admin');
      
        $admin_group = amanage::get_all_admin_group_info($this->db_config);        
                           
        $view->admin_group = $admin_group; 
        
        $view->gid = $gid; 

        // 模板输出
        return $this->fetch();
    }

    /*
    *管理组群编辑页    
    */ 
    public function admin_group_edit(){

        $view = $this->view;

        $view->header_title = '管理员组群编辑';

        $gid = input('param.gid');
    
        $admin_group_info = amanage::get_one_admin_group_info($gid,$this->db_config);

        $menu = $this->left_nav();

        $group_menu = amanage::handle_menu_power($menu,$admin_group_info['power'],$this->db_config);

        $view->admin_group_info = $admin_group_info; 
        
        $view->group_menu = $group_menu; 
     
        // 模板输出
        return $this->fetch();
    }

    /*
    *管理群组新增页    
    */ 
    public function admin_group_add(){

        $gid = Session::get('admin_group_id','admin');
        
        $admin_user = Session::get('admin_user',$this->db_config['database'].'_admin');

        if($gid!=1){
            
            $this->error('权限不够','/admin_group.html');
        
        }

        $view = $this->view;

        $view->header_title = '管理群组新增';

        $menu = $this->left_nav();
        
        $group_menu = amanage::handle_menu_add_info($menu,$this->db_config);
       
        $view->group_menu = $group_menu; 

        $view->gid = $gid; 
        
        $view->admin_user = $admin_user; 
        
        // 模板输出
        return $this->fetch();
    }

    /*
    *管理组群信息修改    
    */
    public function admin_group_save(){

        $post = input('post.');
        
        $data = array();

        if(empty($post['gid'])){

            $this->error('非法操作！','/admin_group.html');

        }

        $data['remark'] = $post['remark'];
        
        $data['name'] = $post['name'];

        $data['power'] = implode($post['power'],',');
        
        $where = array();
        
        $where['gid'] = $post['gid'];
        
        $res = amanage::handle_admin_group_info_update($data,$where,$this->db_config);

        if($res){
            
            $this->success($res['msg'],'/admin_group.html');
        
        }else{
            
            $this->error($res['msg'],'/admin_group.html');
        
        }

    }

    /*
    *管理组群信息修改    
    */
    public function admin_group_add_save(){

        $post = input('post.');
        
        $data = array();

        if(empty($post['gid'])||empty($post['admin_user'])){

            $this->error('非法操作！','/admin_group.html');

        }

        $data['remark'] = $post['remark'];
        
        $data['name'] = $post['name'];

        $data['power'] = implode($post['power'],',');
        
        $where = array();
        
        $where['gid'] = $post['gid'];
        
        $where['username'] = $post['admin_user'];
        
        $res = amanage::handle_admin_group_info_add($data,$where,$this->db_config);

        if($res){
            
            $this->success($res['msg'],'/admin_group.html');
        
        }else{
            
            $this->error($res['msg'],'/admin_group.html');
        
        }

    }

    /*
    *管理群组删除    
    */
    public function admin_group_del(){

        $gid = input('param.gid');
        
        $res = amanage::admin_group_del($gid,$this->db_config);
        
        if($res){
            $this->success($res['msg'],'/admin_group.html');
        }else{
            $this->error($res['msg'],'/admin_group.html');
        }
    }

    /*
    *线下赛编辑页    
    */ 
    public function offline_play_setting(){
 	
    	$view = $this->view;

    	$view->header_title = '线下赛设置';
    	
    	$offline_play_setting = amanage::get_offline_play_setting_info($this->db_config);

    	$view->offline_play_setting = $offline_play_setting; 
    	
	    // 模板输出
	    return $this->fetch();
    }

    /*
    *线下赛信息修改    
    */
    public function offline_play_setting_save(){

    	$post = input('post.');
    	
    	$data = array();
    	
    	$data['start_time'] = strtotime($post['start_time']);
    	
    	$data['end_time'] = strtotime($post['end_time']);
    	
    	$data['join_point'] = $post['join_point'];
    	
    	$where = array();
    	
    	$where['id'] = $post['id'];
    
    	$res = amanage::handle_offline_play_setting_info_update($data,$where,$this->db_config);
			
    	if($res){

    		$interface_port_num = amanage::get_system_setting_info('system_setting','setting_value',"setting_name='interface_port_num'",$this->db_config);

			$web_server = amanage::get_system_setting_info('system_setting','setting_value',"setting_name='web_server'",$this->db_config);

			$curl = $this->offline_play_setting_curl($web_server,'gm/modify_offline_competition_time',$data,$interface_port_num);
    		
    		$this->success($res['msg'],'/offline_play_setting.html');
    	
    	}else{
    		
    		$this->error($res['msg'],'/offline_play_setting.html');
    	
    	}

    }

    /*
    *系统参数设置信息列表    
    */
    public function system_value_list(){
    	
        $view = $this->view;
       
        $view->header_title = '参数设置';

        $setting_list = amanage::get_all_system_setting_info($this->db_config);
      
    	$view->setting_list = $setting_list; 

	    // // 模板输出
	    return $this->fetch();
    }

    /*
    *系统参数设置信息列表    
    */
    public function system_value_save(){

    	$post = input('post.');
    	
    	$data = array();
    	
    	$data['setting_value'] = $post['setting_value'];
    	
    	$where = array();
    	
    	$where['id'] = $post['id'];
    	  
    	$res = amanage::handle_system_value_update($data,$where,$this->db_config);
 	
    	echo json_encode($res);
    }

    /*
    *线下赛设置
    */
    public function offline_play_setting_curl($web_server,$part,$data,$port){
		$start_time = $data['start_time'];
		$end_time = $data['end_time'];
		$joinpoint = $data['join_point'];
		$url = $web_server.':'.$port.'/'.$part."?start=$start_time&end=$end_time&needpoint=$joinpoint";	
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