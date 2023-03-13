<?php
$mandatory = [
    'TransactionId',
    'PartyCustomerId',
    'PartyAccountNumber',
    'TransactionDateTime',
    'TransactionType',
    'ChannelCode',
    'DeviceId',
    'IPAddress',
    'UserId',
    'ResponseCode',
    'ErrorCode',
    'ErrorCodeDesc',
    'SessionId',
    'PhoneNumber',
    'EmailAddress',
];


$default_mapping = [
    'ChannelCode' => 'IBC',
];
$default_mapping_keys = array_keys($default_mapping);

$skip_mandatory = [

];

$q_where_tran_id_unmatch = "SUBSTRING(TransactionId, 1, 17) != CONCAT('NIBC', REPLACE(REPLACE(REPLACE(TransactionDateTime, ':', ''), '-', ''),' ', ''))";
$q_where_tran_id_match = "SUBSTRING(TransactionId, 1, 17) = CONCAT('NIBC', REPLACE(REPLACE(REPLACE(TransactionDateTime, ':', ''), '-', ''),' ', ''))";