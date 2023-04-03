@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-11">
                                Post List
                            </div>
                            <div class="col-sm-1 text-right">
                                <a
                                    href="/post/create"
                                    class="btn btn-secondary btn-sm">
                                    +
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-responsive table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Title</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            @foreach($postList as $key=>$post)
                                <tr>
                                    <td>{{ ($key + 1) }}</td>
                                    <td>
                                        {{ $post->type }}
                                    </td>
                                    <td>
                                        {{ $post->_content_lang->title }}
                                    </td>
                                    <td>
                                        <a href="{{ route('post.edit',$post->id) }}" class="btn btn-success">
                                            Edit
                                        </a>
                                    </td>
                                    <td>
                                        <form method="post"
                                              action="{{route('post.destroy',$post->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                onclick="return confirm('Want to delete This Post ? ')"
                                                class="btn btn-outline-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
