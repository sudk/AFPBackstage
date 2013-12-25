<div style="margin:0px;padding:0px;" id="top_btn">
    <?php $this->renderPartial('_toolbox');?>
</div>
<div id="list">
    <?php $this->actionGrid();?>
</div>
<script>
    var q=function(val){
        var url="./?r=voucher/voucher/list&q[search]="+val;
        window.location.href=url;
    }
</script>