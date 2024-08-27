<?php

use Tenancy\Models\Tenant;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Title Separation
|--------------------------------------------------------------------------
|
|
| @return path as @string
|
 */
if (!function_exists('_title_separation')) {
    function _title_separation(): string
    {
        return _settings('settings', 'title_separation') . ' ';
    }
}

/*
|--------------------------------------------------------------------------
| System Themes
|--------------------------------------------------------------------------
|
|
| @return path as @string
|
 */
if (!function_exists('_themes')) {
    function _themes(string $path = null): string
    {
        $themes = '/uploads/themes';
        if ($path != null) {
            $path = '/' . $path;
        }

        return url($themes. $path);
    }
}

/*
|--------------------------------------------------------------------------
| Current Theme
|--------------------------------------------------------------------------
|
|
| @return string
|
 */
if (!function_exists('_current_theme')) {
    function _current_theme(string $path = null): string
    {
        $authPath = _is_admin()? 'control_panel': 'front';
        return Str::lower($authPath . '.' . _theme_name() . '.' . $path);
    }
}

/*
|--------------------------------------------------------------------------
| Theme Name
|--------------------------------------------------------------------------
|
|
| @return name as @string
|
 */
if (!function_exists('_theme_name')) {
    function _theme_name(): string
    {
        $themeName = 'default';
        try {
            // get theme name from database or config file
            $module = _is_admin()? 'panel_theme': 'front_theme';
            $themeName = _settings('settings', $module);
        } catch (\Throwable $th) {
            throw $th;
        }

        return Str::replace(' ', '_', $themeName);
    }
}

/*
|--------------------------------------------------------------------------
| System Assets
|--------------------------------------------------------------------------
|
|
| @return path as @string
|
 */
if (!function_exists('_assets')) {
    function _assets(string $path = null, string $type = 'url'): string
    {
        $assets = "/assets". (_is_admin()? "/control_panel" : "/front") . "/" . _theme_name();
        if ($path != null) {
            $path = "/" . $path;
        }

        $assetsPath = $assets. $path;
        return ($type == "path")? Str::replace("/", _DS(), $assetsPath) : url($assetsPath);
    }
}

/*
|--------------------------------------------------------------------------
| System directory path
|--------------------------------------------------------------------------
|
| return path of directory for system.
|
 */
if (!function_exists('_system_path')) {
    function _system_path(string $dir = null)
    {
        $path =  ( _RD(). (Str::of(_RD())->isMatch('/'.basename(dirname(__DIR__, 3)).'/')) ? $dir : basename(dirname(__DIR__, 3)).'/'. $dir);
        return $path;
    }
};

/*
|--------------------------------------------------------------------------
| System upload directory path
|--------------------------------------------------------------------------
|
| return path of directory for upload.
|
 */
if (!function_exists('_upload_path')) {
    function _upload_path(string $type = null)
    {
        if(_is_tenant()){
            $host = request()->getHost();
            $explode = explode('.', $host);
            if(count($explode) >= 3 && $explode[1].'.'.$explode[2] == env('APP_NAME').'.'.env('APP_DOMAIN')){
                $folder = $explode[0];
            }else{
                $folder = Tenant::where('domain', $host)->first()->name;
            }

            $imagesPath = "uploads/tenants/{$folder}/";
        }else{
            $imagesPath = "uploads/images/";
        }

        return ($type == null)? _system_path($imagesPath) : url($imagesPath);
    }
};

/*
|--------------------------------------------------------------------------
| Get Image
|--------------------------------------------------------------------------
|
| return image or placeholder for it.
|
 */
if (!function_exists('_get_image')) {
    function _get_image(string $path = null, string $type = null)
    {
        // check if image file exist in current system
        if($path != null && _image_exists($path))
            return _upload_path('url').'/'.$path;

        // if file not found
        if($type == null ){
            // if no type defined return global placeholder image
            return url(_upload_path('url') . '/placeholders/global.png');
        }else{
            // if type is favicon return favicon from main folder
            if($type == 'favicon'){
                return url('uploads/images/' . $path);
            }

            if($type == 'message'){
                return url('uploads/images/' . $path);
            }

            // or return global placeholder foreach type
            return url(_upload_path('url') . "/placeholders/{$type}.png");
        }
    }
};

