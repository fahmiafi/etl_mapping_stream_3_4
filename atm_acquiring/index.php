<?php
$name_channel = $_GET['name'];
$tabel = $_GET['name'];
$channelcode = $_GET['channel_code'];
include '../config.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

include '../style_excel.php';

$tran_type = [
    'Inhouse Transfer' => 'Inhouse Transfer',
    'Interbank Transfer' => 'Interbank Transfer',
    'Virtual Account Transfer' => 'VA Transfer',
    'Cash Withdrawal' => 'Cash Withdrawal',
    'Bill Payment' => 'Bill Payment',
    'Cash Deposit' => 'Cash Deposit',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $name_channel?></title>
    <style>
        .container{
            overflow:auto;
            height:700px;
            margin-left: 50px;
            margin-right: 50px;
            border: 1px solid black;
        }
        #tbl_data td, #tbl_data th {
            border: 1px solid #000;
            font-size: 15px;
            padding: 2px;
        }

        #tbl_data td:first-child, #tbl_data th:first-child {
            position:sticky;
            left:0;
            z-index:1;
        }
    </style>
</head>
<body>
    <a href="../index.php">HOME</a>
    <div style="text-align: center;">
        <h3><?= $name_channel?></h3>
    </div>
    <br>

    <?php
    include '../jml_data.php';
    ?>

    <br>
    <a href="../export_excel.php?name=<?= $name_channel?>">Hasil Export Excel</a>
    <br><br>
    <?php
    include '../form.php';

    if (isset($_POST['submit'])) {
        $include = $_POST['tran_type'];
        $include = strtolower($include);
        $include = str_replace(" ","_", $include);
        $include = 'set_'.$include;

        if(file_exists($include.'.php')){
            include $include.'.php';
        }
        else{
            exit;
        }

        if ($_POST['view_data'] == 'match') {
            $q_where_default = "";
            foreach ($default_mapping as $key => $value) {
                $q_where_default .= $key." = '".$value."' AND ";
            }
    
            $q_where_mandatory = "";
            for ($i=0; $i < count($mandatory); $i++) { 
                if (!in_array($mandatory[$i], $skip_mandatory)) {
                    $q_where_mandatory .= $mandatory[$i]." != '' AND ";
                }
            }
            $q_where_mandatory = rtrim($q_where_mandatory, " AND ");
            $query_where = $q_where_tran_id_match." AND ".$q_where_default." ".$q_where_mandatory;
            // $query_where = "(".$q_where_default." ".$q_where_mandatory.")";
        }
        elseif ($_POST['view_data'] == 'unmatch') {
            $q_where_default = "";
            foreach ($default_mapping as $key => $value) {
                $q_where_default .= $key." != '".$value."' OR ";
            }
    
            $q_where_mandatory = "";
            for ($i=0; $i < count($mandatory); $i++) { 
                if (!in_array($mandatory[$i], $skip_mandatory)) {
                    $q_where_mandatory .= $mandatory[$i]." = '' OR ";
                }
            }
            $q_where_mandatory = rtrim($q_where_mandatory, " OR ");
            $query_where = "(".$q_where_tran_id_unmatch." OR ".$q_where_default." ".$q_where_mandatory.")";
            // $query_where = "(".$q_where_default." ".$q_where_mandatory.")";
        }
        else{
            $query_where = "1=1";
        }

        include 'setting.php';
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        include '../content_fin.php';
    }
    ?>
</body>
</html>