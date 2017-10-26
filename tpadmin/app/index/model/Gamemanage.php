<?php
namespace app\index\model;
use \think\Model;
use \think\Db;
use \think\Session;

class Gamemanage extends Tool{

	// protected $db_config;

	// public function __construct(){

	// 	$db_config = Session::get('db_config','db_config');

	// 	$this->db_config = $db_config;
	// }


	/*
	*获取所有每日钻石的信息
	*/ 
	public function get_all_dimond_log_info($where,$page,$db_config){

		if(empty($where)){
		
			$res = Db::connect($db_config)->name('everyday_user_dimond_log')->order(['write_time'=>'desc'])->paginate($page);

		}else{

			$res = Db::connect($db_config)->name('everyday_user_dimond_log')->where($where)->order(['write_time'=>'desc'])->paginate($page);

		}
				
		return $res;
	}

	/*
	*获取玩家反馈的信息
	*/ 
	public function get_all_user_complain_info($where,$page,$db_config){

		if(empty($where)){
			
			$res = Db::connect($db_config)->name('user_complain')->order(['create_time'=>'desc'])->paginate($page);
		
		}else{

			$res = Db::connect($db_config)->name('user_complain')->where($where)->order(['create_time'=>'desc'])->paginate($page);

		}
					
		return $res;
	}

	/*
	*获取钻石明细的信息
	*/ 
	public function get_all_dimond_used_info($where,$page,$db_config){

		if(empty($where)){
			
			$res = Db::connect($db_config)->name('user_dimond_log')->order(['use_time'=>'desc'])->paginate($page);
		
		}else{

			$res = Db::connect($db_config)->name('user_dimond_log')->where($where)->order(['use_time'=>'desc'])->paginate($page);

		}
				
		return $res;
	}

	/*
	*获取管理员日志记录的信息
	*/ 
	public function get_all_ban_log_info($where,$page,$db_config){

		if(empty($where)){
			
			$res = Db::connect($db_config)->name('ban_log')->order(['action_time'=>'desc'])->paginate($page);
		
		}else{

			$res = Db::connect($db_config)->name('ban_log')->where($where)->order(['action_time'=>'desc'])->paginate($page);

		}
				
		return $res;
	}

	/*
	*获取线下赛玩家记录的信息
	*/ 
	public function get_all_offline_player_list_info($where,$page,$db_config){

		if(empty($where)){
			
			$res = Db::connect($db_config)->view('offline_play','uid,create_time,unionid')
			    ->view('game_user','username','offline_play.uid=game_user.uid','LEFT')				
			    ->order(['create_time'=>'desc'])
			    // ->fetchSql(true) 		 
			    ->paginate($page);		
		
		}else{

			$res = Db::connect($db_config)->view('offline_play','uid,create_time,unionid')
			    ->view('game_user','username','offline_play.uid=game_user.uid','LEFT')	
			    ->where($where)			
			    ->order(['create_time'=>'desc'])
			    // ->fetchSql(true)
			    ->paginate($page);	

		}
				
		return $res;
	}

	/*
	*获取游戏公告
	*/ 
	public function get_game_notice_info($db_config){
		
		$res = Db::connect($db_config)->name('system_setting')->where("setting_name='game_notice'")->find();
				
		return $res;
	}

	/*
	*更新某个代理银行资料的数据
	*@$data 用户数据
	*@$where 更新依据
	*/ 
	public function handle_game_note_info_update($data,$where,$db_config){
		
		$res = array();
		
		$table = 'system_setting';
		
		$field = 'id';
		
		$check = self::check_info_exists($table,$field,$where,$db_config);
		
		if($check){

			if($check['id']!=$where['id']){
				
				$res['code'] = 0;
				
				$res['msg'] = '信息错误！';
				
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
	*获取系统参数
	*/ 
	public function get_system_setting_info($table,$field,$where,$db_config){
			
		$res = self::check_info_exists($table,$field,$where,$db_config);
		
		return $res['setting_value'];
	
	}


}