/*
|--------------------------------------------------------------------------
| Image exists
|--------------------------------------------------------------------------
|
| return true or false if image exists with path.
|
 */
if (!function_exists('_image_exists')) {
    function _image_exists($path = null)
    {
        $path = ($path) ?? 'example.coder';
        return file_exists(_upload_path() . $path);
    }
};

/*
|--------------------------------------------------------------------------
| Favicon
|--------------------------------------------------------------------------
|
| return favicon for system or generate new one from name.
|
 */
if (!function_exists('_favicon')) {
    function _favicon()
    {
        $icon = 'favicon.ico';

        if($icon != null && _image_exists($icon))
            return _get_image($icon);

        // if favicon not found generate one
        $data = [];
        if(!_image_exists($icon)){
            $data['text'] = Str::of(_settings('settings', 'name'))->substr(0, 1)->upper();
            $data['path'] = 'favicon.ico';
            $data['mode'] = 'light';
            $data['width'] = 64;
            $data['height'] = 64;
            $data['size'] = 50;
            $data['color'] = str_replace('_', ' ', _settings('settings', 'main_color'));
            $data['background'] = 'ffffff';
            $data['opacity'] = 127; // max is 127 for transparent
            $data['style'] = 'bold-4';
            _generateImage($data);
        }

        return _get_image('favicon.ico', 'favicon');
    }
};

/*
|--------------------------------------------------------------------------
| Logo
|--------------------------------------------------------------------------
|
| return logo for system or generate new one from name.
|
 */
if (!function_exists('_logo')) {
    function _logo($icon = null, $mode = null)
    {
        $name = implode(' ', Str::ucsplit(_settings('settings', 'name')));
        $text = ($icon != null)? Str::of($name)->substr(0, 1)->upper() : Str::of($name)->upper();
        $mode = ($mode == 'null' || $mode == null || $mode == 'light')? 'light' : 'dark';
        $logo = "logo/".$name .(($icon != null)? "_icon_" : "_logo_" ).$mode.".png";

        if($logo != null && _image_exists($logo))
            return _get_image($logo);

        // if logo not found generate one
        $data = [];
        if(!_image_exists($logo)){
            $data['text'] = $text;
            $data['path'] = $logo;
            $data['mode'] = $mode;
            $data['width'] = 240;
            $data['height'] = 28;
            $data['size'] = 25;
            $data['color'] = ($mode =='light')? str_replace('#', '', _settings('settings', 'logo_color')) : 'ffffff';
            $data['background'] = 'ffffff';
            $data['opacity'] = 127;
            $data['style'] = 'bold-4';
            _generateImage($data);
        }

        return _get_image($logo);
    }
};

/*
|--------------------------------------------------------------------------
| active menu li
|--------------------------------------------------------------------------
|
|
| @return boolean
|
 */
if (!function_exists('_theme_mode')) {
    function _theme_mode(string $mode)
    {
        session()->forget('theme-mode');
        session()->put('theme-mode', $mode);
    }
}

/*
|--------------------------------------------------------------------------
| Generate Avatar
|--------------------------------------------------------------------------
|
| generate avatar to User from name.
|
 */
// if (!function_exists('_generate_avatar')) {
//     function _generate_avatar($name)
//     {
//         $width = 100;
//         $height = 100;
//         // Create a new image
//         $im = imagecreate($width, $height);

//         // Set the background color of the image
//         $hex = '#'._settings('settings', 'main_color');
//         list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
//         $bg = imagecolorallocatealpha($im, $r, $g, $b, 0); // max for transparent is 127
//         imagefill($im, 0, 0, $bg);

//         // Create a new text object
//         // $font = getcwd(). _assets('fonts/Mooli-Regular.ttf', 'path');
//         $size = 60;
//         $color = imagecolorallocate($im, 255, 255, 255);

//         // Text
//         $text = Str::of($name)->substr(0, 1)->upper();

//         // Center text to image
//         $center = _center_text_to_image($width, $height, $size, $text);

