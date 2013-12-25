<?php

/**
 *
 * @author sudk
 */
class VoucherController extends BaseController
{

    public $defaultAction = 'list';

    /**
     * 查询
     */
    public function actionGrid()
    {
        $page = $_GET['page'] == '' ? 0 : $_GET['page']; //当前页码
        $_GET['page']=$_GET['page']+1;
        $args = $_GET['q']; //查询条件
        if ($_REQUEST['q_value'])
        {
            $args[$_REQUEST['q_by']] = $_REQUEST['q_value'];
        }
        $args['open_id']=$this->openid;
        $rs = Voucher::queryList($page, $this->page_size, $args);

        $this->renderPartial('_list', array('rs' => $rs));
    }

    /**
     * 列表
     */
    public function actionList()
    {
        $this->render('list');
    }

    /**
     * 列表
     */
    public function actionDetail()
    {
        $this->layout='//layouts/second';
        $batch_id=$_GET['batch_id'];
        $issue_id=$_GET['issue_id'];
        $condition=" voucher.batch_id='{$batch_id}' and voucher.issue_id='{$issue_id}' ";

        $model=Yii::app()->db->createCommand()
            ->select("voucher.issue_id,batch_voucher.*")
            ->from("voucher")
            ->leftJoin('batch_voucher','batch_voucher.batch_id=voucher.batch_id')
            ->where($condition)
            ->queryRow();

        $this->render('detail',array('model'=>$model));

    }

}