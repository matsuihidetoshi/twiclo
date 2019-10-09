@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Post
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Post Form -->
                    <form action="{{ url('post') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Post Name -->
                        <div class="form-group">
                            <label for="post-content" class="col-sm-3 control-label">Post</label>

                            <div class="col-sm-6">
                                <input type="text" name="content" id="post-content" class="form-control" value="{{ old('post') }}">
                            </div>
                        </div>

                        <!-- Add Post Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-btn fa-plus"></i>Add Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Posts -->
            @if (count($posts) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Posts
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped post-table">
                            <thead>
                                <th>Post</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td class="table-text"><div>{{ $post->content }}</div></td>

                                        <!-- Post Delete Button -->
                                        <td>
                                            <form action="{{url('post/' . $post->id)}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" id="delete-post-{{ $post->id }}" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection