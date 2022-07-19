<?php

class Users 
{
    public function getUsers()
    {
        $json = file_get_contents('users.json');
        $users = json_decode($json, true);
        $json_logs = file_get_contents('logs.json');
        $logs = json_decode($json_logs, true);
        $user_list = [];
        foreach($users as $user){
            $user_list[$user['id']]['users'] = $user;
            $user_list[$user['id']]['users']['logs']['total_conversion'] = 0; 
            $user_list[$user['id']]['users']['logs']['total_impression'] = 0; 
            foreach($logs as $log){
                if($user['id'] == $log['user_id']){
                    if($log['type'] == 'conversion'){
                        $user_list[$user['id']]['users']['logs']['total_conversion'] += $log['revenue']; 
                    }
                    if($log['type'] == 'impression'){
                        $user_list[$user['id']]['users']['logs']['total_impression'] += $log['revenue']; 
                    }
                    if(!isset($user_list[$user['id']]['users']['logs']['day_conversion'][date('Y-m-d', strtotime($log['time']))])){
                        $user_list[$user['id']]['users']['logs']['day_conversion'][date('Y-m-d', strtotime($log['time']))] = 0;
                    }
                    $user_list[$user['id']]['users']['logs']['day_conversion'][date('Y-m-d', strtotime($log['time']))] += $log['revenue']; 
                }
            }
        }
        
        $sort_by = (isset($_GET['sort_by']))?$_GET['sort_by']:'';
        switch ($sort_by) {
            case 'name_desc':
                array_multisort($user_list, SORT_DESC);
                break;
            case 'name_asc':
                array_multisort($user_list, SORT_ASC);
                break;
            case 'revenue_desc':
                array_multisort($user_list, SORT_NUMERIC);
                break;
            default:
                array_multisort($user_list, SORT_ASC);
        }                    
        require_once 'view.php';
    }
}

$new_users = new Users;
$users = $new_users->getUsers();
?>