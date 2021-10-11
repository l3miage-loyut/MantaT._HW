@extends('layouts.app')

@section('content')
<!-- Scripts -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(function() {
        $('#dueDate').datepicker({
            startDate: new Date(),
            format: 'yyyy-mm-dd'
        });
    });
</script>

<!-- Styles -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Create a todo item</h2>

            @if (session('success'))
            <div class="alert alert-success">
                Updated Successfully!
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <ui>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ui>
            </div>
            @endif

            <form action="{{ route('items.update', [$item->id]) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label>Title*</label>
                    <input type="text" class="form-control" id='title' name="title" value="{{ old('title', $item->title) }}"></input>
                </div>
                <div class="form-group" style="margin-bottom: 0rem;">
                    <label>Group</label>
                </div>
                <div class="form-row" style="margin-bottom: 1rem;">
                    <div class="col">
                        <select class="form-control" id="select_group" name="select_group">
                            @if($item->idGroup == null)
                                <option value="" disabled selected>Select a group</option>
                            @else
                                <option value="" disabled>Select a group</option>
                            @endif

                            @foreach (App\Models\Group::all() as $group)
                                @if ($group->idUser == \Auth::id())
                                    @if ($group->id == $item->idGroup)
                                        <option value="{{ $group->id }}" selected>{{ $group->title }}</option>
                                    @else
                                        <option value="{{ $group->id }}">{{ $group->title }}</option>
                                    @endif
                                @endif
                            @endforeach
                            <option value="OTHER">Others...</option>
                        </select>
                    </div>
                    or
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Create a group" id="create_group" name="create_group" disabled>
                    </div>

                    <script>
                        $('#select_group').on('change', function() {
                            if ($('#select_group').val() == 'OTHER') {
                                $('#create_group').removeAttr('disabled');
                            } else {
                                $('#create_group').attr('disabled', 'disabled');
                            }
                        });
                    </script>

                </div>
                <div class="form-group">
                    <label>Due Date*</label>
                    <input type="text" class="date form-control" id='dueDate' name="dueDate" value="{{ old('dueDate', $item->dueDate) }}"></input>
                </div>
                <div class="form-group">
                    <label style="display: block ruby;">Reminds me
                        <input type="number" min="0" class="form-control" style="width: 5rem;" id="days_to_remind" name="days_to_remind" value="{{ $item->days_to_remind }}"></input>
                        days before</label>
                </div>
                <button type=" submit" class="btn btn-primary">Update</button>
            </form>

            <hr>

            <form action="{{ route('items.destroy', [$item->id]) }}" method="post" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
