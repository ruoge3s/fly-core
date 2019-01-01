<?php
namespace core\traits;

trait Message
{
    /**
     * @param string $message
     * @param null $data
     * @return array
     */
    public static function success($message='success', $data=null)
    {
        return self::info($code=0, $message, $data);
    }

    /**
     * @param int $code
     * @param string $message
     * @return array
     */
    public static function error($code=-1, $message='failure')
    {
        return self::info($code, $message);
    }

    /**
     * @param $code
     * @param $message
     * @param null $data
     * @return array
     */
    public static function info($code, $message, $data=null)
    {
        $info =  ['code'  => $code, 'msg'   => $message];
        $data !== null && $info['data'] = $data;
        return $info;
    }
}