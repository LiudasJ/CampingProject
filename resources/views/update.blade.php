@extends ('layout')

@section('content')
    <campingform-component :camp="{{$campsite}}" :tags="{{$tags}}"></campingform-component>
@endsection