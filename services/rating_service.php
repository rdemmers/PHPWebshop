<?php

require_once(MODEL . "rating_dao.php");
require_once(MODEL . "single_rating.php");

class RatingService {

    private $ratingDao;

    function __construct(RatingDao $ratingDao) {
        $this->ratingDao = $ratingDao;
    }

    function getRating($id) {

        return $this->ratingDao->get($id);
    }

    function getNumberVotes($id) {
        return $this->ratingDao->getNumberVotes($id);
    }

    function hasUserVoted($singleRating) {
        try {
            Assert::isUserLoggedIn();
            Assert::isInstanceOf($singleRating, "SingleRating");


            return $this->ratingDao->hasUserVoted($singleRating);
        } catch (Exception $e) {
            Logger::_error($e);
            // When something goes wrong, we want the system to assume the user
            // already voted.
            return true;
        }
    }

    function castVote($singleRating) {
        try {
            Assert::isInstanceOf($singleRating, "SingleRating");

            $rating = $singleRating->getRating();
            if ($rating > 5 || $rating < 0) {
                return false;
            }
            if (!$this->hasUserVoted($singleRating)) {
                return $this->ratingDao->add($singleRating);
            } else {
                return false;
            }
        } catch (Exception $e) {
            Logger::_error($e);
            http_response_code(500);
            echo "Please log in before trying to submit a rating";
            return false;
        }
    }

    function deleteVote($id) {
        try {
            Assert::isNumeric($id);

            return $this->ratingDao->delete($id);
        } catch (InvalidArgumentException $e) {
            Logger::_error($e);
            return false;
        }
    }

    function fetchProductRatingJson($id) {
        $numberVotes = $this->getNumberVotes($id);
        $ratingFloat = $this->getRating($id);

        $rating = new TotalRating($id, $numberVotes, $ratingFloat);

        return json_encode((array) $rating);
    }

}
