@extends('layouts.app')

@section('content')
<!-- Scripts -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(function() {
        $('#dueDate').datepicker({
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

            <form action="{{ route('items.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Title*</label>
                    <input type="text" class="form-control" id='title' name="title"></input>
                </div>
                <div class="form-group">
                    <label>Select a group</label>
                    <select class="form-control" id="group" name="group">
                        <option value="" disabled selected>Choose option</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
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
