<?php
$mandatory = [
    'TransactionId',
    'TransactionDateTime',
    'ChannelCode',
    'TransactionType',
    'TransactionCategory',
    'PartyCustomerId',
    'PartyAccountNumber',
    'PartyCardNumber',
    'CardType',
    'InternationalIndicator',
    'OnUsFlag',
    'MerchantCategoryCode',
    'IssuerRefId',
    'AuthSource',
    'ResponseCode',
    'ErrorCode',
    'AuthId',
    'AvailableBalance',
    'TransactionAmount',
    'OrigTransactionAmount',
    'OrigTransactionCurrencyCd',
    'POSEntryMode',
    'TerminalId',
    'ATMAddress',
    'ATMCapability',
    'ReversalIndicator',
];


$default_mapping = [
    'ChannelCode' => 'ATQ',
    'TransactionCategory' => 'Cash Withdrawal',
    'CardType' => 'D' ,
    'MerchantCategoryCode' => '6011',
];
$default_mapping_keys = array_keys($default_mapping);

$skip_mandatory = [
    'ErrorCode',
    'ReversalIndicator',
];

$q_where_tran_id_unmatch = "SUBSTRING(TransactionId, 1, 17) != CONCAT('ATQ', REPLACE(REPLACE(REPLACE(TransactionDateTime, ':', ''), '-', ''),' ', ''))";
$q_where_tran_id_match = "SUBSTRING(TransactionId, 1, 17) = CONCAT('ATQ', REPLACE(REPLACE(REPLACE(TransactionDateTime, ':', ''), '-', ''),' ', ''))";