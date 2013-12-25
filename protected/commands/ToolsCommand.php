<?php

/**
 * Description of Statsystem
 *
 * @author sudk
 */
class ToolsCommand extends CConsoleCommand
{
    /*获得刷卡记录*/
    public function actionGetUserInfo()
    {
        date_default_timezone_set('Asia/Shanghai');
        $u=new User();
        $data=$u->GetOpenList();
        if($data){
            $list=$data->data;
            $list=$list->openid;
            foreach($list as $openid){
                echo "\n start to get user info:".$openid;
                $u_info=$u->GetUserInfoFromWeChat($openid);
                if(!$u_info){
                    continue;
                }
                $rs=$u->SaveUserInfo($u_info);
                if($rs){
                    echo "\n save success openid:".$openid;
                }else{
                    echo "\n save false openid:".$openid;
                }
            }
        }
    }
}
