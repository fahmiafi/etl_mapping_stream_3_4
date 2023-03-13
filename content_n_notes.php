<?php
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
?>
<div class="container">
    <table border="1" style="margin:20px 30px 20px 2opx" id="tbl_data">
        <?php
        $row = 1;
        $notes = array();
        $notes_kolom = array();
        $notes_null = array();
        $notes_not_sesuai = array();
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
                $jml_null = 0;
                $jml_not_sesuai = 0;
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

                        if ($kolom[$i] != 'TransactionId') {
                            $note .= ">>".$data['TransactionId'];
                        }
                        array_push($note_false, $note);

                        if ($data[$kolom[$i]] == '') {
                            $jml_null = $jml_null+1;
                        }
                        else{
                            $jml_not_sesuai = $jml_not_sesuai+1;
                        }
                        
                        $color = "FFD700";
                    }

                    if($j == count($id_data)-1 && count($note_false) > 0){
                        $notes_kolom[$kolom[$i]] = $note_false;
                        $notes_null[$kolom[$i]] = $jml_null;
                        $notes_not_sesuai[$kolom[$i]] = $jml_not_sesuai;
                    }
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
<style>
    .grid-notes {
        display: grid;
        grid-template-columns: auto auto auto auto;
        background-color: #FFA07A;
        padding: 5px;
    }
    .grid-notes-item {
        background-color: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(0, 0, 0, 0.8);
        padding: 5px;
    }

    .grid-notes-persen {
        display: grid;
        grid-template-columns: auto auto;
        background-color: #FFA07A;
        padding: 5px;
    }
    .grid-notes-persen-item {
        background-color: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(0, 0, 0, 0.8);
        padding: 5px;
    }
</style>
<h3>Notes: </h3>
<div style="text-align: center">
    <h3>Dari total data yang ditampilkan sebanyak: 
        <span style="color:red"><?= count($id_data)?></span> 
        dari 
        <span style="color:blue"><?= $all_data['all_data']?></span> data
    </h3>
</div>

<?php
$jml_mandatory = count($mandatory);
$all_kolom = $jml_mandatory*count($id_data);

$total_not_sesuai = 0;
foreach ($notes_kolom as $key => $note) {
    $total_not_sesuai += $notes_not_sesuai[$key];
    $total_not_sesuai += $notes_null[$key];
}
$persen_sesuai = (($all_kolom - $total_not_sesuai)/$all_kolom) * 100;
$persen_not_sesuai = ($total_not_sesuai/$all_kolom) * 100;
?>
<div class="grid-notes-persen"  style="text-align: center">
    <div class="grid-notes-persen-item">
        <h1 style="color: green"><?= round($persen_sesuai, 2)?>%</h1>
        <h2>Sesuai</h2>
    </div>
    <div class="grid-notes-persen-item">
        <h1 style="color: red"><?= round($persen_not_sesuai, 2) ?>%</h1>
        <h2>Tidak sesuai / kosong</h2>
    </div>
</div>
<br><br>
<div class="grid-notes">
    <?php
    $no = 1;
    foreach ($notes_kolom as $key => $note) {
        ?>
        <div class="grid-notes-item" style="text-align: center">
            <h3><?= $key?></h3>
            <h2><?= count($note)?></h2>
            <i>tidak sesuai : <b><?= $notes_not_sesuai[$key]?></b></i>
            <i>kosong : <b><?= $notes_null[$key]?></b></i>
        </div>
        <?php
    }
    ?>
</div>

<br><br>
<div class="grid-notes">
    <?php
    $no = 1;
    foreach ($notes as $key => $note) {
        $q_note = mysqli_query($con, "SELECT * FROM $tabel WHERE ID = '$key'");
        $dt_note = mysqli_fetch_array($q_note);
        ?>
        <div class="grid-notes-item">
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