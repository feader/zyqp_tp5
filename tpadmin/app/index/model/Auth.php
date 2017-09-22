<?php
namespace app\index\model;
use \think\Model;
use \think\Db;
use \think\Session;

class Auth extends Model{

	/*
	*根据用户gid获取用户的权限
	*$gid用户的用户组（权限等级）
	*/ 
	public function get_menus_auth($gid){

		$db_config = Session::get('db_config','db_config');
		
		$res = Db::name("group")->field('power')->where("gid=$gid")->find();
		
		return $res['power'];
	
	}
}