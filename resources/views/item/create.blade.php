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

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ui>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ui>
                </div>
            @endif

            <form action="{{ route('items.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Title*</label>
                    <input type="text" class="form-control" id='title' name="title"></input>
                </div>
                <div class="form-group" style="margin-bottom: 0rem;">
                    <label>Group</label>
                </div>
                <div class="form-row" style="margin-bottom: 1rem;">
                    <div class="col">
                        <select class="form-control" id="select_group" name="select_group">
                            <option value="" disabled selected>Select a group</option>
                            @foreach (App\Models\Group::all() as $group)
                                @if ($group->idUser == \Auth::id())
                                    <option value="{{ $group->id }}">{{ $group->title }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    or
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Create a group" id="create_group" name="create_group">
                    </div>
                </div>
                <div class="form-group">
                    <label>Due Date*</label>
                    <input type="text" class="date form-control" id='dueDate' name="dueDate"></input>
                </div>
                <div class="form-group">
                    <label style="display: block ruby;">Reminds me
                        <input type="number" min="0" class="form-control" style="width: 5rem;" id="days_to_remind" name="days_to_remind"></input>
                        days before</label>
                </div>
                <button type=" submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection
