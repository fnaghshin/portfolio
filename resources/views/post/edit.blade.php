@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Edit Post
                    </div>

                    <div class="card-body">
                        <form
                            action="{{ route('post.update',$post->id) }}"
                            method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group"
                                 style="padding-top: 10px">
                                <label for="language">
                                    Language
                                </label>
                                <select
                                    type="text"
                                    class="form-control"
                                    name="language"
                                    id="language">
                                    <option value="en">English</option>
                                </select>
                            </div>
                            <div class="form-group"
                                 style="padding-top: 10px">
                                <label for="type">
                                    Post Type
                                </label>
                                <select
                                    type="text"
                                    class="form-control"
                                    name="type"
                                    id="type">
                                    <option value="">Select Post Type</option>
                                    <option value="portfolio" {{ ($post->type == 'portfolio')?'selected':'' }}>Portfolio</option>
                                    <option value="blog" {{ ($post->type == 'blog')?'selected':'' }}>Blog Post</option>
                                </select>
                            </div>
                            <div class="form-group"
                                 style="padding-top: 10px">
                                <label for="title">
                                    Post Title
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="title"
                                    id="title"
                                    value="{{ $post->_content_lang->title }}"/>
                            </div>
                            <div class="form-group"
                                 style="padding-top: 10px">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <label for="image">
                                            Post Image
                                        </label>
                                        <input
                                            type="file"
                                            class="form-control"
                                            name="image"
                                            id="image"/>
                                    </div>
                                    <div class="col-sm-3">
                                        <img src="{{ $post->_content_lang->image }}"
                                            style="width: 100%;height: auto"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group"
                                 style="padding-top: 10px">
                                <label for="description">
                                    Post Description
                                </label>
                                <textarea
                                    style="height: 150px"
                                    type="text"
                                    class="form-control"
                                    name="description"
                                    id="description"
                                >{{ $post->_content_lang->description }}</textarea>
                            </div>
                            <div class="form-group"
                                 style="padding-top: 10px">
                                <label for="contect">
                                    Post Content
                                </label>
                                <textarea
                                    type="text"
                                    class="form-control"
                                    name="content"
                                    id="content"
                                >{{ $post->_content_lang->content }}</textarea>
                            </div>
                            <div class="form-group"
                                 style="padding-top: 10px">
                                <button
                                    style="width: 100%"
                                    type="submit"
                                    class="btn btn-success btn-block">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'content' );
    </script>

@endsection
