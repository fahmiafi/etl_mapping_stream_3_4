<?php
if ($kolom[$i] == 'TransactionId') {
    $cek = TransactionId($id);
}
elseif ($kolom[$i] == 'ReversalIndicator') {
    $cek = ReversalIndicator($id);
}
elseif (in_array($kolom[$i], $default_mapping_keys)) {
    $cek = default_mapping($kolom[$i], $data[$kolom[$i]]);
}
elseif (in_array($kolom[$i], $mandatory)) {
    $cek = kolom_mandatory($id, $data[$kolom[$i]], $kolom[$i]);
}