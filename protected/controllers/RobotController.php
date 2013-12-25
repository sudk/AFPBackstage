<?php
/*
 * 模块编号: 微信接口模块
 */
class RobotController extends Controller
{
    public function actionIndex()
    {
        //valid signature , option
        if(Utils::checkSignature()){
            //echo $echoStr;
            $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
            //extract post data
            if (!empty($postStr)){
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                //$keyword = trim($postObj->Content);
                $MsgType=$postObj->MsgType;
                switch($MsgType){
                    case'text':$this->text($postObj);break;
                    case'event':$this->event($postObj);break;
                    case'image':$this->text($postObj);break;
                    case'voice':$this->text($postObj);break;
                    case'video':$this->text($postObj);break;
                    default:$this->text($postObj);break;
                }
            }else{
                echo "";
                exit;
            }
        }
    }

    public function text($postObj)
    {
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        //$keyword = trim($postObj->Content);
        $time = time();
        $tpl = WechatTpl::TextTpl();
        $msgType = "text";
        $contentStr = "您好微信后台机器人正在创建中!";
        $resultStr = sprintf($tpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
        echo $resultStr;
        exit;
    }

    public function location()
    {

    }

    public function voice()
    {

    }

    public function image()
    {

    }

    public function event($postObj)
    {

        $Event=$postObj->Event;

        switch($Event){
            case 'CLICK':$this->click_event($postObj);break;
            case 'subscribe':$this->subscribe_event($postObj);break;
            case 'unsubscribe':$this->unsubscribe_event($postObj);break;
        }

    }

    public function click_event($postObj){
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $EventKey=$postObj->EventKey;
        $row=TopTarget::GetOneTargetByType($EventKey);
        if($row){
            header("Content-Type:text/html; charset=utf-8");
            $time = time();
            $tpl = WechatTpl::OneNewsTpl();
            $resultStr = sprintf($tpl, $fromUsername, $toUsername, $time,$row['title'],$row['notice'],$row['picture'],$row['url']."&openid=".$fromUsername);
            echo $resultStr;
        }
    }

    public function subscribe_event($postObj){
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $u=new User();
        $data=$u->GetUserInfoFromWeChat($fromUsername);
        $u->SaveUserInfo($data);
        $time = time();
        $tpl = WechatTpl::TextTpl();
        $msgType = "text";
        $contentStr = "Hi，欢迎您关注小惠，既然来了就点点下面的菜单玩一下吧，或许你能发现点什么!";
        $resultStr = sprintf($tpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
        echo $resultStr;
        exit;
    }

    public function unsubscribe_event($postObj){
        $fromUsername = $postObj->FromUserName;
        User::UnsubUser($fromUsername);
        Yii::log("----------unsubscribe:".$fromUsername);
        exit;
    }

    public function actionMenu(){
        if($_POST['token']){
            $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$_POST['token'];
            $data=WechatTpl::Menu();
            $tuCurl = curl_init();
            curl_setopt($tuCurl, CURLOPT_URL,$url);
            curl_setopt($tuCurl, CURLOPT_HEADER,false);
            curl_setopt($tuCurl, CURLOPT_POST, 1);
            curl_setopt($tuCurl, CURLOPT_POSTFIELDS, $data);
            curl_exec($tuCurl);
            curl_close($tuCurl);
        }
        $this->renderPartial('menu');
    }


}