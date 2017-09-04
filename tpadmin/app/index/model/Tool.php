<?php
namespace app\index\model;
use \think\Model;
use \think\Db;

class Tool extends Model{

	/*
	*通用的查询方法
	*/ 
	protected static function check_info_exists($table,$field,$where){

		$check = Db::name($table)->field($field)->where($where)->find();

		return $check;
	
	}

	/*
	*通用的更新方法
	*/ 
	protected static function update_handle($table,$where,$data){

		$update_res = Db::name($table)->where($where)->update($data);

		return $update_res;
	
	}

	/*
	*通用的插入方法
	*/ 
	protected static function insert_handle($table,$data){

		$insert_res = Db::name($table)->insertGetId($data);	

		return $insert_res;
	
	}

	/*
	*修正insert 方法对唯一索引不返回值直接报错的问题
	*/ 
	protected static function insert_DbIns($Table,$Data = array()) {
        if($Table==""||$Table===null){
            return 0;
        }else{
            $AddDb=db($Table)
              ->fetchSql(true)
              ->insertGetId($Data);
            $Result=Db::execute(str_replace("INSERT","INSERT IGNORE",$AddDb));
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