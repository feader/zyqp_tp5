<?php
namespace app\index\model;
use \think\Model;
use \think\Db;
use \think\Session;

class Usermanage extends Tool{

	protected $db_config;

	public function __construct(){

		$db_config = Session::get('db_config','db_config');

		$this->db_config = $db_config;
	}

	/*
	*获取某个用户的的信息
	*@ $uid玩家uid
	*/ 
	public function get_one_play_info($uid){

		$res = Db::connect($this->db_config)->name('game_user')->where("uid=$uid")->find();
		
		return $res;
	}

	/*
	*获取所有用户的的信息
	*@ $uid玩家uid
	*/ 
	public function get_all_play_info($where,$page){

		if(empty($where)){
			
			$res = Db::connect($this->db_config)->name('game_user')->order('register_time desc')->paginate($page);
		
		}else{

			$res = Db::connect($this->db_config)->name('game_user')->where($where)->order('register_time desc')->paginate($page);

		}
				
		return $res;
	}

	/*
	*获取所有用户的的信息(通过微信)
	*@ $uid玩家uid
	*/ 
	public function get_all_wx_info($where,$page){

		if(empty($where)){

			$res = Db::connect($this->db_config)->view('agency_and_user','id,agency_id,action_time,unionid')
			    ->view('game_user','uid,username,dimond,sum_dimond,register_time,reg_ip','agency_and_user.unionid=game_user.unionid','LEFT')
			    ->where('uid','not null')	
			    ->where('unionid','not null')	
			    ->where('username','not null')	
			    //->fetchClass('\think\Collection')		 		 
			    ->paginate($page);		
			
		}else{

			$res = Db::connect($this->db_config)->view('agency_and_user','id,agency_id,action_time,unionid')
			    ->view('game_user','uid,username,dimond,sum_dimond,register_time,reg_ip','agency_and_user.unionid=game_user.unionid','LEFT')
			    ->where('uid','not null')			 
			    ->where('unionid','not null')	
			    ->where('username','not null')
			    //->fetchClass('\think\Collection')
			    ->where($where)			
			    ->paginate($page);
								  
		}
				
		return $res;
	}

	/*
	*获取所有用户的的信息(通过微信)
	*@ $uid玩家uid
	*/ 
	public function get_all_ip_info($where,$page){

		if(empty($where)){
		
			$res = Db::connect($this->db_config)->view('agency_and_user','id,agency_id,action_time,unionid')
			    ->view('game_user','uid,username,dimond,sum_dimond,register_time,reg_ip','agency_and_user.agent_ip=game_user.reg_ip','LEFT')
			    ->where('uid','not null')			 
			    ->where('unionid','not null')			 
			    ->where('username','not null')			 
			    ->paginate($page);	
					  	
		}else{

			$res = Db::connect($this->db_config)->view('agency_and_user','id,agency_id,action_time,unionid')
			    ->view('game_user','uid,username,dimond,sum_dimond,register_time,reg_ip','agency_and_user.agent_ip=game_user.reg_ip','LEFT')
			    ->where('uid','not null')			 
			    ->where('unionid','not null')			 
			    ->where('username','not null')	
			    ->where($where)			 
			    ->paginate($page);	
					  
		}

		return $res;
	}


	/*
	*获取某个系统参数
	*@ $where 条件
	*/ 
	public function get_system_setting($where){

		$res = Db::connect($this->db_config)->name('system_setting')->field('setting_value')->where($where)->find();
		
		return $res['setting_value'];
	}

	/*
	*调用通用接口
	*@ $web_server 服务器域名
	*@ $part 接口名
	*@ $uid 用户uid
	*@ $port 端口号
	*/ 
	public function common_curl_handle($web_server,$part,$uid,$port){

		$res = self::common_curl($web_server,$part,$uid,$port);
		
		return $res;
	}

	/*
	*调用大师分控制接口
	* @ $web_server 服务器域名
	* @ $part 接口名
	* @ $data 请求数据
	* @ $port 端口号
	*/ 
	public function master_point_handle($web_server,$part,$data,$port){

		$res = self::master_point_curl($web_server,$part,$data,$port);
		
		return $res;
	}

	/*
	*调用通用接口的操作记录
	*@ $Table 服务器域名
	*@ $Data 接口名
	*/ 
	public function common_curl_log($Table,$Data){

		$res = self::insert_DbIns($Table,$Data);
	
		return $res;
	}


}	