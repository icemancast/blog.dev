<!DOCTYPE html>
<html lang="en">
<head>
    <title>My First View</title>
</head>
<body>
    <h1>Hello, Codeup!</h1>
    
    @foreach($errors->all() as $error)
        {{ $error }}
    @endforeach

    <input name="title" @if($errors->has('title')) class="error-border" @endif value="{{ Input::old('title') }}">


</body>
</html>