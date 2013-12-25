<div class="list-group" style="margin-bottom:5px;">
    <?php if($rs['total_num']>0):?>
    <?php foreach($rs['rows'] as $row):?>
        <a class="list-group-item list-group-item-sm row" href="./?r=voucher/voucher/detail&batch_id=<?=$row['batch_id']?>&issue_id=<?=$row['issue_id']?>">
            <div class="col-xs-4" style="margin:0px;padding:5px 0px 5px 0px;">
                <img width="99%" style="max-height:200px;" src="<?=Yii::app()->params['assets_path']."/".$row['pic_path']?>" alt="..." class="img-rounded pull-left">
            </div>
            <div class="col-xs-8">
                <h5><?=$row['title']?></h5>
                <p class="text-muted"><small>面值：<?=$row['amount']/100?></small></p>
                <p class="text-muted" style="font-size:12px;"><small>有效期：从<?=$row['effective_date']?>到<?=$row['expiry_date']?></small></p>
            </div>
        </a>
    <?php endforeach;?>
    <?php $this->widget('AjaxLinkPager', array('id' => 'list','page_num' =>$rs['page_num'],'total_num' =>$rs['total_num'],'num_of_page'=>$rs['num_of_page'],'condition'=>$rs['condition'],'order'=>$rs['order'],'url'=>$rs['url'])); ?>
    <?php else:?>
        <a class="list-group-item list-group-item-sm row">
            <h3 class="text-center">矮柚，啥都木有！</h3>
        </a>
    <?php endif;?>
</div>