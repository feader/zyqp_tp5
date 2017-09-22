<?php
namespace app\index\model;
use \think\Model;
use \think\Db;
use \think\Session;

class Agencymanage extends Tool{

	protected $db_config;

	public function __construct(){

		$db_config = Session::get('db_config','db_config');

		$this->db_config = $db_config;
	}
	
	/*
	*获取所有代理的信息
	*/ 
	public function get_all_agency_info($where,$page){

		if(empty($where)){
			
			$res = Db::connect($this->db_config)->name('agency')->order(['register_time'=>'desc'])->paginate($page);
		
		}else{

			$res = Db::connect($this->db_config)->name('agency')->where($where)->order(['register_time'=>'desc'])->paginate($page);

		}
				
		return $res;
	}


	/*
	*获取某个代理的数据
	*@ $where 查询条件
	*/ 
	public function get_one_agency_info($where){
		
		$res = Db::connect($this->db_config)->name('agency')->where($where)->find();
		
		return $res;
	
	}

	/*
	*更新某个用户的数据
	*@$data 用户数据
	*@$where 更新依据
	*/ 
	public function handle_agency_info_update($data,$where){
		
		$res = array();
		
		$table = 'agency';
		
		$field = 'uid,password';
		
		$check = self::check_info_exists($table,$field,$where);
		
		if($check){

			if(isset($data['password'])){
				
				if($check['password']==$data['password']){
		
					$res['code'] = 0;
					
					$res['msg'] = '密码一样！';
					
					return $res;
			
				}

			}
					
			$update_res = self::update_handle($table,$where,$data);

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
	*删除某个代理用户的数据
	*@$id id
	*@$uid 用户uid
	*/ 
	public static function del_agency($id,$uid){
		
		$where = array();
		
		$where['id'] = $id;
		
		$where['uid'] = $uid;

		$table = 'agency';
		
		$field = 'uid,id';
		
		$check = self::check_info_exists($table,$field,$where);
		
		if($check){
		
			if($check['id']!=$id || $check['uid']!=$uid){
		
				$res['code'] = 0;
				
				$res['msg'] = '非法操作！';
				
				return $res;
		
			}

			$del_res = Db::connect($this->db_config)->name('agency')->where($where)->delete();

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
	*获取所有代理的信息
	*/ 
	public function get_all_agency_bank_info($where,$page){

		if(empty($where)){
			
			$res = Db::connect($this->db_config)->name('agency_bank_info')->paginate($page);
		
		}else{

			$res = Db::connect($this->db_config)->name('agency_bank_info')->where($where)->paginate($page);

		}
				
		return $res;
	}

	/*
	*获取某个代理银行资料的数据
	*@ $where 查询条件
	*/ 
	public function get_one_agency_bank_info($where){
		
		$res = Db::connect($this->db_config)->name('agency_bank_info')->where($where)->find();
		
		return $res;
	
	}

	/*
	*更新某个代理银行资料的数据
	*@$data 用户数据
	*@$where 更新依据
	*/ 
	public function handle_agency_bank_info_update($data,$where){
		
		$res = array();
		
		$table = 'agency_bank_info';
		
		$field = 'uid,id';
		
		$check = self::check_info_exists($table,$field,$where);
		
		if($check){
														
			$update_res = self::update_handle($table,$where,$data);

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
	*获取代理首页公告
	*/ 
	public function get_index_note_info($table,$field,$where,$db_config){
			
		$res = self::check_info_exists($table,$field,$where,$db_config);
		
		return $res;
	
	}

	/*
	*更新某个代理银行资料的数据
	*@$data 用户数据
	*@$where 更新依据
	*/ 
	public function handle_agency_index_note_info_update($data,$where){
		
		$res = array();
		
		$table = 'system_setting';
		
		$field = 'id';
		
		$check = self::check_info_exists($table,$field,$where);
		
		if($check){

			if($check['id']!=$where['id']){
				
				$res['code'] = 0;
				
				$res['msg'] = '信息错误！';
				
				return $res;
			
			}
														
			$update_res = self::update_handle($table,$where,$data);

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
	*获取所有代理返卡的信息
	*/ 
	public function get_all_agency_get_dimond_back_log_info($where,$page){

		if(empty($where)){
			
			$res = Db::connect($this->db_config)->name('agency_get_dimond_back_log')->order(['create_time'=>'desc'])->paginate($page);
		
		}else{

			$res = Db::connect($this->db_config)->name('agency_get_dimond_back_log')->where($where)->order(['create_time'=>'desc'])->paginate($page);

		}
				
		return $res;
	}

	/*
	*获取所有代理返卡的信息
	*/ 
	public function get_all_agency_money_back_log_info($where,$page){

		if(empty($where)){
			
			$res = Db::connect($this->db_config)->name('money_back_log')->order(['handle_time'=>'desc'])->paginate($page);
		
		}else{

			$res = Db::connect($this->db_config)->name('money_back_log')->where($where)->order(['handle_time'=>'desc'])->paginate($page);

		}
				
		return $res;
	}

	/*
	*获取所有代理返卡的信息
	*/ 
	public function get_all_agency_every_month_money_back_info($where,$page){

		if(empty($where)){
			
			$res = Db::connect($this->db_config)->name('every_month_money_back')->order(['back_create_time'=>'desc'])->paginate($page);
		
		}else{

			$res = Db::connect($this->db_config)->name('every_month_money_back')->where($where)->order(['back_create_time'=>'desc'])->paginate($page);

		}
				
		return $res;
	}


	/*
	*获取系统参数
	*/ 
	public function get_system_setting_info($table,$field,$where){
			
		$res = self::check_info_exists($table,$field,$where);
		
		return $res['setting_value'];
	
	}

	
	/*
	*更新某个代理返现的数据
	*@$data 用户数据
	*@$where 更新依据
	*/ 
	public function handle_agency_give_money_update($data,$where){
		
		$res = array();
		
		$table = 'every_month_money_back';
		
		$field = 'id,status';
		
		$check = self::check_info_exists($table,$field,$where);
		
		if($check){

			if($check['id']!=$where['id']){
				
				$res['code'] = 0;
				
				$res['msg'] = '信息错误！';
				
				return $res;
			
			}

			if($check['status']!=0){
				
				$res['code'] = 0;
				
				$res['msg'] = '状态错误！';
				
				return $res;
			
			}
														
			$update_res = self::update_handle($table,$where,$data);

			if($update_res){

				$res['code'] = 1;
				
				$res['msg'] = '发放成功！';
			
			}else{

				$res['code'] = 0;
				
				$res['msg'] = '发放失败！';

			}
			
		}else{
			
			$res['code'] = 0;
				
			$res['msg'] = '非法信息！';

		}
		
		return $res;
		
	}

	/*
	*更新某个代理返卡的数据
	*@$data 用户数据
	*@$where 更新依据
	*/ 
	public function handle_agency_give_dimond_update($data,$where){
		
		$res = array();
		
		$table = 'money_back_log';
		
		$field = 'id,status,auid,get_money';
		
		$check = self::check_info_exists($table,$field,$where);
		
		if($check){

			if($check['id']!=$where['id']){
				
				$res['code'] = 0;
				
				$res['msg'] = '信息错误！';
				
				return $res;
			
			}

			if($check['status']!=0){
				
				$res['code'] = 0;
				
				$res['msg'] = '状态错误！';
				
				return $res;
			
			}
														
			$update_res = self::update_handle($table,$where,$data);

			if($update_res){

				$res['code'] = 1;
				
				$res['msg'] = '发放成功！';

				$check1 = self::check_info_exists('agency','uid,recharge_dimond',"uid = '$check[auid]'");

				$where1 = array();
				
				$data1 = array();
				
				$where1['uid'] = $check['auid'];

				$data1['recharge_dimond'] = $check['get_money']+$check1['recharge_dimond'];

				$update_res1 = self::update_handle('agency',$where1,$data1);
				
			}else{

				$res['code'] = 0;
				
				$res['msg'] = '发放失败！';

			}
			
		}else{
			
			$res['code'] = 0;
				
			$res['msg'] = '非法信息！';

		}
		
		return $res;
		
	}

	/*
	*新增代理
	*@$data 用户数据
	*@$where 更新依据
	*/ 
	public function handle_agency_add($data,$where){
		
		$res = array();
		
		$table = 'agency';
		
		$field = 'uid';
		
		$check = self::check_info_exists($table,$field,$where);
		
		if($check){
		
			if($check['uid']==$data['uid']){
		
				$res['code'] = 0;
				
				$res['msg'] = '代理已存在！';
				
				return $res;
		
			}
						
		}else{
			
			//$insert_res = self::insert_handle($table,$data);
			
			$insert_res = self::insert_DbIns($table,$data);

			if($insert_res){

				$res['code'] = 1;
				
				$res['msg'] = '新增成功！';

				$res['uid'] = $data['uid'];

				$res['password'] = $data['password'];
			
			}else{

				$res['code'] = 0;
				
				$res['msg'] = '新增失败！';

			}

		}
		
		return $res;
		
	}






}