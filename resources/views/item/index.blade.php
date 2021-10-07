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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (App\Models\Item::all() as $item)
                    @if ($item->idUser == \Auth::id())
                    <tr>
                        <td>{{ $item->title }}</td>

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
                            $remain = round($datediff / (60 * 60 * 24));
                            $remain==-0 ? $remain=0 : null;
                        ?>
                        @if ($remain <= 0)
                            <td style="color:red;">{{ $remain }}</td>
                        @else
                            <td>{{ $remain }}</td>
                            <!--
                            <td>
                                <form>
                                    <button type="button" class="btn btn-link" style="padding: 0px;">edit</button>
                                </form>
                            </td>
                            -->
                        @endif
                        <td>
                            <form action="{{ route('items.destroy', [$item->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-link" style="padding: 0px;">delete</button>
                            </form>
                        </td>
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
