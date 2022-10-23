<?php
if (!function_exists('uploadImg')) {
    function mergeAvatarToRequest($request)
    {
        if ($request->has("upload_file")) {
            $file_name = $request->session()->pull('create_avatar');
            $request->merge(['avatar' => $file_name]);
        } else {
            $request->merge(['avatar' => $request['avatar']]);
        }
        return $request;
    }

}
