<?php

class TotalRating {

    // public for JSON conversion
    public $productId;
    public $numberVotes;
    public $rating;
    public $ratingRound;

    function __construct($productId, $numberVotes, $ratingFloat) {
        $this->productId   = $productId;
        $this->numberVotes = $numberVotes;
        $this->rating      = round($ratingFloat, 1);
        $this->ratingRound = round($ratingFloat);
    }

}
