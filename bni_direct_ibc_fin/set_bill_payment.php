<?php
$mandatory = [
    'TransactionId',
    'PartyCustomerId',
    'PartyAccountNumber',
    'PartyVirtualAccountNumber',
    'CounterPartyCustomerId',
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
    'IPAddress',
    'OnUsFlag',
    'SourceOfFunds',
    'UserId',
    'MakerUserId',
    'ApproverUserId',
    'ResponseCode',
    'ErrorCode',
    'ErrorCodeDesc',
    'Remark',
    'AuthId',
];


$default_mapping = [
    'IncomingOrOutgoingFlag' => 'D',
    'TransactionCategory' => 'Bill Payment',
    'ChannelCode' => 'IBC',
    'OnUsFlag' => 'OnUs',
];
$default_mapping_keys = array_keys($default_mapping);

$skip_mandatory = [

];

$q_where_tran_id_unmatch = "SUBSTRING(TransactionId, 1, 17) != CONCAT('IBC', REPLACE(REPLACE(REPLACE(TransactionDateTime, ':', ''), '-', ''),' ', ''))";
$q_where_tran_id_match = "SUBSTRING(TransactionId, 1, 17) = CONCAT('IBC', REPLACE(REPLACE(REPLACE(TransactionDateTime, ':', ''), '-', ''),' ', ''))";