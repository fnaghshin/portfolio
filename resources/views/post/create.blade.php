@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create Post
                    </div>

                    <div class="card-body">
                        <form
                            action="{{ route('post.store') }}"
                            method="post"
                            enctype="multipart/form-data">
                            @csrf
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
                                    <option value="portfolio">Portfolio</option>
                                    <option value="blog">Blog Post</option>
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
                                    id="title"/>
                            </div>
                            <div class="form-group"
                                 style="padding-top: 10px">
                                <label for="image">
                                    Post Image
                                </label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="image"
                                    id="image"/>
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
                                ></textarea>
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
                                ></textarea>
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
