<?php
namespace App\Validator;

use App\Repository\QAQuestionRepository;
use App\Repository\QAReviewRepository;
use App\Repository\ShipmentRepository;
use Valitron\Validator;

class QAReviewRequestValidator implements ValidatorInterface
{
    private $validator;
    private $reviewRepository;
    private $questionRepository;
    private $shipmentRepository;

    private $failed;
    public function __construct(
        QAReviewRepository $reviewRepository,
        ShipmentRepository $shipmentRepository,
        QAQuestionRepository $questionRepository
    ) {
        $this->reviewRepository = $reviewRepository;
        $this->shipmentRepository = $shipmentRepository;
        $this->questionRepository = $questionRepository;
    }
    public function validate($data)
    {

        $v = new Validator($data);
        // SHIPMENT VALIDATION
        $v->rule('required', 'shipmentId');
        $v->rule(function ($field, $value, $params, $fields) {
            $exists = $this->shipmentRepository->exists($value);
            return $exists;
        }, 'shipmentId')->message("No existe este número de envío.");
        $v->rule(function ($field, $value, $params, $fields) {
            $exists = $this->reviewRepository->existsForShipment($value);
            return !$exists;
        }, 'shipmentId')->message("Ya se ha realizado una valoración para este envío.");

        // ANSWER VALIDATION
        $v->rule('required', 'answers.*.questionId');
        $v->rule(function ($field, $value, $params, $fields) {
            $question = $this->questionRepository->find(intval($value));

            return $this->answerIsValid($question, $fields);
        }, 'answers.*.questionId')->message("Formato de respuesta inválida.");
        // ANSWERs
        $v->rule('required', 'answers');
        $v->rule(function ($field, $value, $params, $fields) {
            $questionIds = [];
            foreach ($fields['answers'] as $ans) {
                if (array_search($ans['questionId'], $questionIds) === false) {
                    $questionIds[] = $ans['questionId'];
                    continue;
                }
                return false;
            }

            return true;
        }, 'answers')->message("Respuesta repetida para una misma pregunta.");

        $this->failed = !$v->validate();
        $this->validator = $v;
    }
    private function answerIsValid($question, $review)
    {
        foreach ($review['answers'] as $i => $ans) {
            if (intval($ans['questionId']) === $question->getId()) {
                $hasComment = isset($ans['comment']) && count(trim($ans['comment'])) > 0;
                $hasRating = isset($ans['rating']) && is_numeric($ans['rating']);

                if ($question->getEnableComment() && !$hasComment) {
                    return false;
                }

                if ($question->getEnableRating() && !$hasRating) {
                    return false;
                }

                break;
            }
        }
        return true;
    }
    public function fails(): bool
    {
        return $this->failed;
    }

    public function errors(): ?array
    {
        return $this->validator->errors();
    }

}
