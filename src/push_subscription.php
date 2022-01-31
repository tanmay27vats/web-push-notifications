<?php
$subscription = json_decode(file_get_contents('php://input'), true);

if (!isset($subscription['endpoint'])) {
    echo 'Error: not a subscription';
    return;
}

/*
-------------- $subscription - example array data -----------
Array(
    [endpoint] => https://sg2p.notify.windows.com/w/?token=BQYAAAAQ6t%2fyUMpOkVPHS%2brqwuVUDeVSca3qKnVeYMl1KJQTRFj8X0caL4EeyX794vt70j3s6XcvxB6esZ5uRENBocgN4VpG1ig%2boSMfKbbDCBnTgAqro59O96SewpWsNrLYx74BAXRpW4cRPmQr%2bEkseoZXG%2f9khgvZe5TL%2bCsS%2fpPrmKiJtsynmEPz%2f%2bVQdC2Eu8%2frkuSTxbq3r6H%2bPXKIg3Pt7b0KMcPNsKGR%2bLRoufX6NEF4BzONFvlzkZIODpZ5TihdIn7BeAzDql%2fJ5GXM51MvtyzAa3cTZGCe2lWEazcq%2fkmpXF0lcqa0r2nQs%2bDMg6YDw1ZWRQZYUcZlcHqphAsC

    [publicKey] => publicKey-string-goes-here

    [authToken] => authTokenGoesHere

    [contentEncoding] => aes128gcm
)
*/

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        // Insert new endpoint in DB (endpoint is unique)
        break;
    case 'PUT':
        // update the key and token in DB for user corresponding to the endpoint
        break;
    case 'DELETE':
        // delete the record from DB corresponding to the endpoint
        break;
    default:
        echo "Error: method not handled";
        return;
}
