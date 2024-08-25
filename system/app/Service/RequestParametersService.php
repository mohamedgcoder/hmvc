<?php

namespace App\Service;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RequestParametersService
{
    protected static $row;
    protected static $data = [];
    protected static $validate = [];

    public static function getRow()
    {
        return static::$row;
    }

    public static function getData()
    {
        return static::$data;
    }

    public static function getvalidate()
    {
        return static::$validate;
    }

    public static function setRow($row)
    {
        static::$row = $row;
    }

    public static function setData($data)
    {
        static::$data = $data;
    }

    public static function setValidate($validate)
    {
        static::$validate = $validate;
    }

    public static function setValidateImage($validate)
    {
        static::$validate['image'] = $validate;
    }

    public static function setUpdatedBy()
    {
        // set who update record
        static::$data['last_updated_by'] = _auth()->code;
    }

    public static function setCreatedBy()
    {
        static::$data['created_by'] = _auth()->code;
    }

    public static function uniqueParameterRequest($parameter)
    {
        if(request()->has($parameter)){
            static::$validate[$parameter] = [
                'required',
                'min:4',
                ($parameter == 'email')? 'email' : 'string',
                (static::$row[$parameter] != request()->$parameter)? 'unique:brands,'.$parameter: '',
            ];

            static::$data[$parameter] = request()->$parameter;
        }else{
            static::$data[$parameter] = static::$row[$parameter];
        }
    }

    public static function parameterRequest($parameter)
    {
        if(request()->has($parameter)){
            static::$validate[$parameter] = [
                ($parameter == 'status')? Rule::in([2,3]) : '',
            ];

            static::$data[$parameter] = request()->$parameter;
        }else{
            static::$data[$parameter] = static::$row[$parameter];
        }
    }

    // upload image to @folder if exist in request file image
    public static function uploadImageRquest($folder)
    {
        if(request()->file('image')){
            // remove old one if exist
            $oldImagePath = _images_path($folder . '/' . static::$row->image);
            if (static::$row->image != null && file_exists($oldImagePath)){
                unlink($oldImagePath);
            }

            // upload images
            $file = request()->file('image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(_images_path($folder), $filename);
            static::$data['image'] = $filename;
        }
    }
}