//         // Add the text object to the image
//         // imagettftext($im, $size, 0, $center['x'], $center['y'], $color, $font, $text);
//         imagestring($im, $size, $center['x'], $center['y'], $text, $color);

//         // set image header
//         header('Content-Type: image/png');

//         // set path of image
//         $path = 'users/profile/'.$name.'.png';

//         // Save the image to a file
//         // imagepng($im, Str::substr(Str::replace( _DS(), '/', _images($path, 'path')), 1));
//         imagepng($im, _RD(_images($path, 'path')));

//         // Free up memory
//         imagedestroy($im);

//         return $path;
//     }
// };

/*
|--------------------------------------------------------------------------
| Generate Logo
|--------------------------------------------------------------------------
|
| generate logo to system from name.
|
 */
if (!function_exists('_generateImage')) {
    function _generateImage($data)
    {
        // Create a new image
        $im = imagecreate($data['width'], $data['height']);

        // set color of text
        $colorHex = str_split($data['color'], 2);

        // Set the background color of the image
        $backgroundHex = str_split($data['background'], 2);
        $bg = imagecolorallocatealpha($im, hexdec($backgroundHex[0]), hexdec($backgroundHex[1]), hexdec($backgroundHex[2]), $data['opacity']); // max for transparent is 127
        imagefill($im, 0, 0, $bg);

        // Create a new text object
        $font = getcwd(). _assets('fonts/Mooli-Regular.ttf', 'path');
        $color = imagecolorallocate($im, hexdec($colorHex[0]), hexdec($colorHex[1]), hexdec($colorHex[2]));

        // Text
        $text = $data['text'];

        // Center text to image
        $center = _center_text_to_image($data['width'], $data['height'], $data['size'], $font, $text);

        /**
         *  Add the text object to the image
         *
        */

        $style = (count(explode('-', $data['style'])) > 1)? explode('-', $data['style'])[0] : $data['style'];

        // this line if text line only
        if($style == 'bold'){
            // this lines to make text bold
            imagettftext($im, $data['size'], 0, $center['x'], $center['y'], $color, $font, $text);
            // imagettftext($im, $data['size'], 0, $center['x'], $center['y'], $color, $font, $text);

            $x = 0;
            for ($i=1; $i <= explode('-', $data['style'])[1]; $i++) {
                imagettftext($im, $data['size'], 0, $center['x'], $center['y']+$x, $color, $font, $text);
                $x = $x + 0.15;
            }

            $x = 0;
            for ($i=1; $i <= explode('-', $data['style'])[1]; $i++) {
                imagettftext($im, $data['size'], 0, $center['x']+$x, $center['y'], $color, $font, $text);
                $x = $x + 0.25;
            }
        }

        // set image header
        header('Content-Type: image/png');

        // Save the image to a file
        imagepng($im, _upload_path() . $data['path']);

        // $name = $data['path'];
        // $newName = str_replace('.png', '.webp', $data['path']);

        // $img = imagecreatefrompng(_upload_path() . $name);
        // imagepalettetotruecolor($img);
        // imagealphablending($img, true);
        // imagesavealpha($img, true);
        // imagewebp($img, _upload_path() . $newName, 100);

        // Free up memory
        imagedestroy($im);
        // imagedestroy($img);

        // return img path
        return $data['path'];
    }
};

/*
|--------------------------------------------------------------------------
| Center an image
|--------------------------------------------------------------------------
|
| center an image to system from name.
|
 */
if (!function_exists('_center_text_to_image')) {
    function _center_text_to_image($width, $height, $size, $font, $text)
    {
        // Calculate text width and height
        $textWidth = imagettfbbox($size, 0, $font, $text)[2] - imagettfbbox($size, 0, $font, $text)[0];
        $textHeight = imagettfbbox($size, 0, $font, $text)[1] - imagettfbbox($size, 0, $font, $text)[7];

        // Calculate position to center the text
        $x = ($width - $textWidth) / 2;
        $y = ($height - $textHeight) / 2 + $textHeight;

        return ['x' => $x, 'y' => $y];
    }
};
