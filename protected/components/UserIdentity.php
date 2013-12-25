<?php

/**
 * UserIdentity represents the data needed to identity a vipcard.
 * It contains the authentication method that checks if the provided
 * data can identity the vipcard.
 */
class UserIdentity extends CUserIdentity
{
    public $usertype;

    const ERROR_SCHOOL_INVALID = 9001;

    /**
     * Authenticates a vipcard.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent vipcard identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        return $this->auth_system();
    }

    public function auth_system()
    {
        $operator = Staff::model()->find('staffid=:staffid ', array(':staffid' => $this->username));
        //var_dump($operator);

        if ($operator == null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            return false;
        }
        if ($operator->status != Staff::STATUS_NORMAL) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            return false;
        }
        if (crypt($this->password,$operator->password) != $operator->password) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
            return false;
        }
        $this->username=$operator->staffid;
        Yii::app()->user->setState('id', $operator->staffid);
        Yii::app()->user->setState('name', $operator->staffname);

        $this->errorCode = self::ERROR_NONE;

        return !$this->errorCode;
    }
}