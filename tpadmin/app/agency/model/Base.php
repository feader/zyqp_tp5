<?php
namespace app\agency\model;
use \think\Model;
use \think\Db;
use \think\Session;

class Base extends Model{

	public function get_one_agency_info($where,$db_config){

		$res = Db::connect($db_config)->name('agency')->where($where)->find();

		return $res;

	}

	/*
	*获取所有左侧菜单栏的数据
	*/ 
	public function get_nav(){
		
		$nav = $this->left_menus_data();
		
		return $nav;
	
	}

	/*
	*所有左侧菜单栏的数据
	*/ 
	private function left_menus_data(){
		
		$nav = array();
		
		$nav['运营代理']['agency_main'] = '首页,1';
		$nav['运营代理']['agency_sell'] = '出售(玩家),2';
		$nav['运营代理']['agency_sell_to_agency'] = '出售(代理),3';
		$nav['运营代理']['agency_recharge'] = '充值,4';
		$nav['运营代理']['agency_recharge_log'] = '充值记录,5';
		$nav['运营代理']['agency_sell_log'] = '出售记录(玩家),6';
		$nav['运营代理']['agency_sell_to_agency_log'] = '出售记录(代理),7';
		$nav['运营代理']['agency_leaguer_list'] = '下级代理,8';
		$nav['运营代理']['agency_get_wx_user'] = '推广用户,9';
		$nav['运营代理']['agency_view_invite_user'] = '用户消耗,10';
		$nav['运营代理']['agency_get_diamond_back'] = '我的返卡,11';
		$nav['运营代理']['agency_get_money_back'] = '我的返现,12';
		$nav['运营代理']['agency_back_info'] = '银行资料,13';
		$nav['运营代理']['agency_setting'] = '设置,14';
			
		return $nav;
	
	}

	/*
	*获取用户的用户组（用于权限控制）
	*/ 
	public function get_agency_group_info($gid){

		$db_config = Session::get('db_config','db_config');
		
		$res = Db::connect($db_config)->name('group')->find($gid);
		
		return $res['power'];
	
	}

}	