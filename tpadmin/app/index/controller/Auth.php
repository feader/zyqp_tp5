<?php
namespace app\index\controller;
use \think\Controller;

class Auth extends Basecommon{

	/*
	*获取左侧菜单栏
	*/ 
	public function left_nav(){
		$base = model('Base');
		$nav = $base->get_nav();
		return $nav;
	}

	/*
	*根据用户所在的用户组id来筛选用户可操作的左侧菜单
	*@$gid 用户gid
	*@$view tp的模板赋值变量
	*/ 
	protected function handle_power($gid,$view){
  
    	$auth = model('Auth');

        $power_res = $auth->get_menus_auth($gid);

        $menu = $this->left_nav();

        $power = explode(',',$power_res);

        $left_menus = array();

       //  foreach ($menu as $k => $v) {
       //  	foreach ($power as $k1 => $v1) {
       //  		$res1 = array_key_exists($v1,$v);
    			// if($res1){
       //  			$left_menus[$k][$v1] = $menu[$k][$v1];
    			// }
       //  	}
       //  }

        foreach ($menu as $k => $v) {
            
            foreach ($v as $k1 => $v1) {
                
                $part = explode(',',$v1);

                $res = in_array($part[1],$power);

                if($res){

                    $left_menus[$k][$k1] = $part[0];
               
                }
                
            }
            
        }

        $view->left_menus = $left_menus;

    }

    /**
    * tp5 使用excel导出
    * @param
    * @author staitc7  * @return mixed
    */
    protected function excel($name,$header,$data,$setWidth){
       
        excelExport($name,$header,$data,$setWidth);
    
    }

}