<?php
namespace app\index\model;
use \think\Model;
use \think\Db;
use \think\Session;

class Tool extends Model{

	//protected $db_config;

	public function __construct(){

		// $db_config = Session::get('db_config','db_config');

		// $this->db_config = $db_config;
	}

	/*
	*通用的查询方法
	*/ 
	protected static function check_info_exists($table,$field,$where,$db_config){

		$check = Db::connect($db_config)->name($table)->field($field)->where($where)->find();

		return $check;
	
	}

	/*
	*通用的更新方法
	*/ 
	protected static function update_handle($table,$where,$data,$db_config){

		$update_res = Db::connect($db_config)->name($table)->where($where)->update($data);

		return $update_res;
	
	}

	/*
	*通用的插入方法
	*/ 
	protected static function insert_handle($table,$data,$db_config){

		$insert_res = Db::connect($db_config)->name($table)->insertGetId($data);	

		return $insert_res;
	
	}

	/*
	*修正insert 方法对唯一索引不返回值直接报错的问题
	*/ 
	protected static function insert_DbIns($Table,$Data = array(),$db_config) {
        if($Table==""||$Table===null){
            return 0;
        }else{
            $AddDb=db($Table)
              ->fetchSql(true)
              ->insertGetId($Data);
            $Result=Db::connect($db_config)->execute(str_replace("INSERT","INSERT IGNORE",$AddDb));
            return $Result;
        }
    }

    /*
	*公用接口的curl方法
	*/
    protected static function common_curl($web_server,$part,$uid,$port){
		$url = $web_server.':'.$port.'/'.$part."?user_id=$uid";	
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

	/*
	*大师分控制接口的curl方法
	*/
	protected static function master_point_curl($web_server,$part,$data,$port){
		$uid = $data['uid'];
		$num = $data['add_point'];
		$url = $web_server.':'.$port.'/'.$part."?user_id=$uid&add_num=$num";
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