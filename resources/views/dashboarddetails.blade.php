@extends('layouts.main')

@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-title">File Details
                        <a style="margin-left: 1050px;" class="btn btn-default" href="{{ url('/') }}">Back</a>
                    </h1>

                </div>

            </div>
        </div>
    </section>


     <a style="margin-left: 1050px;" class="btn btn-default" href="{{ route('weblinks_excel_export',$id) }}">Export to Excel</a>
    
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
                    <h3>Uploaded File Details</h3>
                    <table id="uploadData" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Weblink</th>
                            <th>SMS sent</th>
                            <th>Mobile no.</th>
                            <th>IP address</th>
                            <th>Clicked at</th>
                        </tr>
                        </thead>
{{--                        @php $i = 1;@endphp
                            @foreach ($anm_file_data as $key => $value)
                                <tr>
                                    <td>{{ $i++ }}</td>

                                    <td>{{ $value['weblink'] }}</td>

                                    @if($value['weblink'])
                                    <td>Yes</td>
                                    @else
                                    <td>No</td>
                                    @endif

                                    @if($value['ip_address'])
                                    <td>{{ $value['ip_address'] }}</td>
                                    @else
                                    <td>----</td>
                                    @endif

                                    @if($value['clicked_at'])
                                    <td>{{ $value['clicked_at'] }}</td>
                                    @else
                                    <td>----</td>
                                    @endif

                                </tr>
                            @endforeach--}}

                    @php $i = $file_data->perPage() * ($file_data->currentPage() -1); @endphp
                    @foreach ($file_data as $value)

                        <tr>
                            <td> {{ ++$i }} </td>

                            <td>{{ $value->weblink }}</td>

                            @if($value->sms_sent)
                                <td>Yes</td>
                            @else
                                <td>No</td>
                            @endif

                            @if($value->mobile_no)
                                <td>{{ $value->mobile_no }}</td>
                            @else
                                <td>----</td>
                            @endif

                            @if($value->ip_address)
                                <td>{{ $value->ip_address }}</td>
                            @else
                                <td>----</td>
                            @endif

                            @if($value->clicked_at)
                                <td>{{ $value->clicked_at }}</td>
                            @else
                                <td>----</td>
                            @endif

                        </tr>
                    @endforeach
                </table>
                {{ $file_data->links() }}

</div>
</div>
</div>
</section>

@endsection


