@extends ('layout')

@section('content')

    <div class="more-container">
        <div class="more-container-image flex">
            <div class="p-20">
                <img src="{{$camping->img_path}}" width="400px" alt="logo">
            </div>
            <div class="more-container-heading flex">
                <div class="p-20">
                    <h2 class="heading-color">{{$camping->name}}</h2>
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
                    <div>
                        <a class="main-text-color" href="https://{{$camping->website}}" target="_blank">Visit Us</a>
                    </div>
                </div>
                <rating-component v-bind:camp="{{$camping->id}}"></rating-component>
            </div>
        </div>
        <div class="more-paragraph">
            <p class="font-lg heading-color">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatem, in placeat veritatis eius labore molestias, 
                possimus voluptas ex soluta nihil iste illo sunt harum, perferendis quis praesentium et. Nemo, atque? Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
                Cupiditate voluptate eveniet quo iure neque similique vitae, deleniti explicabo architecto ipsa! Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto ab nobis culpa non, a dolor dolorum alias eaque nihil atque autem ratione adipisci id accusamus vel earum nulla molestias voluptatibus repellat laboriosam similique quisquam dolore numquam aliquam! Quod, hic praesentium.
            </p>
        </div>
    </div>

@endsection