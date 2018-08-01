<?php

require_once(MODEL . 'total_rating.php');
require_once(MODEL . 'single_rating.php');
require_once(CONTROLLER . "i_controller.php");

class AjaxController implements iController {

    private $ratingService;

    public function __construct(RatingService $ratingService) {
        $this->ratingService = $ratingService;
    }

    function handle() {
        switch (filter_input(INPUT_POST, 'subtype')) {
            case "fetchRating":
                $id = filter_input(INPUT_POST, 'productId');
                echo $this->ratingService->fetchProductRatingJson($id);
                break;
            case "submitRating":
                $this->handleSubmitRating();
                break;
        }
    }

    private function handleSubmitRating() {
        try {
            Assert::isUserLoggedIn();

            $rating    = filter_input(INPUT_POST, 'TotalRating');
            $productId = filter_input(INPUT_POST, 'productId');

            $rating = new SingleRating(null, $_SESSION['user']->getId(), $productId, $rating);

            $this->ratingService->castVote($rating);
        } catch (Exception $e) {
            Logger::_error($e);
            http_response_code(500);
            echo "Please log in before trying to submit a rating";
        }
    }

}
