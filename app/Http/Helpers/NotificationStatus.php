<?php

namespace App\Http\Helpers;

class NotificationStatus
{
    public static function notifSuccess($status = true, $message, $data, $codeStatus)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $codeStatus);
    }

    public static function notifError($status, $message, $data = null, $codeStatus)
    {
        return response()->json([
            'status' => $status,  // 404, 400, 500
            'message' => $message,
            'data' => $data
        ], $codeStatus);
    }
    public static function notifValidator($status, $message, $errors)
    {
        return response()->json([
            'status' => $status,  // 404, 400, 500
            'message' => $message,
            'errors' => $errors
        ], 422);
    }


}
