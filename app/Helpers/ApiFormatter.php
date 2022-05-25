<?php 


namespace App\Helpers;

class ApiFormatter{

    protected static $response = [

        'code'=> null,
        'messages' => null,
        'data' => null,
    ];

    public static function createApi( $code = null, $messages = null , $data= null)
    {
        self::$response['code'] = $code;
        self::$response['messages'] = $messages;
        self::$response['data'] = $data;

        return response()->json(self::$response,self::$response['code']);
    }
}