<?php
$mandatory = [
    'TransactionId',
    'IncomingOrOutgoingFlag',
    'PartyCustomerId',
    'PartyAccountNumber',
    'TransactionDateTime',
    'TransactionAmount',
    'OrigTransactionAmt',
    'OrigTransactionCurrencyCd',
    'TransactionType',
    'TransactionCategory',
    'ChannelCode',
    'InternationalIndicator',
    'OnUsFlag',
    'ResponseCode',
    'ErrorCode',
    'ErrorCodeDesc',
    'PartyCardNumber',
    'CardNumberIndicator',
    'MerchantId',
    'MerchantName',
    'MerchantCategoryCode',
    'AuthSource',
    'AuthId',
    'AvailableBalance',
    'POSEntryMode',
    'TerminalId',
    'ECommerceIndicator',
    'ATMCapability',
    'ReversalIndicator',
];


$default_mapping = [
    'IncomingOrOutgoingFlag' => 'D',
    'TransactionCategory' => 'Purchase',
    'ChannelCode' => 'DCE',
];
$default_mapping_keys = array_keys($default_mapping);

$skip_mandatory = [
    'ErrorCode',
    'ErrorCodeDesc',
    'ReversalIndicator',
];

$q_where_tran_id_unmatch = "SUBSTRING(TransactionId, 1, 17) != CONCAT('DCE', REPLACE(REPLACE(REPLACE(TransactionDateTime, ':', ''), '-', ''),' ', ''))";
$q_where_tran_id_match = "SUBSTRING(TransactionId, 1, 17) = CONCAT('DCE', REPLACE(REPLACE(REPLACE(TransactionDateTime, ':', ''), '-', ''),' ', ''))";