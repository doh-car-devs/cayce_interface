@php
    if ( ! function_exists('cached_asset'))
    {
        function cached_asset($path, $bustQuery = false)
        {
            // Get the full path to the asset.
            $realPath = public_path($path);

            if ( ! file_exists($realPath)) {
                throw new LogicException("File not found at [{$realPath}]");
            }

            // Get the last updated timestamp of the file.
            $timestamp = filemtime($realPath);

            if ( ! $bustQuery) {
                // Get the extension of the file.
                $extension = pathinfo($realPath, PATHINFO_EXTENSION);

                // Strip the extension off of the path.
                $stripped = substr($path, 0, -(strlen($extension) + 1));

                // Put the timestamp between the filename and the extension.
                $path = implode('.', array($stripped, $timestamp, $extension));
            } else {
                // Append the timestamp to the path as a query string.
                $path  .= '?' . $timestamp;
            }

            return asset($path);
        }
    }
@endphp
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="icon" href="{{asset('assets/icons/DOH-Logo.png')}}" type="image/x-icon"/>

<title>{{ config('app.name', 'DOH-CAR Portal') }}</title>

<link href="{{ asset('css/app.css') }}" rel="stylesheet">
{{-- <script src="{{ asset('lib/crypta.js') }}"></script> --}}

<!-- DataTables -->
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-rowgroup/css/rowGroup.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

<link rel="stylesheet" href="{{asset('plugins/fullcalendar/fullcalendar.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-checkboxes/css/dataTables.checkboxes.css')}}">


{{-- <link rel="stylesheet" href="{{ cached_asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css', true) }}">
<link rel="stylesheet" href="{{ cached_asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css', true) }}">
<link rel="stylesheet" href="{{ cached_asset('plugins/datatables-rowgroup/css/rowGroup.bootstrap4.css')}}">', true) }}">
<link rel="stylesheet" href="{{ cached_asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css', true) }}">

<link rel="stylesheet" href="{{ cached_asset('plugins/datatables-checkboxes/css/dataTables.checkboxes.css', true) }}">
<link rel="stylesheet" href="{{ cached_asset('plugins/fullcalendar/fullcalendar.min.css', true) }}"> --}}

<link href="{{asset('plugins/select2/select2.min.css')}}" rel="stylesheet">
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

