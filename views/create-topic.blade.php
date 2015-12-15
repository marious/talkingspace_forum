@extends('app')

@section('browerTitle') Create Topic @stop

@section('mainTitle') Craete New Topic @stop

@section('content')
    @include('_partials._flash_errors')
<form role="form" method="post">
    <div class="form-group">
        <label>Topic Title</label>
        <input type="text" class="form-control" name="title" placeholder="Enter post Title" required>

    </div>
    <div class="form-group">
        <label>Category</label>
        <select class="form-control" name="category">
            @foreach (App\models\Category::categories() as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Topic Body</label>
        <textarea name="body" id="body" cols="80" rows="10" class="form-control" name="body"></textarea>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
@stop

@section('statistics')
@stop

@section('script')
    <script src="{!! asset('assets/js/ckeditor/ckeditor.js') !!}"></script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('body');
        });
    </script>
@stop