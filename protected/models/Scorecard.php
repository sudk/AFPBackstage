<?php
/**
 * @author #sudk
 * @copyright Copyright &copy; 2003-2009 TrunkBow Co., Inc
 */
class Scorecard {


    public function getScorecard(){

        $error_code=0;
        $url=Yii::app()->params['wc_service_rul'];
        $client_id=Yii::app()->params['client_id'];
        $b64_str=Yii::app()->params['u_p_b64'];
        $data="clientId=".$client_id;
        $data.="&seriesId=339&roundId=1&matchId=1&localeId=en";
        $url.="GetMainScorecard2";

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
            return ;
        }else{
            $rs=false;
            $l=strlen("<LastUpdate>");
            $s=strpos($tuData,"<LastUpdate>");
            $e=strpos($tuData,"</LastUpdate>");
            $update_time=substr($tuData,$s+$l,$e-$s-$l);
            //设置缓存
            $old=Yii::app()->cache->get("GetMainScorecard2");
            if (true) {
                Yii::app()->cache->set("GetMainScorecard2",$update_time);
                $rs="Scorecard update at ".$update_time;
            }else if($old!=$update_time){
                $rs="Scorecard update at ".$update_time;
            }
            echo $rs;
            echo "----------";
            if($rs){
                $this->sendMsg($rs);
            }
        }

    }

    private function sendMsg($msg){

        $url="http://api.jpush.cn:8800/v2/push";
        $sendno=time();
        $app_key="53fb3ef890201442ad9ce3b1";
        //$app_key="162d20450baad1c43ae3bf54";
        $receiver_type="4";
        $receiver_value="";
        $master_secret="720f8843805985a729949ecd";
        //$master_secret="ac7d8a2c59876888444c8a40";
        $verification_code=md5($sendno.$receiver_type.$receiver_value.$master_secret);
        $msg_type=1;
        $msg_content=urlencode("{\"n_content\":\"$msg\"}");
        $platform="android,ios";

        $data="sendno=".$sendno;
        $data.="&app_key=".$app_key;
        $data.="&receiver_type=".$receiver_type;
        $data.="&receiver_value=".$receiver_value;
        $data.="&verification_code=".$verification_code;
        $data.="&msg_type=".$msg_type;
        $data.="&msg_content=".$msg_content;
        $data.="&platform=".$platform;

        $tuCurl = curl_init();
        curl_setopt($tuCurl, CURLOPT_URL,$url);
        curl_setopt($tuCurl, CURLOPT_VERBOSE, 0);
        curl_setopt($tuCurl, CURLOPT_HEADER,false);
        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($tuCurl, CURLOPT_POST,true);
        curl_setopt($tuCurl, CURLOPT_POSTFIELDS,$data);
        curl_setopt($tuCurl, CURLOPT_TIMEOUT,60);

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

        echo $tuData;

    }

}


    