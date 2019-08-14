<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }
    public function render($request, Exception $exception) {
        // return parent::render($request, $exception);

        if ( config('app.debug') ) return parent::render($request, $exception); // 测试环境正常输出错误信息

        $output = new Controller;

        if ( $exception instanceof RequestException ) return $output->badRequestError($exception->getMessage()); // 请求参数错误
        if ( $exception instanceof ModelNotFoundException ) return $output->noDataError(); // 模型数据 查询错误
        if ( $exception instanceof NotFoundHttpException ) return $output->notFoundError(); // 404 页面跳转
        if ( $exception instanceof AuthException ) return $output->invalidTokenError(); // 身份认证失败
        if ( $exception instanceof SignException ) return $output->invalidSignError(); // sign 效验失败

        return $output->internalServerError();
    }
}
