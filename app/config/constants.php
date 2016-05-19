<?php
/**
 * Created by IntelliJ IDEA.
 * User: gabrielgagno
 * Date: 5/16/16
 * Time: 1:52 PM
 */

return array(
    'cardlink'              => \App\Helpers\CoreHelpersLibrary::env('P2ME_BASE_URL', '')."/cardlink",
    'requestfees'           => \App\Helpers\CoreHelpersLibrary::env('P2ME_BASE_URL', '')."/requestfees",
    'resetotp'              => \App\Helpers\CoreHelpersLibrary::env('P2ME_BASE_URL', '')."/resetotp",
    'reverse'               => \App\Helpers\CoreHelpersLibrary::env('P2ME_BASE_URL', '')."/reverse",
    'topup'                 => \App\Helpers\CoreHelpersLibrary::env('P2ME_BASE_URL', '')."/topup",
    'transactioninquiry'    => \App\Helpers\CoreHelpersLibrary::env('P2ME_BASE_URL', '')."/transactioninquiry",
    'validatemobilenumber'  => \App\Helpers\CoreHelpersLibrary::env('P2ME_BASE_URL', '')."/validatemobilenumber",

    'access_lifetime'       => 300
);