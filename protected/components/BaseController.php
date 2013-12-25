<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class BaseController extends CController
{
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout='//layouts/main';

    public $page_size=20;

    public $openid="";
    public $nickname="";
    public $binding_phone="";
    public $user_name="";
    public $is_band_card=false;
    public $points="0";
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs=array();

    public function init()
    {
        session_start();
        $session=Yii::app()->session;
        $session->open();
        if($_GET['openid']){
            $this->openid=$_GET['openid'];
            $session['openid']=$this->openid;
            $u=new User();
            $row=$u->GetUserInfo($this->openid);
            $session['nickname']=$row['nickname'];
            $session['binding_phone']=$row['binding_phone'];
            $session['user_name']=$row['user_name'];
            $session['is_band_card']=UsrBankCard::IsBandCard($this->openid);
            $session['points']=$row['points'];

            $this->nickname=$session['nickname'];
            $this->binding_phone=$session['binding_phone'];
            $this->user_name=$session['user_name'];
            $this->is_band_card=$session['is_band_card'];
            $this->points=$session['points'];
        }elseif(isset($session['openid'])){
            $this->openid=$session['openid'];
            $this->nickname=$session['nickname'];
            $this->binding_phone=$session['binding_phone'];
            $this->user_name=$session['user_name'];
            $this->is_band_card=$session['is_band_card'];
            $this->points=$session['points'];
        }
    }

    /**
     * Checks if rbac access is granted for the current vipcard
     * @param String $action . The current action
     * @return boolean true if access is granted else false
     */
    protected function beforeAction($action)
    {
        return true;
    }

}