<?php

/**
 * @author sudk sudunkuai@gmail.com
 * 88265582
 */
class PacificController extends BaseController
{

    public $defaultAction = 'list';

    /**
     * 查询
     */
    public function actionGrid()
    {
        $this->renderPartial('_listhtml');
    }

    /**
     * 列表
     */
    public function actionList()
    {
        $this->render('list');
    }

    /**
     * 详情
     */
    public function actionDetail()
    {
        $this->render('detailhtml');
    }

}