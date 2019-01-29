<?php 

 function responseJson($status,$message,$data=null,$data2=null) {

    	$response = [
    		'status' => $status ,
    		'message' => $message ,
    		'data' => $data ,
    		'data2' => $data2,
    	];

    	return response()->json($response);
    }


 function notifyByFirebase($title, $body, $tokens, $data = [], $is_notification = true)
    {

    $registrationIDs = $tokens;
 
    $fcmMsg = array(
        'body' => $body,
        'title' => $title,
        'sound' => "default",
        'color' => "#203E78"
    );
    //dd($fcmMsg);
    $fcmFields = array(
        'registration_ids' => $registrationIDs,
        'priority' => 'high',
        'data' => $data
    );
    //dd($fcmFields);
    if ($is_notification)
    {
        $fcmFields['notification'] = $fcmMsg;
    }
    //dd($fcmFields['notification']);
 
    $headers = array(
        'Authorization: key=' . env('FIREBASE_API_ACCESS_KEY'),
        'Content-Type: application/json'
    );
    //dd($headers);
 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}   