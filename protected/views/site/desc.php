<form action="index.php?r=site/desctable" method="POST">
    table_name:<input type="text" name="table_name"/>
    <input type="submit" value="submit">
</form>
<div>
    <?php if($rs){
        foreach($rs as $field){
            echo ",".$field['Field'];
        }
    }?>
</div>