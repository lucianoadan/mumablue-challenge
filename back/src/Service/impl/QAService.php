<?php

namespace App\Service\impl;

use App\Entity\QAReview;
use App\Entity\QAReviewAnswer;
use App\Repository\QAQuestionRepository;
use App\Repository\QAReviewAnswerRepository;
use App\Repository\QAReviewRepository;
use App\Repository\ShipmentRepository;
use App\Service\QAServiceInterface;
use App\Utils\Api\ApiResponse;
use App\Validator\QAReviewRequestValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class QAService implements QAServiceInterface
{

    private $reviewRepository;
    private $answerRepository;
    private $questionRepository;
    private $shipmentRepository;

    public function __construct(
        QAReviewRepository $reviewRepository,
        QAReviewAnswerRepository $answerRepository,
        QAQuestionRepository $questionRepository,
        ShipmentRepository $shipmentRepository
    ) {

        $this->reviewRepository = $reviewRepository;
        $this->answerRepository = $answerRepository;
        $this->questionRepository = $questionRepository;
        $this->shipmentRepository = $shipmentRepository;
    }
    /**
     * Create a review
     */
    public function doReview(Request $request): JsonResponse
    {

        $response = new ApiResponse();
        $validator = new QAReviewRequestValidator($this->reviewRepository, $this->shipmentRepository, $this->questionRepository);

        $data = $request->request->all();
        $validator->validate($data);

        if ($validator->fails()) {
            $errors = $validator->errors();

            $response->setErrors($errors);
            // Especial error
            if (isset($errors['shipmentId'])) {
                $errorMsg = $errors['shipmentId'][0];
            } else {
                $errorMsg = 'Solicitud incorrecta. Revisa el formulario.';
            }
            $response->setMessage($errorMsg);
            $response->setHttpStatus(Response::HTTP_BAD_REQUEST);
            return $response->getJsonResponse();
        }

        // Create review
        $shipmentId = intval($data['shipmentId']);
        $shipment = $this->shipmentRepository->find($shipmentId);
        $review = new QAReview();
        $review->setShipment($shipment);
        foreach ($data['answers'] as $key => $a) {
            $answer = new QAReviewAnswer();
            $question = $this->questionRepository->find(intval($a['questionId']));
            $answer->setQuestion($question);
            $answer->setReview($review);
            if (isset($a['rating']) && $question->getEnableRating()) {
                $answer->setRating(intval($a['rating']));
            }
            if (isset($a['comment']) && $question->getEnableComment()) {
                $answer->setComment($a['comment']);
            }
            $review->addAnswer($answer);
        }

        try {
            $this->reviewRepository->create($review);
            $response->setPayload($review);
            $response->setHttpStatus(Response::HTTP_CREATED);
        } catch (Exception $ex) {
            $response->setHttpStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
            var_dump($ex->getMessage());
            $response->setMessageWithError('Unexpected error. Consult log for details.');

        }

        return $response->getJsonResponse();
    }

    /**
     * Get reviews
     */
    public function getReviews(Request $request): JsonResponse
    {
        $response = new ApiResponse();

        $reviews = $this->reviewRepository->findAll();
        $response->setPayload($reviews);

        return $response->getJsonResponse();
    }
    /**
     * Get review by id
     */
    public function getReview($id, Request $request): JsonResponse
    {
        $response = new ApiResponse();

        $review = $this->reviewRepository->find(intval($id));
        $response->setPayload($review);

        return $response->getJsonResponse();
    }

    /**
     * Receive questions to make the quiz
     */
    public function getQuestions(Request $request): JsonResponse
    {
        $response = new ApiResponse();

        $questions = $this->questionRepository->findAll();
        $response->setPayload($questions);

        return $response->getJsonResponse();
    }

}
