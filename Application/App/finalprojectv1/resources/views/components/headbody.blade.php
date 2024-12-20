<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('./style/bs.css')}}">
    <link rel="stylesheet" href="{{asset('./style/all.css')}}">
    <link rel="stylesheet" href="{{asset('./style/custom.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body style="background-image: url('{{$backgroundimage}}')">

    {{$slot}}



    <!-- jQuery library -->
    {{-- <script src="./script/jquery.js"></script> --}}

    <!-- Popper JS -->
    <script src="./script/popper.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="./script/bootstrap.js"></script>

    <script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

</script>
</body>

</html>