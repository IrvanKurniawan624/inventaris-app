<?php

namespace App\Helpers;

class ApiFormatter
{

    protected static $success_response =  [
        'code' =>  null,
        'data' => null,
        'message' => null,
    ];

    protected static $error_response =  [
        'code' =>  null,
        'errors' => null,
        'message' => null,
    ];

    protected static $response =  [
        'code' =>  null,
        'message' => null,
        'data' => null,
    ];

    public static function pagination($message, $data)
    {
        $response['status'] = 200;
        $response['message'] = $message;
        $response = array_merge_recursive($response, $data->toArray());

        return response()->json($response, 200);
    }

    public static function success($code, $message, $data = null)
    {
        if($code === 200 || $code === 201){
            self::$success_response['code'] = $code;
            self::$success_response['data'] = $data;
            self::$success_response['message'] = $message;
            return response()->json(self::$success_response, self::$success_response['code']);
        }

        return response()->json([
            'code' => 400,
            'message' => 'Wrong status code'
        ], 400);
    }

    public static function error($code, $message)
    {
        if($code !== 200 || $code !== 201){
            self::$error_response['code'] = $code;
            self::$error_response['errors'] = [
                'message' => '',
                'field' => '',
            ];
            self::$error_response['message'] = $message;

            return response()->json(self::$error_response, self::$error_response['code']);
        }

        return response()->json([
            'code' => 400,
            'message' => 'Wrong status code'
        ], 400);
    }

    public static function createApi($code = null, $message = null, $data = null)
    {
        self::$response['code'] = $code;
        self::$response['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['code']);
    }

    public static function getResponse($data = null)
    {
        if(!empty($data) || count($data)){
            return [
                'status' => 200,
                'data' => $data,
            ];
        }else{
            return [
                'status' => 300,
                'message' => 'Data tidak ditemukan'
            ];
        }
    }
}
