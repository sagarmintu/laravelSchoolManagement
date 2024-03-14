@extends('layouts.app')

@section('title', 'List Of Class & Subject')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List Of Class & Subject (Total Record: {{ $getRecord->total() }})</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    @include('message')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List Of Class & Subject</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Class Name</th>
                                        <th>Subject Name</th>
                                        <th>Subject Type</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getRecord as $data)
                                        <tr>
                                            <td>{{ $data->class_name }}</td>
                                            <td>{{ $data->subject_name }}</td>
                                            <td>
                                                @if ($data->subject_type == 'Theory')
                                                <span class="badge badge-success">Theory</span>
                                                @elseif ($data->subject_type == 'Practical')
                                                <span class="badge badge-danger">Practical</span>
                                                @endif
                                            </td>
                                            <td>{{ date('d-m-Y H:i A', strtotime($data->created_at)) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div style="padding: 10px; float: right;">
                                {{ $getRecord->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection