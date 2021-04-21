@extends ('layout')

@section('content')
    <div class="more-container">
        <div class="more-content flex">
            <div class="more-container-img p-20 flex centering">
                <img src="../storage/{{$camping->images[0]->img_path}}" width="400px" alt="logo">
            </div>
            <div class="more-paragraph">
                <div class="more-container-heading flex">
                    <div class="p-20">
                        <h2 class="heading-color alt-text-color">{{$camping->name}}</h2>
                        <div class="mb-20"> 
                            @if ($camping->avgReview()) 
                            <span class="main-text-color">Review: {{round($camping->avgReview(),1)}}</span>
                             @else
                            <span class="main-text-color">No Reviews yet</span>
                            @endif
                        </div>
                        <div class="mb-20">
                            <span class="heading-color">Our Rating:</span>
                            @for ($i = 0; $i < $camping->rating; $i++)
                            <i class="far fa-star main-text-color font-sm"></i>
                            @endfor
                        </div>
                        <div class="mb-20">
                            @foreach($camping->tags as $tag)
                                @switch($tag->id)
                                    @case(1)
                                        <i class="fas fa-wifi"></i>
                                        @break
                                    @case(2)
                                        <i class="fas fa-swimmer"></i>
                                        @break
                                    @case(3)
                                        <i class="fas fa-parking"></i>
                                        @break
                                @endswitch
                            @endforeach
                        </div>
                        <div>
                            <a class="main-text-color p-0" href="https://{{$camping->website}}" target="_blank">Visit Us</a>
                        </div>
                    </div>
                    <rating-component v-bind:camp="{{$camping->id}}"></rating-component>
                </div>
                <p class="font-lg heading-color">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatem, in placeat veritatis eius labore molestias, 
                    possimus voluptas ex soluta nihil iste illo sunt harum, perferendis quis praesentium et. Nemo, atque? Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
                    Cupiditate voluptate eveniet quo iure neque similique vitae, deleniti explicabo architecto ipsa! Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab nobis culpa non, a dolor dolorum alias eaque nihil atque autem ratione adipisci id accusamus vel earum nulla molestias voluptatibus repellat laboriosam similique quisquam dolore numquam aliquam! Quod, hic praesentium.
                </p>
            </div>
        </div>
        <h2 class="alt-text-color">Photos of {{$camping->name}} camping<h2>
        <div class="more-pics-container flex wrap">
            @foreach($camping->images as $image)
                <div class="flex centering more-pics-wrapper">
                    <img src="../storage/{{$image->img_path}}" alt="camping image" width="200px" height="180px">
                </div>
            @endforeach
        </div>
    </div>
@endsection