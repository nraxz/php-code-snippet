<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // API Parameters
    $apiUrl = 'https://designer.printsafe.net/pdf_admin/rpc_api_v_4_0_0/';
    $key = 'Your API KEY';  // Replace with your actual key
    $username = 'Your USER_NAME';  // Replace with your actual username
   // $productId = '9485'; // Default value, will be replaced by the form input
    $successUrl = 'https://test.stagecoach-ordering.co.uk/backtopage.html';
    $failureUrl = 'https://test.stagecoach-ordering.co.uk/failpage.html';
    $closeUrl = 'https://test.stagecoach-ordering.co.uk/closeurl.html';
    $comment = 'comment';
    $lan = 'en';

    // Retrieve order_id from the form
    $productId = isset($_POST['productId']) ? $_POST['productId'] : '';

    // XML-RPC Request
    $xmlrpcRequest = "<?xml version='1.0'?>
        <methodCall>
            <methodName>beginPersonalization</methodName>
            <params>
                <param>
                    <value>
                        <string>{$username}</string>
                    </value>
                </param>
                <param>
                    <value>
                        <string>{$key}</string>
                    </value>
                </param>
                <param>
                    <value>
                        <string>{$productId}</string>
                    </value>
                </param>
                <param>
                    <value>
                        <string>{$successUrl}</string>
                    </value>
                </param>
                <param>
                    <value>
                        <string>{$failureUrl}</string>
                    </value>
                </param>
                <param>
                    <value>
                        <string>{$closeUrl}</string>
                    </value>
                </param>
                <param>
                    <value>
                        <string>{$comment}</string>
                    </value>
                </param>
                <param>
                    <value>
                        <string>{$lan}</string>
                    </value>
                </param>
            </params>
        </methodCall>";

    // Make API Call using cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlrpcRequest);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $apiResponse = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error making API call: ' . curl_error($ch);
    } else {
        echo 'API Response: ' . $apiResponse;
    }

    curl_close($ch);
} else {
    echo 'Invalid request method. Use POST.';
}
?>
