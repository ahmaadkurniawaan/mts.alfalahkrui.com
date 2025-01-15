// resources/views/page/preview.blade.php
<!DOCTYPE html>
<html>
<head>
    <title>Preview</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    {!! $page->content ?? '<div class="container"><h1>Hello World</h1></div>' !!}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>