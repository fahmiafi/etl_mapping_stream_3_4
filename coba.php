<?php
include 'config.php';

$a = [
    'TransactionId',
    'IncomingOrOutgoingFlag',
    'PartyCustomerId',
    'PartyAccountNumber',
    'PartyVirtualAccountNumber',
    'CounterPartyCustomerId',
    'CounterPartyAccountNumber',
    'CounterPartyVirtualAccountNumber',
    'CounterPartyBankCode',
    'CounterPartyBankName',
    'CounterPartyAccountCountry',
    'TransactionDateTime',
    'TransactionAmount',
    'OrigTransactionAmt',
    'OrigTransactionCurrencyCd',
    'TransactionType',
    'TransactionCategory',
    'ChannelCode',
    'BillerID',
    'BillingNumber',
    'InternationalIndicator',
    'DeviceId',
    'FingerprintId',
    'IPAddress',
    'OnUsFlag',
    'SourceOfFunds',
    'UserId',
    'Agent46Id',
    'ResponseCode',
    'ErrorCode',
    'ErrorCodeDesc',
    'QRCodeType',
    'SessionId',
    'Latitude',
    'Longitude',
    'LanguageCode',
    'Remark',
    'PartyCardNumber',
    'CardNumberIndicator',
    'MerchantId',
    'MerchantName',
    'MerchantCategoryCode',
    'AuthSource',
    'AuthId',
    'AvailableBalance',
    'POSEntryMode',
    'VerificationMethod',
    'TerminalId',
    'ECommerceIndicator',
    'PartyVirtualCardNumber',
    'ATMCapability',
    'ReversalIndicator',
];
$b = [
    'Y',
    'Y',
    'Y',
    'Y',
    'N',
    'Y',
    'Y',
    'N',
    'Y',
    'N',
    'N',
    'Y',
    'Y',
    'Y',
    'Y',
    'Y',
    'Y',
    'Y',
    'N',
    'N',
    'Y',
    'N',
    'N',
    'N',
    'Y',
    'N',
    'N',
    'N',
    'Y',
    'Y',
    'Y',
    'N',
    'N',
    'N',
    'N',
    'N',
    'N',
    'Y',
    'N',
    'N',
    'N',
    'Y',
    'Y',
    'Y',
    'Y',
    'Y',
    'Y',
    'Y',
    'N',
    'N',
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