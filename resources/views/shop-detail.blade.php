



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @section('content')
<div class="container">
    <h1>{{ $plat->name }}</h1>
    <p>{{ $plat->description }}</p>
    <p>Price: ${{ $plat->price }}</p>
    <img src="{{ $plat->image_url }}" alt="{{ $plat->name }}">
</div>
@endsection

</body>
</html>
