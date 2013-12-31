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


}