<?php
namespace app\index\controller;
use \think\Controller;
use \think\Session;
use \think\Db;
use \think\Request;
use \think\Paginator;
use \think\File;
// use app\index\model\Gamemanage as gmanage;

class Complain extends Controller{

	/*
	*反馈数据提交页面
	*/ 
	public function user_complain_input(){
		
		$view = $this->view;
       
        $view->header_title = '用户反馈';

        $param = input('param.');
        
        $view->uid = $param['uid'];
        
        $view->db_id = $param['db_id'];

        // 模板输出
	    return $this->fetch();

	}

	/*
	*图片上传处理
	*/ 
	public function user_complain_file(){

		$file = request()->file('img_list');

		$data = array();

		if($file){

			$upload_path = ROOT_PATH.'public'.DS.'static'.DS.'upload'.DS.'complain';
        	
        	$info = $file->move($upload_path);
        	        
	        if($info){
	            // 成功上传后 获取上传信息
	            // 输出 jpg
	            // echo $info->getExtension();echo '<br/>';
	            // // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
	            // echo $info->getSaveName();echo '<br/>';
	            // // 输出 42a79759f284b767dfcb2a0197904287.jpg
	            // echo $info->getFilename();echo '<br/>';

	        	$data['upload_img'] = '/upload/complain/'.$info->getSaveName();

		    	$data['msg'] = '上传图片成功！';
			
				$data['code'] = 3;


	        }else{
	            // 上传失败获取错误信息
	            //echo $file->getError();echo '<br/>';

	            $data['upload_img'] = 0;

		    	$data['msg'] = $file->getError();
			
				$data['code'] = 4;

	        }

    	}else{

    		$data['upload_img'] = 0;

	    	$data['msg'] = $file->getError();
		
			$data['code'] = 5;
    	}

		echo json_encode($data);die;
	}

	/*
	*
	*/ 
	public function user_complain_save(){

		$post = input('post.');

        if(!empty($post)){

        	$data = array();
   	
        	$data['uid'] = $post['uid'];
        	        	
        	$data['content'] = $post['content'];
        	
        	$data['upload_img'] = $post['upload_img'];
        	
        	$data['create_time'] = time();

        	$db_num = $post['db_id'];

        	$db_config = \think\Config::get('db'.$db_num);

        	$insert_res = Db::connect($db_config)->name('user_complain')->insertGetId($data);

        	if($insert_res){

        		$uid = $post['uid'];
       		
        		$this->success('反馈成功！',"/user_complain_input/$uid/$db_num.html");
        	
        	}else{
        		
        		$this->success('反馈失败！',"/user_complain_input/$uid/$db_num.html");
        	
        	}
       	
        }

	}




}