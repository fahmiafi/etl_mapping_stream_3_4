<?php
$kolom = [
    'TransactionId',
    'TransactionDateTime',
    'ChannelCode',
    'TransactionType',
    'TransactionCategory',
    'PartyCustomerId',
    'PartyCardNumber',
    'InternationalIndicator',
    'OnUsFlag',
    'MerchantId',
    'MerchantName',
    'MerchantCategoryCode',
    'MerchantCity',
    'MerchantCountryCode',
    'IssuerRefId',
    'AuthSource',
    'ResponseCode',
    'ErrorCode',
    'ErrorCodeDesc',
    'AuthId',
    'AvailableBalance',
    'TransactionAmount',
    'OrigTransactionAmt',
    'OrigTransactionCurrencyCd',
    'CardProductCode',
    'POSEntryMode',
    'VerificationMethod',
    'TerminalId',
    'ECommerceIndicator',
    'PartyVirtualCardNumber',
    'ATMCapability',
    'STIPFlag',
    'CreditTrxUserID',
    'AcquirerId',
    'ReversalIndicator',
];

//Logic
function TransactionId ($id){
    global $con, $tabel;
    
    $q = mysqli_query($con, "SELECT * FROM $tabel where ID = '$id'");
    $dt = mysqli_fetch_array($q);

    $data = "CCA".str_replace(array('-', ':', ' '), "", $dt['TransactionDateTime']);

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
    
    //CCA
    if ($kolom == 'ErrorCode') {
        $q = mysqli_query($con, "SELECT ID, ResponseCode, ErrorCode, ErrorCodeDesc FROM $tabel WHERE ID = '$id'");
        $dt = mysqli_fetch_array($q);
        if ($dt['ResponseCode'] == 'DECLINE' && $param > '000') {
            return true;
        }
        elseif ($dt['ResponseCode'] != 'DECLINE' && $param == ''){
            return true;
        }
    }
    elseif($kolom == 'ErrorCodeDesc'){
        $q = mysqli_query($con, "SELECT ID, ResponseCode, ErrorCode, ErrorCodeDesc FROM $tabel WHERE ID = '$id'");
        $dt = mysqli_fetch_array($q);
        if ($dt['ResponseCode'] == 'DECLINE' && $param != '') {
            return true;
        }
        elseif ($dt['ResponseCode'] != 'DECLINE' && $param == ''){
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