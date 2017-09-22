<?php
namespace app\index\model;
use \think\Model;
use \think\Db;
use \think\Session;

class Base extends Model{

	/*
	*获取所有左侧菜单栏的数据
	*/ 
	public function get_nav(){
		
		$nav = $this->left_menus_data();
		
		return $nav;
	
	}
	
	/*
	*获取用户的数据
	*/ 
	public function get_admin_info($where){
		
		$db_config = Session::get('db_config','db_config');

		$res = Db::connect($db_config)->name('admin_user')->where($where)->find();
		
		return $res;
	
	}

	/*
	*所有左侧菜单栏的数据
	*/ 
	private function left_menus_data(){
		
		$nav = array();
		
		$nav['数据总览']['total_view'] = '数据总览,1';
		$nav['数据总览']['data_count'] = '数据统计,2';
		$nav['数据总览']['room_log'] = '房间记录,3';
		// $nav['数据总览']['1235241242134'] = '数据总览1,2';
		// $nav['测试2']['test'] = '测试,3';

		$nav['游戏管理']['dimond_log'] = '消耗钻石,11';
		$nav['游戏管理']['user_complain'] = '用户反馈,12';
		$nav['游戏管理']['dimond_used'] = '钻石明细,13';
		$nav['游戏管理']['admin_action_log'] = '日志管理,14';
		$nav['游戏管理']['offline_player_list'] = '线下赛,15';
		$nav['游戏管理']['game_notice'] = '游戏公告,16';

		$nav['用户管理']['find_user'] = '用户查询,21';
		$nav['用户管理']['user_list'] = '用户列表,22';
		$nav['用户管理']['agency_wx_tg_list'] = '推广用户列表,23';
		$nav['用户管理']['master_point'] = '大师分控制,24';

		$nav['充值管理']['recharge_list'] = '充值管理,31';
		$nav['充值管理']['recharge_query'] = '流水查询,32';
		$nav['充值管理']['sell_to_agency'] = '出售房卡(代理),33';
		$nav['充值管理']['sell_to_user'] = '出售房卡(玩家),34';

		$nav['代理系统']['agency_add'] = '代理生成,41';
		$nav['代理系统']['agency_list'] = '代理管理,42';
		$nav['代理系统']['agency_bank_info_list'] = '代理银行资料,43';
		$nav['代理系统']['agency_index_note'] = '代理首页公告,44';
		$nav['代理系统']['agency_get_dimond_back_log'] = '代理返卡记录,45';
		$nav['代理系统']['agency_get_money_back_log'] = '代理返现记录,46';

		$nav['管理员管理']['admin_list'] = '后台管理员,51';
		$nav['管理员管理']['admin_group'] = '组群管理,52';
		$nav['管理员管理']['system_setting'] = '参数设置,53';
		$nav['管理员管理']['offline_play_setting'] = '线下赛设置,54';
		
		return $nav;
	
	}

	/*
	*获取用户的用户组（用于权限控制）
	*/ 
	public function get_admin_group_info($gid){

		$db_config = Session::get('db_config','db_config');
		
		$res = Db::connect($db_config)->name('group')->find($gid);
		
		return $res['power'];
	
	}
	
}