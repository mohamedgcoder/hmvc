<?php

namespace App\Service;

class ApiResponseService
{

    private static $data;
    private static $pagination;
    private static int $ec;
    private static int $code;
    private static $exception;
    private static array $messages;

    public function __construct() {
        self::$ec = 0;
        self::$messages = [];
        self::$data = [];
        self::$code = 200;
        self::$exception = null;
    }

    public static function setData($data): void
    {
        self::$data = $data;
        self::setPagination();
    }

    public static function setPagination(): void
    {
        $data = self::data();

        try {
            $paginationData = [
                'path' => $data->path(),
                'total' => $data->total(),
                'perPage' => $data->perPage(),
                'currentPage' => $data->currentPage(),
                'lastPage' => $data->lastPage(),
            ];
        } catch (\Throwable $th) {
            // throw $th;
            $paginationData = [];
        }

        self::$pagination = $paginationData;
    }

    public static function setException($exception)
    {
        self::$exception = $exception;
    }

    public static function setEc($ec)
    {
        self::$ec = $ec;
    }

    public static function setMessages($messages)
    {
        self::$messages = $messages;
    }

    public static function setCode($code)
    {
        self::$code = $code;
    }

    public static function data()
    {
        return self::$data;
    }

    public static function pagination()
    {
        return self::$pagination;
    }

    public static function exception()
    {
        return self::$exception;
    }

    public static function ec()
    {
        return self::$ec;
    }

    public static function messages()
    {
        return self::$messages;
    }
    public static function code()
    {
        return self::$code;
    }

    public static function apiResponse()
    {
        try {
            $dataSize = sizeof(self::$data);
        } catch (\Throwable) {
            $dataSize = 1 ;
        }

        $dataSize = (self::data() != null) ? $dataSize : 0 ;
        $status = ($dataSize == 0 && self::$code == 200) ? false : true;
        self::$messages = (self::$exception != null) ? [__('errors.some_thing_error')] : self::$messages ;
        self::$messages = ($dataSize === 0) ? ((self::$messages == null) ? [__('errors.no_data_to_view')] : self::$messages) : self::$messages;

        return response()->json([
            'code' => self::$code,
            'responseStatus' => $status,
            'messages' => self::$messages, // show this message to user
            'response' => [
                'dataLength' => $dataSize,
                'pagination' => self::$pagination,
                'data' => self::data(),
            ],
            // array
            'error' => [
                // string
                'errorCode' => (self::$ec === 0)? '' : self::$ec, // code for detect or refer to development team
                // integer
                'line' => (self::$exception === null) ? '' : self::$exception->getLine(), // line of error
                // string
                'errorMessage' => (self::$exception === null) ? '' : self::$exception->getMessage(), // error message to specific error
                // string
                'file' => (self::$exception === null) ? '' : self::$exception->getFile(), // file has the error
            ],
        ], self::$code);
    }
}
