<?php
include 'config.php';

$a = [
    'TransactionId',
    'PartyCustomerId',
    'PartyAccountNumber',
    'PartyCardNumber',
    'TransactionDateTime',
    'TransactionType',
    'ChannelCode',
    'DeviceId',
    'FingerprintId',
    'IPAddress',
    'UserId',
    'ResponseCode',
    'ErrorCode',
    'ErrorCodeDesc',
    'SessionId',
    'PhoneNumber',
    'EmailAddress',
];
$b = [
    'Y',
    'Y',
    'Y',
    'N',
    'Y',
    'Y',
    'Y',
    'Y',
    'N',
    'Y',
    'Y',
    'Y',
    'Y',
    'Y',
    'Y',
    'Y',
    'Y',
];

for ($i=0; $i < count($a); $i++) { 
    if (strtoupper($b[$i]) == 'Y') {
        echo "'".$a[$i]."', <br>";
    }
}

// $no = 1;
// $q = mysqli_query($con, "SELECT DISTINCT(agen_fin.TRANSACTIONID) FROM agen_fin WHERE CHANNELCODE = 'IBA'");
// while ($dt = mysqli_fetch_array($q)) {
//     $q_cek = mysqli_query($con, "SELECT TRANSACTIONID FROM agen_fin WHERE CHANNELCODE = 'IBA' AND TRANSACTIONID = '".$dt['TRANSACTIONID']."'");
//     if(mysqli_num_rows($q_cek) > 1) {
//         echo $no++.". "."<b>".$dt['TRANSACTIONID']."</b><br>";
//         while ($dt_cek = mysqli_fetch_array($q_cek)) {
//             echo $dt['TRANSACTIONID']."<br>";
//         }
//         echo "<br>";
//     }
// }
?>