<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    '/' => 'index',
    'login' => 'index/login/index',
    'sign_up' => 'index/login/sign_up',
    'logout' => 'index/login/logout',

    'total_view' => 'index/main/total_view',  
    'test' => 'index/main/test',

    'admin_list' => 'index/adminmanage/admin_list',    
    'admin_edit/:uid'	=> ['index/adminmanage/admin_edit',['method' => 'get']],  
    'admin_save' => 'index/adminmanage/admin_info_save',    
    'add_admin' => 'index/adminmanage/admin_add',    
    'admin_new' => 'index/adminmanage/admin_add_save',    
    'admin_group' => 'index/adminmanage/admin_group',    
    'admin_group_add' => 'index/adminmanage/admin_group_add',    
    'admin_group_save' => 'index/adminmanage/admin_group_save',  
    'admin_group_add_save' => 'index/adminmanage/admin_group_add_save',  
    'admin_group_del/:gid' => ['index/adminmanage/admin_group_del',['method' => 'get']],   
    'admin_group_edit/:gid' => ['index/adminmanage/admin_group_edit',['method' => 'get']],    
    'offline_play_setting' => 'index/adminmanage/offline_play_setting',    
    'offline_play_setting_save' => 'index/adminmanage/offline_play_setting_save',    
    'admin_del/:id/:username' => ['index/adminmanage/admin_del',['method' => 'get']],    
    'system_setting' => 'index/adminmanage/system_value_list',    
    'system_setting_save' => 'index/adminmanage/system_value_save', 

    'find_user' => 'index/usermanage/get_one_user_info',    
    'user_list' => 'index/usermanage/user_list',    
    'curl_url' => 'index/usermanage/curl_url',    
    'userlist_down_excel' => 'index/usermanage/userlist_down_excel',    
    'agency_wx_tg_list' => 'index/usermanage/agency_wx_tg_list',    
    'master_point' => 'index/usermanage/master_point',    
    'check_user_info' => 'index/usermanage/check_user_info',    
    'master_point_handle' => 'index/usermanage/master_point_handle',    
        
    'recharge_list' => 'index/rechargemanage/recharge_list',   
    'recharge_query' => 'index/rechargemanage/recharge_query',   
    'sell_to_agency' => 'index/rechargemanage/sell_to_agency_list',   
    'sell_to_user' => 'index/rechargemanage/sell_to_user_list',   
    'rechargelist_down_excel' => 'index/rechargemanage/rechargelist_down_excel', 
    'sell_to_agency_list_down_excel' => 'index/rechargemanage/sell_to_agency_list_down_excel', 
    'sell_to_user_list_down_excel' => 'index/rechargemanage/sell_to_user_list_down_excel', 
    
    'dimond_log' => 'index/gamemanage/dimond_log', 
    'user_complain' => 'index/gamemanage/user_complain', 
    'dimond_used' => 'index/gamemanage/dimond_used', 
    'admin_action_log' => 'index/gamemanage/admin_action_log', 
    'offline_player_list' => 'index/gamemanage/offline_player_list', 
    
    'dimond_log_down_excel' => 'index/gamemanage/dimond_log_down_excel',
    'user_complain_down_excel' => 'index/gamemanage/user_complain_down_excel',
    'dimond_used_down_excel' => 'index/gamemanage/dimond_used_down_excel',
    'admin_action_log_down_excel' => 'index/gamemanage/admin_action_log_down_excel',
    'offline_player_list_down_excel' => 'index/gamemanage/offline_player_list_down_excel',
    
    'agency_add' => 'index/agencymanage/agency_add', 
    'agency_list' => 'index/agencymanage/agency_list', 
    'agency_edit/:uid' => ['index/agencymanage/agency_edit',['method' => 'get']],  
    'agency_bank_info_edit/:uid' => ['index/agencymanage/agency_bank_info_edit',['method' => 'get']],  
    'agency_save' => 'index/agencymanage/agency_info_save', 
    'agency_bank_info_save' => 'index/agencymanage/agency_bank_info_save', 
    'agency_index_note' => 'index/agencymanage/agency_index_note', 
    'agency_bank_info_list' => 'index/agencymanage/agency_bank_info_list', 
    'agency_get_dimond_back_log' => 'index/agencymanage/agency_get_dimond_back_log', 
    'agency_get_money_back_log' => 'index/agencymanage/agency_get_money_back_log', 
    'give_money' => 'index/agencymanage/handle_give_money', 
    'give_dimond' => 'index/agencymanage/handle_give_dimond', 
    'agency_del/:id/:uid' => ['index/agencymanage/agency_del',['method' => 'get']],    
    'agency_list_down_excel' => 'index/agencymanage/agency_list_down_excel',

    'agency_login' => 'agency/login/index',




];
