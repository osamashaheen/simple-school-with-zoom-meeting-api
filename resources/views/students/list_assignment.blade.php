@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('flash')
            </div>            
        </div>
    </div>
    <div class="container">
        <div class="row">      
            <div class="col-md-6"> 
                <h2>Assignment Lists</h2>
            </div>               
            <div class="col-md-6">                
                <a href="{{ route('student.assignments.create') }}" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Add Assignment</a>
            </div>    
        </div>

        <hr>
        <div class="row">
            <div class="col-md-12">
              <table summary="This is table" class="table table-bordered table-hover dt-responsive" style="width: 100%">
              {{-- <table id="example" class="table table-striped table-bordered" style="width: 100%;"> --}}
                {{-- <caption class="text-center">An example of a responsive table based on <a href="https://datatables.net/extensions/responsive/" target="_blank">DataTables</a>:</caption> --}}
                <thead>
                      <tr>
                        <th>Subject Name</th>
                        <th>Teacher Name</th>
                        <th>Assignment Title</th>
                        <th>Status</th>
                        <th><span class="fa fa-ellipsis-h"></span></th>
                      </tr>
                </thead>
                <tbody>
                    @if($assignments)
                    @foreach($assignments as $assignment)
                    <?php $subject = \App\Subject::findOrFail($assignment->subject_id); 
                    $teacher = \App\Teacher::findOrFail($subject->teacher_id); ?>
                    <tr>
                        <td>{{ $subject->name }}</td>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $assignment->name }}</td>
                        <td>
                            @if($assignment->status == 1)
                                <span class="btn btn-success">Approved</span>
                            @else
                                <span class="btn btn-danger">Pending</span>
                            @endif
                        </td>
                        {{-- <td>{{ ucwords($assignment->specialization) }}</td> --}}
                        <td>
                            {{-- <a type="button" class="btn btn-secondary btn-md" href=""><i class="fa fa-eye"></i></a> --}}
                            <a type="button" class="btn btn-primary btn-md" href="{{ route('student.assignments.edit', $assignment->id) }}"><i class="fa fa-pencil"></i></a>
                            @if(Auth::user()->isAdmin())
                            <a type="button" class="btn btn-danger btn-md" href="{{ route('student.assignments.delete', $assignment->id) }}" onclick="return confirm('Are you sure')"><i class="fa fa-trash"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @endif                 
                </tbody>
              </table>
            </div>
        </div>
    </div>
    
@endsection
