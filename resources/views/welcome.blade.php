@extends ('layout')

@section ('content')
    <h2 class="main-text-color">Available campings</h2>
    <div class="welcome-container relative flex centering">
        <div class="carousel-controls prev absolute flex centering">
            <i id="prev" class="fas fa-arrow-circle-left"></i>
        </div>
        <div class="carousel-controls next absolute flex centering">
            <i id="next" class="fas fa-arrow-circle-right"></i>
        </div>
        <div class="carousel-container flex relative">
            <div class="relative cards-container flex">
                @foreach($campings as $camping)
                    <div class="welcome-camp-card">
                        <div class="welcome-camp-card-img">
                            @if(count($camping->images) > 0)
                                <img src="../storage/{{$camping->images[0]->img_path}}" width="100px" alt="name">
                            @else
                                <img src="https://media.timeout.com/images/105658195/image.jpg" width="100px" alt="name">
                            @endif
                        </div>
                        <h2 class="font-lg heading-color">{{$camping->name}}</h2>
                        <div class="flex flex-col mb-10">
                            <span class="font-sm">{{$camping->city}}</span>
                            <span class="font-sm">{{$camping->country}}</span>
                        </div>
                        <div class="mb-10">
                            @for ($i = 0; $i < $camping->rating; $i++)
                                <i class="far fa-star main-text-color font-sm"></i>
                            @endfor
                        </div>
                        <a class="font-sm text-center heading-color" href="/campings/{{$camping->id}}">Read more</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
