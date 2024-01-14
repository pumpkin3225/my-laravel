<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <a href="{{ route('product_create') }}">去加資料</a>
    <hr>
    @foreach ($products as $product)
        <div>
            <div>{{ $product->name }}</div>
            <div>{{ $product->desc }}</div>
            <div>
                <img src="{{ asset($product->img_path) }}" alt="Product Image">
            </div>
            <button>刪除</button>
            <hr>
    @endforeach
</body>
</html>
