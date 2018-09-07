<?php

namespace App\Controller\Api;

use App\Service\QAServiceInterface;
use FOS\RestBundle\Controller\Annotations as Rest;use Symfony\Component\HttpFoundation\Request;

class QAController extends ApiController
{
    /**
     * Creates an review
     * @Rest\Put("/reviews")
     * @param Request $request
     * @return QAServiceInterface $qaServiceInterface
     */
    public function doReview(Request $request, QAServiceInterface $qaServiceInterface)
    {
        return $qaServiceInterface->doReview($request);
    }

    /**
     * List reviews
     * @Rest\Get("/reviews")
     * @param Request $request
     * @return QAServiceInterface $qaServiceInterface
     */
    public function getReviews(Request $request, QAServiceInterface $qaServiceInterface)
    {
        return $qaServiceInterface->getReviews($request);
    }

    /**
     * List reviews
     * @Rest\Get("/reviews/{id}")
     * @param Request $request
     * @return QAServiceInterface $qaServiceInterface
     */
    public function getReview(Request $request, QAServiceInterface $qaServiceInterface)
    {
        return $qaServiceInterface->getReview($id, $request);
    }

    /**
     * List questions
     * @Rest\Get("/questions")
     * @param Request $request
     * @return QAServiceInterface $qaServiceInterface
     */
    public function getQuestions(Request $request, QAServiceInterface $qaServiceInterface)
    {
        return $qaServiceInterface->getQuestions($request);
    }
}
