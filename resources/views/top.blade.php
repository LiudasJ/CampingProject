@extends ('layout')

@section ('content')

<section>
    <div class="section-heading flex flex-col centering">
        <i class="fas fa-star"></i>
        <h2>Our Top Rated Campings</h2>
    </div>
    <div>
        @include('campsites')
    </div>
</section>  

@endsection