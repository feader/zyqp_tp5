<?php
namespace app\index\model;
use \think\Model;
use \think\Db;
use \think\Session;

class Adminmanage extends Tool{

	//protected $db_config;

	public function __construct(){

		// $db_config = Session::get('db_config','db_config');

		// $this->db_config = $db_config;

	}

	/*
	*获取所有管理员用户的数据
	*/ 
	public static function get_all_admin_list($where,$db_config){
		
		$all_admin_info = self::get_all_admin_info($where,$db_config);
		
		return $all_admin_info;
	
	}

	/*
	*获取用户的数据
	*/ 
	public static function get_all_admin_info($where,$db_config){
		
		$res = Db::connect($db_config)->name('admin_user')->where($where)->paginate(10);
		
		return $res;
	
	}

	/*
	*获取等级比自己低的用户的数据
	*@$gid 用户组
	*/ 
	public static function below_level_admin_list($where,$gid,$db_config){
		
		if(!empty($where)){
			
			$where['gid'] = ['>',$gid];
			
			$res = Db::connect($db_config)->name('admin_user')->where($where)->paginate(10);
		
		}else{
			
			$res = Db::connect($db_config)->name('admin_user')->where("gid>$gid")->paginate(10);
		
		}
	
		return $res;
	
	}

	/*
	*获取等级比自己低的用户的数据
	*@$gid 用户组
	*/ 
	public static function get_all_admin_group($db_config){
			
		$res = Db::connect($db_config)->name('group')->field('gid')->select();
		
		return $res;
	
	}

	/*
	*获取某个用户的数据
	*@$uid 用户uid
	*/ 
	public static function get_one_admin_info($uid,$db_config){
		
		$res = Db::connect($db_config)->name('admin_user')->where("uid=$uid")->find();
		
		return $res;
	
	}

	/*
	*获取线下赛数据
	*/ 
	public static function get_offline_play_setting_info($db_config){
		
		$res = Db::connect($db_config)->name('offline_play_setting')->find(1);
		
		return $res;
	
	}

	/*
	*删除某个管理员用户的数据
	*@$id 用户uid
	*@$username 管理员名
	*/ 
	public static function del_admin($id,$username,$db_config){
		
		$where = array();
		
		$where['uid'] = $id;
		
		$where['username'] = $username;

		$table = 'admin_user';
		
		$field = 'uid,username';
		
		$check = self::check_info_exists($table,$field,$where);
		
		if($check){
		
			if($check['uid']!=$id || $check['username']!=$username){
		
				$res['code'] = 0;
				
				$res['msg'] = '非法操作！';
				
				return $res;
		
			}

			$del_res = Db::connect($db_config)->name('admin_user')->where($where)->delete();

			if($del_res){

				$res['code'] = 1;
				
				$res['msg'] = '删除成功！';
			
			}else{

				$res['code'] = 0;
				
				$res['msg'] = '删除失败！';

			}
			
		}else{
			
			$res['code'] = 0;
				
			$res['msg'] = '非法信息！';

		}
	
		return $res;
	}

	

	/*
	*新增管理员
	*@$data 用户数据
	*@$where 更新依据
	*/ 
	public static function handle_admin_add($data,$where,$db_config){
		
		$res = array();
		
		$table = 'admin_user';
		
		$field = 'uid,username';
		
		$check = self::check_info_exists($table,$field,$where,$db_config);
		
		if($check){
		
			if($check['username']==$data['username']){
		
				$res['code'] = 0;
				
				$res['msg'] = '用户名已存在！';
				
				return $res;
		
			}
						
		}else{
			
			//$insert_res = self::insert_handle($table,$data,$db_config);
			
			$insert_res = self::insert_DbIns($table,$data,$db_config);

			if($insert_res){

				$res['code'] = 1;
				
				$res['msg'] = '新增成功！';
			
			}else{

				$res['code'] = 0;
				
				$res['msg'] = '新增失败！';

			}

		}
		
		return $res;
		
	}


