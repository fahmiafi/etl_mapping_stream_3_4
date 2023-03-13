<?php
$kolom = [
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

//Logic
function TransactionId ($id){
    global $con, $tabel;
    return true;
    
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