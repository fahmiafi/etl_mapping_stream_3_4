<?php
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
?>
<style>
    .grid-container {
        display: grid;
        grid-template-columns: auto auto auto auto;
        background-color: #FFA07A;
        padding: 5px;
    }
    .grid-item {
        background-color: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(0, 0, 0, 0.8);
        padding: 5px;
    }
</style>
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
    <div class="container">
        <table border="1" style="margin:20px 30px 20px 2opx" id="tbl_data">
            <tr>
                <th>ID Data</th>
                <?php
                    for ($j=0; $j < count($id_data); $j++) { 
                        ?>
                        <td><?= $id_data[$j]?></td>
                        <?php
                    }
                ?>
            </tr>
            <?php
            $row = 1;
            $notes = array();
            $check_mapping = array();
            
            for ($i=0; $i < count($kolom); $i++) { 
                $abjad = 'A';
                ?>
                <tr>
                    <?php
                    $color_mandatory = 'F0FFFF';
                    if (in_array($kolom[$i], $mandatory)) {
                        $color_mandatory = '7CFC00';
                    }
                    ?>
                    <th style="background-color:#<?= $color_mandatory?>"><?= $kolom[$i]?></td>
                    <?php
                    $sheet->setCellValue($abjad.$row, $kolom[$i]);
                    $sheet->getStyle($abjad.$row)->applyFromArray($style_col);
                    $spreadsheet->getActiveSheet()->getStyle($abjad.$row)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB($color_mandatory);

                    $abjad++;
                    $note_false = array();
                    for ($j=0; $j < count($id_data); $j++) { 
                        $id = $id_data[$j];
                        $query = mysqli_query($con, "SELECT TransactionId, $kolom[$i] FROM $tabel WHERE ID = '$id' LIMIT 1");
                        $data = mysqli_fetch_array($query);

                        // <kondisi jika ada yang mappingan khusus>
                        $cek = true;
                        $color = "FFFFFF";
                        
                        include 'cek_kondisi.php';
                        // </kondisi jika ada yang mappingan khusus>

                        if($cek == true){

                        }
                        else{
                            $note = $data[$kolom[$i]] == '' ? 'NULL' : $data[$kolom[$i]];
                            if (!array_key_exists($id, $notes)) {
                                $notes[$id] = array();
                            }
                            array_push($notes[$id], $kolom[$i]);
                            // $note = $data[$kolom[$i]] == '' ? 'NULL' : $data[$kolom[$i]];
                            // if ($kolom[$i] != 'TransactionId') {
                            //     $note .= ">>".$data['TransactionId'];
                            // }
                            // array_push($note_false, $note);
                            $color = "FFD700";
                        }

                        // if($j == count($id_data)-1 && count($note_false) > 0){
                        //     $notes[$kolom[$i]] = $note_false;
                        // }
                        ?>
                        <td style="background-color:#<?= $color?>"><?= $data[$kolom[$i]]?></td>
                        <?php
                        $sheet->getCell($abjad.$row)->setValueExplicit(
                            $data[$kolom[$i]],
                            \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING2
                        );
                        $sheet->getStyle($abjad.$row)->applyFromArray($style_row);
                        $spreadsheet->getActiveSheet()->getStyle($abjad.$row)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB($color);
                        $abjad++;
                    }
                    ?>
                </tr>
                <?php
                $row++;
            }

            $abjad = 'A';
            for ($i=0; $i < $limit + 1; $i++) { 
                $spreadsheet->getActiveSheet()->getColumnDimension($abjad)->setAutoSize(true);
                $abjad++;
            }
            $sheet->freezePane('B1');
            ?>
        </table>
    </div>
    <?php
    $name_file = date('YmdGis').'_'.$name_channel.'_'.str_replace(" (Bulk)","", $_POST['tran_type']).'.xlsx';
    mysqli_query($con, "INSERT INTO export_excel (name, date, category) VALUES ('$name_file', '".date('Y-m-d G:i:s')."', '$name_channel')");
    $writer = new Xlsx($spreadsheet);
    $writer->save('../download/'.$name_file);

    ?>
    <br>
    <a href="../download/<?= $name_file?>"><?= $name_file?></a>
    <br><br>

    <h3>Notes: </h3>
    <div class="grid-container">
        <?php
        $no = 1;
        foreach ($notes as $key => $note) {
            $q_note = mysqli_query($con, "SELECT * FROM $tabel WHERE ID = '$key'");
            $dt_note = mysqli_fetch_array($q_note);
            ?>
            <div class="grid-item">
                <b><?= $no++?>. <?= $dt_note['TransactionId']?> (<?= count($note)?>)</b>
                <ol style="margin-bottom:0px">
                    <?php
                    for ($i=0; $i < count($note); $i++) { 
                        ?>
                        <li> <?= $note[$i]?> >> <?= $dt_note[$note[$i]] == '' ? 'NULL' : $dt_note[$note[$i]]?></li>
                        <?php
                    }
                    ?>
                </ol>
            </div>
            <?php
        }
        ?>
    </div>
</div>