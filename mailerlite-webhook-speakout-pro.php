<?php 

add_action("speakout_after_petition_signed", "send_signature_notification", 10);

function send_signature_notification( $data ) {

    // Prepara i dati per MailerLite
    $apiKey = 'METTI QUI LE TUE API'; 
    $groupId = 'METTI QUI ID DEL GRUPPO';  


    $subscriberData = [
        'email' => $data["email"],
        'name' => $data["first_name"],
        'fields' => [
            'last_name' => $data["last_name"],
			'optin' => $data["optin"],
            'zip' => $data["postcode"] 
        ]
    ];


    $ch = curl_init("https://api.mailerlite.com/api/v2/groups/$groupId/subscribers");
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'X-MailerLite-ApiKey: ' . $apiKey
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($subscriberData));

    curl_exec($ch);
    curl_close($ch);
	
	// Redirect URL alla thank-you page "/thank-you"
    wp_redirect('/QUI URL DEL REDIRECT!');
    exit;

}

?>
