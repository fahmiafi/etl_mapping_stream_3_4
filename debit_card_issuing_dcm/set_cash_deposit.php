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
    'MerchantCategoryCode',
    'AuthSource',
    'AuthId',
    'AvailableBalance',
    'POSEntryMode',
    'VerificationMethod',
    'TerminalId',
    'ATMCapability',
    'ReversalIndicator',
];


$default_mapping = [
    'IncomingOrOutgoingFlag' => 'D',
    'TransactionCategory' => 'Cash Deposit',
    'ChannelCode' => 'DCA',
    'VerificationMethod' => '1' ,
];
$default_mapping_keys = array_keys($default_mapping);

$skip_mandatory = [
    'ErrorCode',
    'ErrorCodeDesc',
    'ReversalIndicator',
];

$q_where_tran_id_unmatch = "SUBSTRING(TransactionId, 1, 17) != CONCAT('DCM', REPLACE(REPLACE(REPLACE(TransactionDateTime, ':', ''), '-', ''),' ', ''))";
$q_where_tran_id_match = "SUBSTRING(TransactionId, 1, 17) = CONCAT('DCM', REPLACE(REPLACE(REPLACE(TransactionDateTime, ':', ''), '-', ''),' ', ''))";