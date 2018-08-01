<?php

class StarRating {

    function __construct($product_id) {
        $this->renderHtml($product_id);
    }

    function renderHtml($product_id) {
        echo '<div class="product_choice">';
        echo "<div id='{$product_id}' class='rating_component'>";
        for ($i = 1; $i < 6; $i++) {
            echo "<div class='rate_{$i} ratings_stars' data-rd-vote='{$i}'></div>";
        }
        echo '<div class="total_votes">vote data</div>
                </div>
                </div>';
    }

}
