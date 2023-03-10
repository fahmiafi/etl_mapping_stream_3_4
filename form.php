
<form action="" method="post">
    <label for="">Transaction Category</label>
    <select name="tran_type" id="">
        <option value=""></option>
        <?php
        foreach ($tran_type as $key => $value) {
            ?>
            <option value="<?= $value?>" <?= @$_POST['tran_type'] == $value ? 'selected' : ''?>><?= $key?> (<?= $value?>)</option>
            <?php
        }
        ?>
    </select>
    <label for="">Limit</label>
    <input type="text" name="limit" value="<?= @$_POST['limit'] ? @$_POST['limit'] : '100'?>">
    <label for="">Data tampil</label>
    <select name="view_data" id="">
        <option value="all" <?= @$_POST['view_data'] == 'all' ? 'selected' : ''?>>Semua data</option>
        <option value="match" <?= @$_POST['view_data'] == 'match' ? 'selected' : ''?>>Hanya match</option>
        <option value="unmatch" <?= @$_POST['view_data'] == 'unmatch' ? 'selected' : ''?>>Hanya unmatch</option>
    </select>
    <label for="">Kondisi Khusus</label>
    <input type="text" name="where" value="<?= @$_POST['where'] ? @$_POST['where'] : ''?>" style="width: 500px">
    <button type="submit" name="submit">submit</button>
</form>