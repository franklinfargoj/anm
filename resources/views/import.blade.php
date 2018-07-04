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
    @if(session()->has('success'))
        <p class="alert alert-success">
            {{ session()->get('success') }}
        </p>
    @endif

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Upload Target File</h3>
                </div>
            </div>
        </div>
    </section>

    {!!  Form::open(array('route' => 'import.file','method'=>'POST','files'=>'true','enctype'=>"multipart/form-data")) !!}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>State</label>
                        <select class="form-control">
                            <option>Maharashtra</option>
                            <option>Maharashtra</option>
                            <option>Maharashtra</option>
                            <option>Maharashtra</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>District</label>
                        <select class="form-control">
                            <option>Maharashtra</option>
                            <option>Maharashtra</option>
                            <option>Maharashtra</option>
                            <option>Maharashtra</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-3">


                        <label>Select File to Import:</label>
                        <input type="file" class="form-control" name="sample_file" >
                            {{--
                            <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    {!! Form::label('sample_file','Select File to Import:',['class'=>'col-md-3']) !!}
                                    <div class="col-md-9">
                                        {!! Form::file('sample_file', array('class' => 'form-control')) !!}
                                        {!!  $errors->first('sample_file', '<p class="alert alert-danger">:message</p>') !!}
                                        @if (session()->has('error'))
                                            <p class="alert alert-danger">
                                                {{ session()->get('error') }}<br>
                                            </p>
                                        @endif
                                        @if(session()->has('success'))
                                            <p class="alert alert-success">
                                                {{ session()->get('success') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                {!! Form::submit('Upload',['class'=>'btn btn-primary']) !!}
                            </div>
                            </div>
                            --}}

                </div>

                <div class="col-sm-3">
                    <div class="form-group btn-area">
                        <button type="submit" class="btn btn-primary">Upload File</button>
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
                    <h3>Uploaded File Details</h3>
                            <table id="uploadData" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>File Name</th>
                                    <th>Uploaded On</th>
                                    <th>Status</th>
                                    <th>Action</th>
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
            $('#uploadData').dataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "info": true,
                "ajax": "<?php echo url('/get-anm-target-data');?>",
                "columns": [

                    { "data": "sr_no" },
                    { "data": "filenames" },
                    { "data": "uploaded_on" },
                    { "data": "status" },
                    { "data": "actions" },
                ],
                /* rowCallback: function (row, data,index){
                     var html = $.map(data['tag'], function(array){ return array['title']});
                     $("td:eq(0)", row).html(html.join(","));
                 }*/
            });
        });
    </script>
@endsection
