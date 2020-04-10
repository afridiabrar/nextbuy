<?php
define('API_SERVER_KEY_GOOGLE', 'AAAA68ID16o:APA91bGZsS1sRz4_OPnczeURxac1v5iefQYYEJUbYwLAo25Cn0BNPPy59KI0dKOz8vNOAZKgZDk-Dfwg9CSXi3FdMcifBu8vHo_L73RIDgbO0fRPvgrQtootXoEK7m_0uPLRiuXuNzmf');

if (!function_exists('SendNotification')) {
    function SendNotification($device_id, $title, $body, $screen = NULL, $job_data = NULL)
    {
        $fields = array(
            'to' => $device_id,
            'notification' => array(
                "title" => $title,
                "body" => $body,
                'sound' => 'default',
            ),
            'priority' => 'high',
            'data' => array(
                'job' => $job_data,
                'screen' => $screen
            )
        );
        // ));
        //header includes Content type and api key
        $data = json_encode($fields);
        //FCM API end-point
        $url = 'https://fcm.googleapis.com/fcm/send';
        //api_key in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
        //header with content_type api key
        $headers = array(
            'Authorization:key=' . API_SERVER_KEY_GOOGLE,
            'Content-Type:application/json',
        );
        //CURL request to route notification to FCM connection server (provided by Google)
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Oops! FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        //echo $result;
    }

    if (!function_exists('upload_image')) {
        function upload_image($request, $folder)
        {
            $validator = Validator::make($request->all(), [
                'image' => 'required'
                //'image' => 'mimes:jpeg,jpg,png,gif|required|max:50000'
            ]);
            if ($validator->fails()) {
                return array('status' => false, 'message' => $validator->messages()->first());
                //            return response()->json(
                //                [
                //                    'status' => false,
                //                    'message' => $validator->messages()->first()
                //                ]
                //                , 200);
            }
            if ($request->image != '') {
                $image = $request->image;
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename = time() . '.' . $extension;
                $file->move($folder, $filename);
                $data = $filename;
                sleep(1);
                //$image =  baseImage($request->image , '/app/images/');
                return array('status' => true, 'message' => 'Image Uploaded', 'data' => $data);
                //            return response()->json(
                //                [
                //                    'status'=>true,
                //                    'message'=>'Image Uploaded',
                //                    'data' =>$image
                //                ],200);
            }
        }
    }
}
