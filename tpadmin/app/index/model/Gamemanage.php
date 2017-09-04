<?php
namespace app\index\model;
use \think\Model;
use \think\Db;


class Gamemanage extends Tool{
	/*
	*获取所有每日钻石的信息
	*/ 
	public function get_all_dimond_log_info($where,$page){

		if(empty($where)){
			
			$res = Db::name('everyday_user_dimond_log')->order(['write_time'=>'desc'])->paginate($page);
		
		}else{

			$res = Db::name('everyday_user_dimond_log')->where($where)->order(['write_time'=>'desc'])->paginate($page);

		}
				
		return $res;
	}

	/*
	*获取玩家反馈的信息
	*/ 
	public function get_all_user_complain_info($where,$page){

		if(empty($where)){
			
			$res = Db::name('user_complain')->order(['create_time'=>'desc'])->paginate($page);
		
		}else{

			$res = Db::name('user_complain')->where($where)->order(['create_time'=>'desc'])->paginate($page);

		}
				
		return $res;
	}

	/*
	*获取钻石明细的信息
	*/ 
	public function get_all_dimond_used_info($where,$page){

		if(empty($where)){
			
			$res = Db::name('user_dimond_log')->order(['use_time'=>'desc'])->paginate($page);
		
		}else{

			$res = Db::name('user_dimond_log')->where($where)->order(['use_time'=>'desc'])->paginate($page);

		}
				
		return $res;
	}

	/*
	*获取管理员日志记录的信息
	*/ 
	public function get_all_ban_log_info($where,$page){

		if(empty($where)){
			
			$res = Db::name('ban_log')->order(['action_time'=>'desc'])->paginate($page);
		
		}else{

			$res = Db::name('ban_log')->where($where)->order(['action_time'=>'desc'])->paginate($page);

		}
				
		return $res;
	}

	/*
	*获取线下赛玩家记录的信息
	*/ 
	public function get_all_offline_player_list_info($where,$page){

		if(empty($where)){
			
			$res = Db::view('offline_play','uid,create_time,unionid')
			    ->view('game_user','username','offline_play.uid=game_user.uid','LEFT')				
			    ->order(['create_time'=>'desc'])
			    // ->fetchSql(true) 		 
			    ->paginate($page);		
		
		}else{

			$res = Db::view('offline_play','uid,create_time,unionid')
			    ->view('game_user','username','offline_play.uid=game_user.uid','LEFT')	
			    ->where($where)			
			    ->order(['create_time'=>'desc'])
			    // ->fetchSql(true)
			    ->paginate($page);	

		}
				
		return $res;
	}

}