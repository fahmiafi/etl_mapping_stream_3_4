<?php
$stream_3a = [
    'ATM_ACQUIRING' => [
        'channel_code' => 'ATQ',
        'name' => 'atm_acquiring',
        'path' => 'atm_acquiring',
    ],
    //CREDIT_CARD_ISSUING
    'CREDIT_CARD_ISSUING (CCA)' => [
        'channel_code' => 'CCA',
        'name' => 'credit_card_issuing',
        'path' => 'credit_card_issuing_cca',
    ],
    //DEBIT_CARD_ISSUING
    'DEBIT_CARD_ISSUING (DCA)' => [
        'channel_code' => 'DCA',
        'name' => 'debit_card_issuing',
        'path' => 'debit_card_issuing_dca',
    ],
    'DEBIT_CARD_ISSUING (DCM)' => [
        'channel_code' => 'DCM',
        'name' => 'debit_card_issuing',
        'path' => 'debit_card_issuing_dcm',
    ],
    'DEBIT_CARD_ISSUING (DCE)' => [
        'channel_code' => 'DCE',
        'name' => 'debit_card_issuing',
        'path' => 'debit_card_issuing_dce',
    ],
    'DEBIT_CARD_ISSUING (DCD)' => [
        'channel_code' => 'DCD',
        'name' => 'debit_card_issuing',
        'path' => 'debit_card_issuing_dcd',
    ],
];

$stream_4 = [
    'BNI DIRECT' => [
        'channel_code' => 'IBC',
        'name' => 'bni_direct_fin',
        'path' => 'bni_direct_ibc_fin',
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stream 3a dan 4</title>
</head>
<body>
    <div style="width: 500px; border: 1px solid black; padding: 20px">
        <h3 style="text-align: center;">Stream 3a</h3>
        <ol>
            <?php
            foreach ($stream_3a as $key => $value) {
                ?>
                <li><a href="<?= $value['path']?>/index.php?name=<?= $value['name']?>&channel_code=<?= $value['channel_code']?>"><?= $key?></a></li>  
                <?php
            }
            ?>
        </ul>
    </div>
    <div style="width: 500px; border: 1px solid black; padding: 20px">
        <h3 style="text-align: center;">Stream 4</h3>
        <ol>
            <?php
            foreach ($stream_4 as $key => $value) {
                ?>
                <li><a href="<?= $value['path']?>/index.php?name=<?= $value['name']?>&channel_code=<?= $value['channel_code']?>"><?= $key?></a></li>  
                <?php
            }
            ?>
        </ul>
    </div>
</body>
</html>