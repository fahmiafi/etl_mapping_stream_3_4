<?php
$kolom = [
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

//Logic
function TransactionId ($id){
    global $con, $tabel;
    
    $q = mysqli_query($con, "SELECT * FROM $tabel where ID = '$id'");
    $dt = mysqli_fetch_array($q);

    $data = "DCA".str_replace(array('-', ':', ' '), "", $dt['TransactionDateTime']);

    // if ($data == $dt['TransactionId']) {
    if ($data == substr($dt['TransactionId'], 0, 17)) {
        return true;
    }
    return false;
}

function ReversalIndicator($id){
    global $con, $tabel;
    
    $q = mysqli_query($con, "SELECT ReversalIndicator FROM $tabel where ID = '$id'");
    $dt = mysqli_fetch_array($q);

    if ($dt['ReversalIndicator'] == NULL || $dt['ReversalIndicator'] == 'R') {
        return true;
    }
    return false;
}

function default_mapping($kolom, $data)
{
    global $default_mapping;

    if ($data == $default_mapping[$kolom]) {
        return true;
    }
    return false;
}

function kolom_mandatory($id, $param, $kolom){
    global $con, $tabel;
    
    //DCA
    if ($kolom == 'ErrorCode') {
        $q = mysqli_query($con, "SELECT ID, ResponseCode, ErrorCode, ErrorCodeDesc FROM $tabel WHERE ID = '$id'");
        $dt = mysqli_fetch_array($q);
        if ($dt['ResponseCode'] > '000' && $param > '000') {
            return true;
        }
        elseif ($dt['ResponseCode'] == '000' && $param == ''){
            return true;
        }
    }
    elseif($kolom == 'ErrorCodeDesc'){
        $q = mysqli_query($con, "SELECT ID, ResponseCode, ErrorCode, ErrorCodeDesc FROM $tabel WHERE ID = '$id'");
        $dt = mysqli_fetch_array($q);
        if ($dt['ResponseCode'] > '000' && $param > '000') {
            return true;
        }
        elseif ($dt['ResponseCode'] == '000' && $param == ''){
            return true;
        }
    }
    else{
        if ($param != '') {
            return true;
        }
    }
    return false;
}