@extends('layouts.main')

@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
    </section>

    @if (session()->has('error'))
        <p class="alert alert-danger">
            {{ session()->get('error') }}<br>
        </p>
    @endif
    @if($errors->any())
        <p class="alert alert-danger">
            @foreach($errors->all() as $error)
                {{$error}}<br>
            @endforeach
        </p>
    @endif
    @if(session()->has('success'))
        <p class="alert alert-success">
            {{ session()->get('success') }}
        </p>
    @endif

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Moic ranking details</h3>
                </div>
            </div>
        </div>
    </section>

    {!!  Form::open(array('method'=>'POST','files'=>'true','enctype'=>"multipart/form-data")) !!}
    <section>
        <div class="container">
            <div class="row">

                <div class="row mb-1">
                    <div class="col-md-12 text-right">
                        <a  class="btn btn-primary"  href="{{ route('export_feedback',$id) }} ">Export to excel</a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    {!! Form::close() !!}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Uploaded Moic files</h3>
                    <table id="moic_rankings" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>District</th>
                            <th>PHC Name</th>
                            <th>Dr. Name</th>
                            <th>Weblink</th>
                            <th>SMS</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script>
        $(function () {
            $('.alert').fadeOut(1500);
            $('#moic_rankings').dataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "info": true,
                "ajax": "<?php echo url('/file_details/'.$id);?>",
                "columns": [
                    { "data": "sr_no" },
                    { "data": "block_hindi" },
                    { "data": "phc" },
                    { "data": "doctor_name" },
                    { "data": "weblink" },
                    { "data": "sms" }
                ]
            });
        });
    </script>
@endsection


