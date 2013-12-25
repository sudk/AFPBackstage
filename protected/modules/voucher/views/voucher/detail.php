<div class="row well well-sm" style="padding-top:0px;margin-bottom:0px;">
    <h3 class="text-center"><?=$model['title']?></h3>
    <div class="col-xs-12">
        <img width="100%" style="max-height:600px;" src="<?=Yii::app()->params['assets_path']."/".$model['pic_path']?>" alt="..." class="img-rounded pull-left">
    </div>
</div>
<div id="list">
    <div class="list-group">
        <a class="list-group-item row">
            <div class="col-xs-2" style="margin:0px;padding:0px;">
                券号
            </div>
            <div class="col-xs-10">
                <span style="font-size:15px;" class="text-info"><?=$model['issue_id'];?></span>
            </div>
        </a>
        <a class="list-group-item row">
            <div class="col-xs-2" style="margin:0px;padding:0px;">
                面值
            </div>
            <div class="col-xs-10">
                <span style="font-size:15px;" class="text-info"><?=$model['amount'];?></span>
            </div>
        </a>
        <a class="list-group-item row">
            <div class="col-xs-2" style="margin:0px;padding:0px;">
                内容
            </div>
            <div class="col-xs-10">
                <span style="font-size:14px;" class="text-info"><?=$model['simple_notice'];?></span>
            </div>
        </a>
        <a class="list-group-item row">
            <div class="col-xs-2" style="margin:0px;padding:0px;">
                细则
            </div>
            <div class="col-xs-10">
                <span style="font-size:12px;" class="text-info"><?=$model['detail_notice'];?></span>
            </div>
        </a>
        <a class="list-group-item row">
            <div class="col-xs-2" style="margin:0px;padding:0px;">
                <span style="font-size:20px;" class="glyphicon glyphicon-calendar"></span>
            </div>
            <div class="col-xs-10">
                <span style="font-size:12px;" class="text-info">有效期：<?=$model['effective_date'].'到'.$model['expiry_date'];?></span>
            </div>
        </a>
    </div>
</div>