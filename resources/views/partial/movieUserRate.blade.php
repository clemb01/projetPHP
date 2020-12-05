<?php
function checkValue($expected, $note){
    if($expected == $note)
        return "checked";
}
?>

<span style="font-size: 24px;">Noter: </span>
<form id="rateForm" class="align-top" style="display: inline-flex;" action="/movie/rate" method="post">
    <div class="rating-group">
        <input name="movieId" value="{{ $movieId }}" hidden>
        <input class="rating__input rating__input--none" name="rating" id="rating-0" value="0" type="radio" {{ checkValue(0, $note) }}>
        <label aria-label="0 stars" class="rating__label" for="rating-0">&nbsp;</label>
        <label aria-label="0.5 stars" class="rating__label rating__label--half" for="rating-05"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
        <input class="rating__input" name="rating" id="rating-05" value="0.5" type="radio" {{ checkValue(0.5, $note) }}>
        <label aria-label="1 star" class="rating__label" for="rating-10"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
        <input class="rating__input" name="rating" id="rating-10" value="1" type="radio" {{ checkValue(1, $note) }}>
        <label aria-label="1.5 stars" class="rating__label rating__label--half" for="rating-15"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
        <input class="rating__input" name="rating" id="rating-15" value="1.5" type="radio" {{ checkValue(1.5, $note) }}>
        <label aria-label="2 stars" class="rating__label" for="rating-20"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
        <input class="rating__input" name="rating" id="rating-20" value="2" type="radio" {{ checkValue(2, $note) }}>
        <label aria-label="2.5 stars" class="rating__label rating__label--half" for="rating-25"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
        <input class="rating__input" name="rating" id="rating-25" value="2.5" type="radio" {{ checkValue(2.5, $note) }}>
        <label aria-label="3 stars" class="rating__label" for="rating-30"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
        <input class="rating__input" name="rating" id="rating-30" value="3" type="radio" {{ checkValue(3, $note) }}>
        <label aria-label="3.5 stars" class="rating__label rating__label--half" for="rating-35"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
        <input class="rating__input" name="rating" id="rating-35" value="3.5" type="radio" {{ checkValue(3.5, $note) }}>
        <label aria-label="4 stars" class="rating__label" for="rating-40"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
        <input class="rating__input" name="rating" id="rating-40" value="4" type="radio" {{ checkValue(4, $note) }}>
        <label aria-label="4.5 stars" class="rating__label rating__label--half" for="rating-45"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
        <input class="rating__input" name="rating" id="rating-45" value="4.5" type="radio" {{ checkValue(4.5, $note) }}>
        <label aria-label="5 stars" class="rating__label" for="rating-50"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
        <input class="rating__input" name="rating" id="rating-50" value="5" type="radio" {{ checkValue(5, $note) }}>
    </div>
</form>