	/*
	*更新某个用户的数据
	*@$data 用户数据
	*@$where 更新依据
	*/ 
	public static function handle_admin_info_update($data,$where,$db_config){
		
		$res = array();
		
		$table = 'admin_user';
		
		$field = 'uid,passwd';
		
		$check = self::check_info_exists($table,$field,$where,$db_config);
		
		if($check){

			if(isset($data['passwd'])){
				
				if($check['passwd']==$data['passwd']){
		
					$res['code'] = 0;
					
					$res['msg'] = '密码一样！';
					
					return $res;
			
				}

			}
					
			$update_res = self::update_handle($table,$where,$data,$db_config);

			if($update_res){

				$res['code'] = 1;
				
				$res['msg'] = '编辑成功！';
			
			}else{

				$res['code'] = 0;
				
				$res['msg'] = '编辑失败！';

			}
			
		}else{
			
			$res['code'] = 0;
				
			$res['msg'] = '非法信息！';

		}
		
		return $res;
		
	}

	/*
	*更新某个用户的数据
	*@$data 用户数据
	*@$where 更新依据
	*/ 
	public static function handle_system_value_update($data,$where,$db_config){
		
		$res = array();
		
		$table = 'system_setting';
		
		$field = 'id,setting_value';
		
		$check = self::check_info_exists($table,$field,$where,$db_config);		
		
		if($check){
		
			if($check['setting_value']==$data['setting_value']){
		
				$res['code'] = 0;
				
				$res['msg'] = '数据一样！';
				
				return $res;
		
			}

			$update_res = self::update_handle($table,$where,$data,$db_config);

			if($update_res){

				$res['code'] = 1;
				
				$res['msg'] = '编辑成功！';
			
			}else{

				$res['code'] = 0;
				
				$res['msg'] = '编辑失败！';

			}
			
		}else{
			
			$res['code'] = 0;
				
			$res['msg'] = '非法信息！';

		}
		
		return $res;
		
	}

	/*
	*更新线下比赛的数据
	*@$data 线下比赛数据
	*@$where 更新依据
	*/ 
	public static function handle_offline_play_setting_info_update($data,$where,$db_config){
		
		$res = array();
		
		$table = 'offline_play_setting';
		
		$field = 'id';
		
		$check = self::check_info_exists($table,$field,$where,$db_config);
		
		if($check){
		
			$update_res = self::update_handle($table,$where,$data,$db_config);

			if($update_res){

				$res['code'] = 1;
				
				$res['msg'] = '编辑成功！';
			
			}else{

				$res['code'] = 0;
				
				$res['msg'] = '数据没变化/编辑失败！';

			}
			
		}else{
			
			$data['id'] = 1;

			$insert_res = self::insert_handle($table,$data,$db_config);
			
			$res['code'] = 0;
				
			$res['msg'] = '非法信息！';

		}
		
		return $res;
		
	}

	/*
	*获取系统参数
	*/ 
	public static function get_system_setting_info($table,$field,$where,$db_config){
			
		$res = self::check_info_exists($table,$field,$where,$db_config);
		
		return $res['setting_value'];
	
	}

	/*
	*获取参数列表(id=1的除外，id=1的是代理首页公告，涉及排版，单独编辑)
	*/ 
	public static function get_all_system_setting_info($db_config){
		
		$res = Db::connect($db_config)->name('system_setting')->where('id not in(1,10)')->select();
		
		return $res;
	
	}

	/*
	*获取组群信息
	*/ 
	public static function get_all_admin_group_info($db_config){
		
		$res = Db::connect($db_config)->name('group')->select();

		foreach ($res as $k => $v) {
			
			$gid = $v['gid'];
			
			$res1 = Db::connect($db_config)->name('admin_user')->where("gid='$gid'")->select();
			
			$admin_users = '';
			
			foreach ($res1 as $k1 => $v1) {
				$admin_users .= $v1['username'].',';
			}
			
			$res[$k]['admin_users'] = trim($admin_users,',');
			
		}
		
		return $res;
	
	}

	/*
	*获取组群信息
	*/ 
	public static function get_one_admin_group_info($gid,$db_config){
		
		$res = Db::connect($db_config)->name('group')->find($gid);

		return $res;
	
	}

