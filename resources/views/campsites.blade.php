<div class="flex wrap centering">
    @foreach ($campings as $camping)
        <campsite :camping="{{$camping}}" :review="{{round($camping->avgReview(), 1)}}"></campsite>
    @endforeach
</div>
