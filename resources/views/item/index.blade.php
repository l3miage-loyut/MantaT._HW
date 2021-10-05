@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>My TODO List</h2>
            <div class="card">
                <table>
                    <tr>
                        <td class="card-header">Title</td>
                        <td class="card-header">Group</td>
                        <td class="card-header">Due Date</td>
                        <td class="card-header">Days Remain</td>
                    </tr>

                    @foreach (App\Models\Item::all() as $post)
                    @if ($post->idUser == \Auth::id())<tr>
                        <td class="card-body">{{ $post->title }}</td>
                        <td class="card-body">{{ $post->idGroup }}</td>
                        <td class="card-body">{{ $post->dueDate }}</td>
                        <td class="card-body">{{ $post->remain }}</td>
                    </tr>
                    @endif
                    @endforeach

                </table>
            </div>
        </div>
    </div>
</div>
@endsection
