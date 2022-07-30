<?php
$do = $_GET['do']??'title';
include('../api/base.php');
?>
<h3 class="cent"><?=$STR->addHeader?></h3>
<hr>
<form action="../api/add.php" method="post">
    <table class="m-auto cent">
        <tr>
            <td>
                <?=$STR->addText[0]?>
            </td>
            <td>
                <input type="text" name="text" class="w-100">
            </td>
        </tr>
        <tr>
            <td colspan="2" class="cent">
                <input type="hidden" name="table" value="<?=$do?>">
                <input type="submit" value="新增">
                <input type="reset" value="重置">
            </td>
        </tr>
    </table>
</form>