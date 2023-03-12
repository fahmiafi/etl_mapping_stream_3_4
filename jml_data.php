<?php
$q_jml_where = '1=1';
$jml_channelcode = mysqli_fetch_array(mysqli_query($con, "SELECT count(id) as jml_channelcode FROM $tabel WHERE $q_jml_where AND ChannelCode = '$channelcode'"));
?>
<p>Jumlah data channel code <b><?= $channelcode?></b> : <b><?= $jml_channelcode['jml_channelcode']?></b></p>
<?php
$all_tran_cat = 0;
foreach ($tran_type as $key => $value) {
    if ($name_channel == 'bni_direct_fin') {
        $TransactionType_jml = $transaction_type_bni_direct[$value];
        $jml_tran_cat = mysqli_fetch_array(mysqli_query($con, "SELECT count(id) as jml_tran_cat FROM $tabel WHERE $q_jml_where AND TransactionCategory = '".str_replace(" (Bulk)","", $value)."' AND TransactionType IN ('".implode("', '", $TransactionType_jml)."') AND ChannelCode = '$channelcode'"));
    }
    else{
        $jml_tran_cat = mysqli_fetch_array(mysqli_query($con, "SELECT count(id) as jml_tran_cat FROM $tabel WHERE $q_jml_where AND TransactionCategory = '".$value."'  AND ChannelCode = '$channelcode'"));
    }
    ?>
    <p><b><?= $key?> (<?= $value?>)</b> : <b><?= $jml_tran_cat['jml_tran_cat']?></b></p>
    <?php
    $all_tran_cat += $jml_tran_cat['jml_tran_cat'];
}
?>
<p>Jumlah data TANPA TransactionCategory, channel code <b><?= $channelcode?></b> : <b><?= $jml_channelcode['jml_channelcode'] - $all_tran_cat ?></b></p>