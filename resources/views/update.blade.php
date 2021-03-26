@extends ('layout')

@section('content')
    <campingform-component v-bind:camp='{{$campsite}}' v-bind:tags='{{$tags}}' action="edit"></campingform-component>
@endsection