<?php
require_once "PayPal-PHP-SDK/autoload.php";

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AWEOPrqokW16GkpK5yY0ze9Juq4xO0AplBJ5lCXIn9q-31t3fWfpowGDZyueH0rdaMpu-bAqgIMLViDE', // ClientID
        'EIU6ik6tqPm1TF7Qjrn3xzxiBk8nkKFmE_2o9PzsRmKxr2Ajab1IAte81DRlZmy30OeN_u2Xrc1x-cK-' // ClientSecret
    )
);
