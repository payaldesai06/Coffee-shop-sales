<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseHTTP;
use Illuminate\Support\Str;


trait ApiResponser
{
    /**
     * Default is (200).
     *
     * @var int
     */
    protected $statusCode = ResponseHTTP::HTTP_OK;
    /**
     * @var array
     */
    protected $headers = [];

    /**
     * Gets header data
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Sets header data
     *
     * @param array $headers
     *
     * @return $this
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * Gets status code
     *
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Sets status code
     *
     * @param mixed $statusCode
     *
     * @return mixed
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * Responds with JSON, status code and headers.
     *
     * @param array $data
     *
     * @return JsonResponse
     */
    public function respond(array $data)
    {
        return new JsonResponse($data, $this->getStatusCode(), $this->getHeaders());
    }

    /**
     *  create API structure.
     *
     * @param boolean $success
     * @param null $payload
     * @param string $message
     * @param null $debug
     *
     * @return object
     */
    public function getResponseStructure($success = false, $payload = null, $message = '', $otherParam = array(), $debug = null)
    {
        $requestId = Str::uuid()->toString();
        if (isset($debug)) {
            $data = ['result' => $success, 'requestId' => $requestId, 'message' => $message, 'messageLBL' => $otherParam['messageLBL'] ?? null, 'payload' => $payload, 'debug' => $debug];
        } else {
            $data = ['result' => $success, 'requestId' => $requestId, 'message' => $message, 'messageLBL' => $otherParam['messageLBL'] ?? null, 'payload' => $payload];
        }

        if (config('constants.api_log_enabled')) {
            $api_log = array();
            $api_log['request_id'] = $requestId;
            $api_log['request_body'] = $this->formatLogRequest($_POST, 'request_body');
            $api_log['request_header'] = $this->formatLogRequest($_SERVER, 'request_header');
            $api_log['response'] = json_encode($data);
            $api_log['remote_address'] = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
            $api_log['request_port'] = $_SERVER['REMOTE_PORT'];
            $api_log['request_method'] = $_SERVER['REQUEST_METHOD'];
            $api_log['redirect_url'] = request()->getRequestUri();
            $api_log['http_user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        }

        return $data;
    }

    /**
     * Responds with data
     *
     * @param mixed $data
     *
     * @return JsonResponse
     */
    public function respondWithData($data)
    {
//            return [$data];
        $responseData = $this->getResponseStructure(true,  $data, '', []);
//            return $responseData;
        $response = new JsonResponse($responseData, $this->getStatusCode(), $this->getHeaders());
        return $response;
    }


    /**
     * Use this to respond with a message (200).
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    public function respondOk($message = "Ok", $otherParam = array())
    {
        return $this->setStatusCode(ResponseHTTP::HTTP_OK)->respondWithMessage($message, $otherParam);
    }

    /**
     * Use this for responding with messages.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    public function respondWithMessage($message = "Ok", $otherParam = array())
    {
        $data = $this->getResponseStructure(true, null, $message, $otherParam);
        return $this->respond($data);
    }

    /**
     * Use this for general server errors (500).
     *
     * @param string $message
     *
     * @return mixed
     */
    public function respondInternalError($message, $otherParam = array(), $e)
    {
        $message = $message ?: "Internal Error";
        return $this->setStatusCode(ResponseHTTP::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message, $otherParam, $e);
    }

    /**
     * Responds with error
     *
     * @param string $message
     * @param null $e
     * @param null $data
     *
     * @return JsonResponse|null
     */
    public function respondWithError($message = "Error", $otherParam = array(), $e = null, $data = null)
    {
        $response = null;
        if (\App::environment('local', 'staging') && isset($e)) {
            $debug_message = $e;
            $data = $this->getResponseStructure(false, $data, $message, $otherParam, $debug_message);
        } else {
            $data = $this->getResponseStructure(false, $data, $message, $otherParam);
        }
        $response = $this->respond($data);
        return $response;
    }
}
