<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    protected const HTTP_OK = 200;
    protected const HTTP_INTERNAL_SERVER_ERROR = 500;

    // Default status code for responses
    protected int $statusCode = self::HTTP_OK;

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return $this
     */
    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param array $data
     * @param array $headers
     * @return JsonResponse
     */
    protected function respond(array $data, array $headers = []): JsonResponse
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param mixed $data
     * @param string|null $message
     * @param int $status_code
     * @return JsonResponse
     */
    protected function respondData(mixed $data, string $message = null, int $status_code = self::HTTP_OK): JsonResponse
    {
        return $this->setStatusCode($status_code)
            ->respond([
                'status' => true,
                'code' => $status_code,
                'message' => $message,
                'data' => $data,
                'errors' => []
            ]);
    }

    /**
     * @param $items
     * @param string|null $message
     * @param int $status_code
     * @return JsonResponse
     */
    protected function respondWithPagination($items, string $message = null, int $status_code = self::HTTP_OK): JsonResponse
    {
        return $this->setStatusCode($status_code)->respond([
            'status' => true,
            'code' => $status_code,
            'message' => $message,
            'data' => $items->items(),
            'paginator' => [
                'total_count' => $items->total(),
                'total_pages' => $items->lastPage(),
                'current_page' => $items->currentPage(),
                'per_page' => $items->perPage(),
            ]
        ]);
    }

    /**
     * @param string|null $message
     * @param int $status_code
     * @return JsonResponse
     */
    protected function respondMessage(string $message = null, int $status_code = self::HTTP_OK): JsonResponse
    {
        return $this->setStatusCode($status_code)
            ->respond([
                'status' => true,
                'code' => $status_code,
                'message' => $message,
                'data' => null,
                'errors' => []
            ]);
    }

    /**
     * @param string|null $message
     * @param int $status_code
     * @return JsonResponse
     */
    protected function respondError(string $message = null, int $status_code = self::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return $this->setStatusCode($status_code)
            ->respond([
                'status' => false,
                'code' => $status_code,
                'message' => $message,
                'data' => null,
                'errors' => []
            ]);
    }

    /**
     * @param string|null $message
     * @param array $errors
     * @param int $status_code
     * @return JsonResponse
     */
    protected function respondValidationErrors(string $message = null, array $errors, int $status_code = self::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return $this->setStatusCode($status_code)
            ->respond([
                'status' => false,
                'code' => $status_code,
                'message' => $message,
                'data' => null,
                'errors' => $errors
            ]);
    }
}
