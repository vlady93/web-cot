@extends('layouts.admin')
@section('title', 'Gestión de liquidaciones')
@section('styles')
    <link href={{ asset('otika/assets/bundles/datatables/datatables.min.css') }} rel="stylesheet">
    <link
        href={{ asset('otika/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}rel="stylesheet">
@section('content')

 @endsection   
@section('scripts')

<script src={{ asset('otika/assets/bundles/datatables/datatables.min.js') }}></script>
<script src={{ asset('otika/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}></script>
<!-- Page Specific JS File -->
<script src={{ asset('otika/assets/js/page/datatables.js') }}></script>
@endsection
