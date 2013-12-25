<?php
/*
 * 模块编号: M1001
 */
class SampleController extends BaseController
{

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $this->render('index');
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionMchtDetail() {
        $this->layout='//layouts/second';
        $this->render('mcht_detail');
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionImageslist() {
        $this->render('images_list');
    }


    public function actionForm(){
        $this->render('form');
    }

}