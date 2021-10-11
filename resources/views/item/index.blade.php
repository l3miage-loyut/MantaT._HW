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
                    @foreach (App\Models\Item::all() as $item)
                    @if ($item->idUser == \Auth::id())
                    <tr>
                        <td>{{ $item->title }} (<a href="{{ route('items.edit', [$item->id]) }}">Edit</a>)</td>

                        <?php
                            $group = App\Models\Group::find($item->idGroup);
                            if ($group == null) {
                                $group_title = "";
                            } else {
                                $group_title = $group->title;
                            }
                        ?>
                        <td>{{ $group_title }}</td>
                        <td>{{ $item->dueDate }}</td>

                        <?php
                            $now = time();
                            $due_date = strtotime($item->dueDate);
                            $datediff = $due_date - $now;
                            $remain = ceil($datediff / (60 * 60 * 24));
                            $remain==-0 ? $remain=0 : null;
                        ?>
                        @if ($remain <= 0)
                            <td style="color:red;">{{ $remain }}</td>
                        @else
                            <td>{{ $remain }}</td>
                        @endif
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
