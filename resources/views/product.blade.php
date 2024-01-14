<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>product</title>
</head>

<body>
    <form method="post" action="{{ route('product_store') }}" enctype="multipart/form-data">
        @csrf <!-- 在 Laravel 中，使用 @csrf 生成 CSRF token -->
        名子 <input type="text" id="file" name="name">
        <br><br>
        狀態 <input type="text" id="file" name="desc">
        <hr>
        照片<label for="file">選擇文件：</label>
        <input type="file" id="file" name="image"> <!-- 這裡的 name 屬性應該是 'image'，與控制器中的 'image' 保持一致 -->
        <button type="submit">上傳</button>
    </form>
</body>

</html>
