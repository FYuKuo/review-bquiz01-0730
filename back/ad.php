<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli"><?= $STR->header ?></p>
    <form method="post" action="./api/edit.php">
        <table width="100%" class="cent">
            <tbody>
                <tr class="yel">
                    <td width="80%"><?= $STR->text[0] ?></td>
                    <td width="10%">顯示</td>
                    <td width="10%">刪除</td>
                </tr>

                <?php
                $DB = new DB($do);
                $rows = $DB->all();
                foreach ($rows as $key => $row) {
                ?>
                    <tr>
                        <td>
                        <input type="text" name="text[]" value="<?= $row['text'] ?>" class="w-90">
                        </td>
                        <td>
                            <input type="checkbox" name="sh[]" value="<?= $row['id'] ?>" <?=($row['sh'] == 1)?'checked':''?>>
                        </td>
                        <td>
                            <input type="checkbox" name="del[]" value="<?= $row['id'] ?>">
                        </td>
                        <input type="hidden" name="id[]" value="<?= $row['id'] ?>">
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <input type="hidden" name="table" value="<?=$do?>">
                    <td width="200px">
                        <input type="button" onclick="op('#cover','#cvr','./modal/<?=$do?>.php?do=<?=$do?>')" value="<?= $STR->addBtn ?>">
                    </td>
                    <td class="cent">
                        <input type="submit" value="修改確定">
                        <input type="reset" value="重置">
                    </td>
                </tr>
            </tbody>
        </table>

    </form>
</div>