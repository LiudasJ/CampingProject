@extends('layout')

@section('content')

<section>
    <div class="section-heading flex flex-col centering">
        <i class="fas fa-star"></i>
        <h2>Our Latest Campings</h2>
    </div>
    <div>
        @include('campsites')
    </div>
</section>  

@endsection