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
    'DeviceId',
    'IPAddress',
    'OnUsFlag',
    'SourceOfFunds',
    'UserId',
    'MakerUserId',
    'ApproverUserId',
    'ResponseCode',
    'ErrorCode',
    'ErrorCodeDesc',
    'SessionId',
    'Remark',
    'AuthId',
];

//Logic
function TransactionId ($id){
    global $con, $tabel;
    
    $q = mysqli_query($con, "SELECT * FROM $tabel where ID = '$id'");
    $dt = mysqli_fetch_array($q);

    $data = "IBC".$dt['AuthId'];

    if ($data == $dt['TransactionId']) {
        return true;
    }
    return false;
}

function default_mapping($kolom, $data)
{
    global $default_mapping;

    if ($kolom == 'ChannelCode') {
        if ($data == 'IBC' || $data == 'MBC') {
            return true;
        }
    }
    else{
        if ($data == $default_mapping[$kolom]) {
            return true;
        }
    }
    return false;
}

function kolom_mandatory($id, $param, $kolom){
    global $con, $tabel;
    
    if ($kolom == 'ErrorCode' || $kolom == 'ErrorCodeDesc' ) {
        $q = mysqli_query($con, "SELECT ID, ResponseCode, ErrorCode, ErrorCodeDesc FROM $tabel WHERE ID = '$id'");
        $dt = mysqli_fetch_array($q);
        if ($dt['ResponseCode'] == 'Failed' && $param != '') {
            return true;
        }
        elseif ($dt['ResponseCode'] == 'OK' && $param == ''){
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