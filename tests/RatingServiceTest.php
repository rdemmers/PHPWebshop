<?php

session_start();

use PHPUnit\Framework\TestCase;

include_once("pdo_connector_testing.php");
include_once ("crud.php");

class RatingServiceTest extends TestCase {

    private $service;

    function setUp() {

        $crud          = Crud::getCrud();
        $dao           = new RatingDao($crud);
        $this->service = new RatingService($dao);
    }

    public function testCastVote() {
        $_SESSION["user"] = new User(99, "test@test.test", "mijn naam");
        $singleRating     = new SingleRating(null, 99, 1, 5);
        $id               = $this->service->castVote($singleRating);
        $this->assertTrue(is_numeric($id));
        return $id;
    }

    public function testGetRating() {
        $rating = $this->service->getRating(1);

        $this->assertTrue($rating == 5);
    }

    public function testGetNumberVotes() {
        $numberVotes = $this->service->getNumberVotes(1);

        $this->assertTrue($numberVotes == 1);
    }

    /**
     * @depends testCastVote
     */
    public function testDelete($id) {

        $result = $this->service->deleteVote($id);

        $this->assertTrue($result == 1);
    }

}
