<?php

/**
 * Description of Statsystem
 *
 * @author sudk
 */
class ToolsCommand extends CConsoleCommand
{
    /*获得积分榜*/
    public function actionScorecard()
    {
        date_default_timezone_set('Asia/Shanghai');

        $model=new Scorecard();
        $model->getScorecard();
    }
}
