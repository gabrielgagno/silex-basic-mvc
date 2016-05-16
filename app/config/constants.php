<?php
/**
 * Created by IntelliJ IDEA.
 * User: gabrielgagno
 * Date: 5/16/16
 * Time: 1:52 PM
 */

return array(
    'cardlink'              => \App\Libraries\CoreHelpersLibrary::env('P2ME_BASE_URL', '')."/cardlink",
    'requestfees'           => \App\Libraries\CoreHelpersLibrary::env('P2ME_BASE_URL', '')."/requestfees",
    'resetotp'              => \App\Libraries\CoreHelpersLibrary::env('P2ME_BASE_URL', '')."/resetotp",
    'reverse'               => \App\Libraries\CoreHelpersLibrary::env('P2ME_BASE_URL', '')."/reverse",
    'topup'                 => \App\Libraries\CoreHelpersLibrary::env('P2ME_BASE_URL', '')."/topup",
    'transactioninquiry'    => \App\Libraries\CoreHelpersLibrary::env('P2ME_BASE_URL', '')."/transactioninquiry",
    'validatemobilenumber'  => \App\Libraries\CoreHelpersLibrary::env('P2ME_BASE_URL', '')."/validatemobilenumber",
);