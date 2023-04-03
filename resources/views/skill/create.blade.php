@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create Skill
                    </div>

                    <div class="card-body">
                        <form
                            action="{{ route('skill.store') }}"
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
                                <label for="title">
                                    Skill Title
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
                                    Skill Logo
                                </label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="icon"
                                    id="icon"/>
                            </div>
                            <div class="form-group"
                                 style="padding-top: 10px">
                                <label for="title">
                                    Skill Start Year
                                </label>
                                <input
                                    type="date"
                                    class="form-control"
                                    name="year"
                                    id="year"/>
                            </div>
                            <div class="form-group"
                                 style="padding-top: 10px">
                                <label for="description">
                                    Skill Description
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
                                    Skill Content
                                </label>
                                <textarea
                                    style="height: 150px"
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
@endsection
