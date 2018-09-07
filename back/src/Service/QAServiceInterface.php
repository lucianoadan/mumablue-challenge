<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

interface QAServiceInterface {
    /**
     * Receive a review
     */
    public function doReview(Request $request): JsonResponse;
    /**
     * List reviews
     */
    public function getReviews(Request $request) : JsonResponse;
    /**
     * Get review by id
     */
    public function getReview($id, Request $request) : JsonResponse;
    
}