<?php namespace App\Http;

class Response
{
    public static function success($message, $extra=[], $token=null)
    {
        $header = [
            'Content-Type' => 'application/json; charset=UTF-8'
            ,'Charset' => 'utf-8'
        ];

        if($token) {
            $header['x-api-key'] = $token;
        }

        $response = collect([
            'status' => true
            ,'message' => $message
        ])->merge($extra);

        return response()->json(
              $response,
              200,
              $header,
              JSON_UNESCAPED_UNICODE
        );
    }

    public static function error($message, $extra=[])
    {
        $header = [
            'Content-Type' => 'application/json; charset=UTF-8'
            ,'Charset' => 'utf-8'
        ];

        $response = collect([
            'status'   => false
            ,'message'  =>$message
        ])->merge($extra);

        return response()->json(
              $response,
              200,
              $header,
              JSON_UNESCAPED_UNICODE
        );
    }

    public static function success_html($message, $extra=[], $token=null)
    {
        $header = [
            'Content-Type' => 'text/html;  charset=UTF-8', true
            ,'Charset' => 'UTF-8'
        ];

        if($token) {
            $header['x-api-key'] = $token;
        }

        $response = collect([
            'status' => true
            ,'message' => $message
        ])->merge($extra);

        return response()->json(
            $response,
            200,
            $header,
            JSON_UNESCAPED_UNICODE
        );
    }
}
