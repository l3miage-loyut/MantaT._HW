@extends('layouts.app')

@section('content')
<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

<!-- Styles -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>My ToDo List</h2>
        </div>
        <div class="col-md-2">
            <a href="{{ url('/items/create') }}" style="float: right;">add item</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table table-striped table-bordered" id="sortTable">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Group</th>
                        <th>Due Date</th>
                        <th>Days Remain</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (App\Models\Item::all() as $post)
                    @if ($post->idUser == \Auth::id())
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->idGroup }}</td>
                        <td>{{ $post->dueDate }}</td>
                        <td>{{ $post->remain }}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            <script>
                $('#sortTable').DataTable();
            </script>
        </div>
    </div>
</div>
@endsection
