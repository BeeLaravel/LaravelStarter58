<?php
namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {
    protected $dontReport = [
    ];
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];
    public function report(Exception $exception) {
        if ( $this->shouldReport($exception) ) \Encore\Admin\Reporter\Reporter::report($exception);

        // parent::report($exception);
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