	/*
	*处理所有左侧菜单数据
	*@$menu 所有的左侧菜单栏数据
	*@$power_res 对应组群的权限
	*/ 
	public static function handle_menu_power($menu,$power_res){

		$power = explode(',',$power_res);

		foreach ($menu as $k => $v) {
            
            foreach ($v as $k1 => $v1) {
                
                $part = explode(',',$v1);

                $res = in_array($part[1],$power);

                if($res){

                    $left_menus[$k][$part[0]]['check'] = 1;
                    
                    $left_menus[$k][$part[0]]['value'] = $part[1];
               
                }else{

                	$left_menus[$k][$part[0]]['check'] = 0;
                    
                    $left_menus[$k][$part[0]]['value'] = $part[1];

                }
                
            }
            
        }

		return $left_menus;

	}

	/*
	*处理所有左侧菜单数据(用于新增群组)
	*@$menu 所有的左侧菜单栏数据
	*/ 
	public static function handle_menu_add_info($menu){
		
		foreach ($menu as $k => $v) {
            
            foreach ($v as $k1 => $v1) {

            	$part = explode(',',$v1);
                                                                   
                $left_menus[$k][$part[0]]['value'] = $part[1];
                                              
            }
            
        }

		return $left_menus;

	}

	/*
	*更新某个用户的数据
	*@$data 用户数据
	*@$where 更新依据
	*/ 
	public static function handle_admin_group_info_update($data,$where,$db_config){
		
		$res = array();
		
		$table = 'group';
		
		$field = 'gid';
		
		$check = self::check_info_exists($table,$field,$where,$db_config);
		
		if($check){
					
			$update_res = self::update_handle($table,$where,$data,$db_config);

			if($update_res){

				$res['code'] = 1;
				
				$res['msg'] = '编辑成功！';
			
			}else{

				$res['code'] = 0;
				
				$res['msg'] = '编辑失败！';

			}
			
		}else{
			
			$res['code'] = 0;
				
			$res['msg'] = '非法信息！';

		}
		
		return $res;
		
	}

	/*
	*新增某个用户的数据
	*@$data 用户数据
	*@$where 更新依据
	*/ 
	public static function handle_admin_group_info_add($data,$where,$db_config){
		
		$res = array();
		
		$table = 'admin_user';
		
		$field = 'gid,username';
		
		$check = self::check_info_exists($table,$field,$where,$db_config);
		
		if($check){
					
			$insert_res = self::insert_handle('group',$data,$db_config);

			if($insert_res){

				$res['code'] = 1;
				
				$res['msg'] = '新增成功！';
			
			}else{

				$res['code'] = 0;
				
				$res['msg'] = '新增失败！';

			}
			
		}else{
			
			$res['code'] = 0;
				
			$res['msg'] = '非法信息！';

		}
		
		return $res;
		
	}

	/*
	*删除某个管理员群组的数据
	*@ $id 用户uid
	*@ $username 管理员名
	*/ 
	public static function admin_group_del($gid,$db_config){
		
		$where = array();
		
		$where['gid'] = $gid;
		
		$table = 'group';
		
		$field = 'gid';
		
		$check = self::check_info_exists($table,$field,$where,$db_config);
		
		if($check){
		
			if($check['gid']!=$gid){
		
				$res['code'] = 0;
				
				$res['msg'] = '非法操作！';
				
				return $res;
		
			}

			$check_admin = self::check_info_exists('admin_user','uid',$where,$db_config);

			if(!empty($check_admin)){
				
				$res['code'] = 0;
								
				$res['msg'] = '群组里还有管理员！';
				
				return $res;

			}

			$del_res = Db::connect($db_config)->name('group')->where($where)->delete();

			if($del_res){

				$res['code'] = 1;
				
				$res['msg'] = '删除成功！';
			
			}else{

				$res['code'] = 0;
				
				$res['msg'] = '删除失败！';

			}
			
		}else{
			
			$res['code'] = 0;
				
			$res['msg'] = '非法信息！';

		}
	
		return $res;
	}



	
}