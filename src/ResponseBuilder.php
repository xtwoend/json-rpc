<?php

namespace Xtwoend\JsonRpc;

use Psr\Http\Message\ServerRequestInterface;
use Hyperf\JsonRpc\ResponseBuilder as BaseResponseBuilder;


class ResponseBuilder extends BaseResponseBuilder
{
    protected function formatErrorResponse(ServerRequestInterface $request, int $code, \Throwable $error = null): string
    {
        [$code, $message] = $this->error($code, $error ? $error->getMessage() : null);
        
        $code = $error ? $error->getCode() : $code;

        $response = $this->dataFormatter->formatErrorResponse([$request->getAttribute('request_id'), $code, $message, $error]);

        return $this->packer->pack($response);
    }
}