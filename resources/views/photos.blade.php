@extends('layout')

@section('content')
    <div class="img-upload-container">
        <h2>Choose camping:</h2>
        @if ($errors->all())
            @foreach ($errors->all() as $error)
                <span class="text-danger">{{$error}}</span><br>
            @endforeach
        @endif
        <form method="POST" action="{{ route('admin.addphoto') }}" enctype="multipart/form-data">
            <select class="mb-20" name="campId">
            @foreach($campings as $index => $camping)
                <option value="{{$camping->id}}">{{$camping->name}}</option>
            @endforeach
            </select>
            @csrf
            <div>
                <span class="alt-text-color font-bold">Pick an image</span>
                @if (Session::has('success'))
                    <span class="text-success">{{Session::get('success')}}</span>
                @endif
                <input type="file" name="file" accept="image/*">
                <input class="btn" type="submit" value="submit">
            </div>
        </form>
    </div>
@endsection