<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    /**
     * @param $code
     * @param $message
     * @param $data
     * @param array $error
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function response($code, $message, $data, array $error = [], int $statusCode = 200)
    {
        $responseData = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
            'errors' => $error
        ];

        return response()->json($responseData, $statusCode);
    }

    /**
     * A not found error with an optional message as the first parameter.
     * @param $message
     * @return JsonResponse
     */
    protected function errorNotFound($message): JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * A bad request error with an optional message as the first parameter.
     * @param $message
     * @param $errors
     * @return JsonResponse
     */

    /**
     * @OA\Schema(
     *     schema="BadRequestResource",
     *     @OA\Property(property="message", type="string"),
     *     @OA\Property(property="errors", type="array", @OA\Items())
     * )
     */
    protected function errorBadRequest($message, $errors): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'errors' => $errors
        ], JsonResponse::HTTP_BAD_REQUEST);
    }

    /**
     * An internal error with an optional message as the first parameter.
     * @param $message
     * @return JsonResponse
     */
    protected function errorInternal($message): JsonResponse
    {
        return response()->json([
            'message' => $message ?: 'Internal server error'
        ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * An unauthorized error with an optional message as the first parameter.
     * @param $message
     * @return JsonResponse
     */
    protected function errorUnauthorized($message, $code): JsonResponse
    {
        return response()->json([
            'message' => $message ?: 'Not Authorized',
            'code' => $code
        ], JsonResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * Create object successful
     * @param $message
     * @param $data
     * @return JsonResponse
     */
    public function created($message, $data): JsonResponse
    {
        return response()->json([
            'message' => $message ?: 'Save successful.',
            'data' => $data
        ], JsonResponse::HTTP_CREATED);
    }

    /**
     * Update object successful
     * @param $message
     * @param $data
     * @return JsonResponse
     */
    public function updated($message, $data = null): JsonResponse
    {
        $responseData = ['message' => $message ?: 'Save successful'];
        if($responseData) $responseData['data'] = $data;

        return response()->json($responseData, JsonResponse::HTTP_OK);
    }

    /**
     * Delete successful
     * @param $message
     * @return JsonResponse
     */
    public function deleted($message): JsonResponse
    {
        return response()->json([
            'message' => $message ?: 'Delete successful.',
        ], JsonResponse::HTTP_OK);
    }

    /**
     * Response successful with or without data and messages
     * @param $data
     * @param $message
     * @return JsonResponse
     */
    public function successfulResponse($data, $message = null): JsonResponse
    {
        $response = [];
        if($data) $response['data'] = $data;
        if($message) $response['message'] = $message;

        return response()->json($response, JsonResponse::HTTP_OK);
    }

    /**
     * Response successful with pagination data
     * @param $collection
     * @param $message
     * @return JsonResponse
     */
    protected function paginationResponse($collection, $message = null): JsonResponse
    {
        return $this->successfulResponse($collection, $message);
    }

    /**
     * @param $message
     * @param $data
     * @return JsonResponse
     */
    protected function responseInputList($message, $data): JsonResponse
    {
        $response['message'] = $message ?? '';
        $response['data'] = $data ?? [];

        return response()->json($response, JsonResponse::HTTP_OK);
    }
}
