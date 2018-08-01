$('.ratings_stars').hover(
        function () {
            $(this).prevAll().addBack().addClass('ratings_over');
            $(this).nextAll().removeClass('ratings_vote');
        },
        function () {
            $(this).prevAll().addBack().removeClass('ratings_over');
            setVotes($(this).parent());
        }

);

$('.rating_component').each(function (i) {
    var widget = this;

    var out_data = {
        productId: $(widget).attr('id'),
        type: "AJAX",
        subtype: "fetchRating"
    };
    $.post(
            'index.php',
            out_data,
            function (INFO) {
                $(widget).data('rating', INFO);
                setVotes(widget);
            },
            'json'
            );
});

function setVotes(widget) {
    var ratingRound = $(widget).data('rating').ratingRound;
    var numberVotes = $(widget).data('rating').numberVotes;
    var rating = $(widget).data('rating').rating;

    $(widget).find('.rate_' + ratingRound).prevAll().addBack().addClass('ratings_vote');
    $(widget).find('.rate_' + ratingRound).nextAll().removeClass('ratings_vote');
    $(widget).find('.total_votes').text(numberVotes + ' keer beoordeeld (' + rating + ' rating)');
}

$('.ratings_stars').bind('click', function () {
    var star = this;
    var widget = $(this).parent();

    var clicked_data = {
        type: "AJAX",
        subtype: "submitRating",
        rating: $(star).attr('data-rd-vote'),
        productId: widget.attr('id')
    };
    $.post(
            'index.php',
            clicked_data,
            function (INFO) {
                widget.data('rating', INFO);
                set_votes(widget);
            },
            'json'
            );
});