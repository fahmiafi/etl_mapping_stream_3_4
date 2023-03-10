<?php
$mandatory = [
    'TransactionId',
    'TransactionDateTime',
    'ChannelCode',
    'TransactionType',
    'TransactionCategory',
    'PartyCustomerId',
    'PartyCardNumber',
    'InternationalIndicator',
    'OnUsFlag',
    'MerchantCategoryCode',
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
    'ATMCapability',
    'ReversalIndicator',
];


$default_mapping = [
    'ChannelCode' => 'CCA',
    'TransactionCategory' => 'Cash Withdrawal',
    'InternationalIndicator' => 'D',
    'OnUsFlag' => 'OnUs',
    'VerificationMethod' => '1' ,
    'MerchantCategoryCode' => '6011',
];
$default_mapping_keys = array_keys($default_mapping);

$skip_mandatory = [
    'ErrorCode',
    'ErrorCodeDesc',
    'ReversalIndicator',
];

$q_where_tran_id_unmatch = "SUBSTRING(TransactionId, 1, 17) != CONCAT('CCA', REPLACE(REPLACE(REPLACE(TransactionDateTime, ':', ''), '-', ''),' ', ''))";
$q_where_tran_id_match = "SUBSTRING(TransactionId, 1, 17) = CONCAT('CCA', REPLACE(REPLACE(REPLACE(TransactionDateTime, ':', ''), '-', ''),' ', ''))";