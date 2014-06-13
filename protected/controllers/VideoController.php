<?php
/*
 * 模块编号: M1001
 */
class VideoController extends BaseController
{

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
    	$this->layout='//layouts/none';
        $this->render('mobile');
    }
    public function actionV16_9() {
    	$this->layout='//layouts/none';
        $this->render('V16_9');
    }


}