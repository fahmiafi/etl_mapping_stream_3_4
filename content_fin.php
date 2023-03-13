<div class="content">
    <h3>Tipe transaksi yang terdapat pada data:</h3>
    <?php
    $no = 1;
    $q_tran_tipe = mysqli_query($con, "SELECT DISTINCT(TRANSACTIONTYPE) FROM $tabel WHERE TransactionCategory = '".str_replace(" (Bulk)","", $_POST['tran_type'])."' AND ChannelCode = '$channelcode' AND $query_where ".$_POST['where']."");
    while($dt_tran_tipe = mysqli_fetch_array($q_tran_tipe)){
        echo $no++.". ".$dt_tran_tipe['TRANSACTIONTYPE']."<br>";
    }
    ?>
    <br>

    <h3>Transaksi yang insyaAllah terdapat unmatch pada mappingan:</h3>
    <br>

    
    <?php
    $all_data = mysqli_fetch_array(mysqli_query($con, "SELECT count(id) as all_data FROM $tabel WHERE TransactionCategory = '".str_replace(" (Bulk)","", $_POST['tran_type'])."'  AND ChannelCode = '$channelcode'"));

    $limit = $_POST['limit'];
    $id_data = [];
    // echo "SELECT ID FROM $tabel WHERE TransactionCategory = '".str_replace(" (Bulk)","", $_POST['tran_type'])."' AND $query_where ".$_POST['where']." LIMIT $limit";
    $sql = mysqli_query($con, "SELECT ID FROM $tabel WHERE TransactionCategory = '".str_replace(" (Bulk)","", $_POST['tran_type'])."' AND ChannelCode = '$channelcode' AND $query_where ".$_POST['where']." LIMIT $limit");
    while ($dt = mysqli_fetch_assoc($sql)) {
        $id_data[] = $dt['ID'];
    }
    ?>
    <div style="margin-left: 50px; margin-right: 50px;">
        <p>Data ditampilkan : <b><?= count($id_data)?></b></p>
    </div>
    <?php
    include 'content_n_notes.php';
    ?>
</div>