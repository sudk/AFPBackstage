<?php

Yii::import('application.controllers.site.*');

class SiteController extends BaseController {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'users' => array('*'),
            ),
        );
    }



    /**
     * 列表
     */
    public function actionList() {
        $this->render('list');
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->renderPartial('error', $error);
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {

    }

    /**
     * Logs out the current vipcard and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionWorldcup(){

        $service=$_GET['service'];
        $error_code=0;
        $url=Yii::app()->params['wc_service_rul'];
        $client_id=Yii::app()->params['client_id'];
        //$user_name=Yii::app()->params['user_name'];
        //$password=Yii::app()->params['password'];
        //$b64_str=base64_encode($user_name.":".$password);
        $b64_str=Yii::app()->params['u_p_b64'];
        $data="clientId=".$client_id;
        unset($_GET['clientId']);
        unset($_GET['r']);
        unset($_GET['service']);
        if(count($_GET)){
            foreach($_GET as $k=>$v){
                $data.="&".$k."=".$v;
            }
        }
        header("Content-Type:text/xml");
        $url.=$service;

        //检查缓存是否存在
        $cache_key=md5($url.$data);
        $tuData=Yii::app()->cache->get($cache_key);
        if($tuData){echo $tuData;exit;}

        $tuCurl = curl_init();
        curl_setopt($tuCurl, CURLOPT_URL,$url);
        curl_setopt($tuCurl, CURLOPT_VERBOSE, 0);
        curl_setopt($tuCurl, CURLOPT_HEADER,false);
        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($tuCurl, CURLOPT_POST,true);
        curl_setopt($tuCurl, CURLOPT_POSTFIELDS,$data);
        curl_setopt($tuCurl, CURLOPT_TIMEOUT,20);
        curl_setopt($tuCurl, CURLOPT_HTTPHEADER, array("Authorization:Basic ".$b64_str));
        try{
            $tuData = curl_exec($tuCurl);
            if(!curl_errno($tuCurl)){
                $info = curl_getinfo($tuCurl);
                if($info['http_code']!=200){
                    $desc="Remote server HTTP error http_code:".$info['http_code'];
                    $error_code=1002;
                }
            } else {
                $desc="Remote server HTTP link error,desc:".curl_error($tuCurl);
                $error_code=1004;
            }
        }catch (Exception $e){
            $desc="Remote server HTTP link error";
            $error_code=1005;
        }
        curl_close($tuCurl);


        if($error_code>0){
            $error_xml=<<<EOF
<CadabilityServices>
<Error>
<ID>Err{$error_code}</ID>
<Name>{$desc}</Name>
<Message>
{$tuData}
</Message>
</Error>
</CadabilityServices>
EOF;

            echo $error_xml;
        }else{
            //缓存时间
            $xml_cache_time=Yii::app()->params['xml_cache_time'];
            //设置缓存
            Yii::app()->cache->set($cache_key,$tuData,$xml_cache_time);

            echo $tuData;
        }

    }

}
