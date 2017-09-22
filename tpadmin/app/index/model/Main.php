<?php
namespace app\index\model;
use \think\Model;
use \think\Db;
use \think\Session;

class Main extends Tool{

	/*
	* 获取指定时间范围内的在线数据
	*/ 
	public function get_one_day_online_data_log($where,$db_config){

		$res = Db::connect($db_config)->name('online_log')->where($where)->select();
		
		return $res;
	}

	/*
	* 获取所有数据统计的数据
	*/ 
	public function get_all_data_count_log($where,$db_config){

		$res = Db::connect($db_config)->name('data_count')->where($where)->order('data_time desc')->paginate(30);
		
		return $res;
	}

	/*
	* 获取所有房间记录的数据
	*/ 
	public function get_all_room_log($where,$db_config){

		$res = Db::connect($db_config)->name('game_room_log')->where($where)->order('action_time desc')->paginate(20);
		
		return $res;
	}





}