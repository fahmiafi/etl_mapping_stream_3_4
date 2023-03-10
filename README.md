# etl_mapping_stream_3_4

<h3 style="text-align: center;">Stream 3a</h3>
<ol>
    <li>
        <a href="#">ATM_ACQUIRING</a>
        catatan:<br>
        ==TransactionId (ALL Transaction Category) ==<br>
        * Perlu konfirmasi, pada logic mapping "ATQ + CONCAT AUTH_SEQ_NUM, AUTH_TRAN_DAT, AUTH_TRAN_TIM" tapi hasil "ATQ + CONCAT AUTH_TRAN_DAT, AUTH_TRAN_TIM, AUTH_SEQ_NUM", AUTH_SEQ_NUM gatau dari mana <br>
        *terdapat TransactionDateTime yang tidak sesuai dengan TransactionId<br>
        ==PartyCustomerId (ALL Transaction Category) ==<br>
        * terdapat beberapa data PartyCustomerId yang kosong
        ==AvailableBalance (Bill Payment)==<br>
        * AvailableBalance kosong semua
        ==
    </li>  
    <li><a href="#">CREDIT_CARD_ISSUING (CCA)</a></li>  
    <li><a href="#">DEBIT_CARD_ISSUING (DCA)</a></li>  
</ul>