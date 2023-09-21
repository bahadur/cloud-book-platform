@extends('layouts.app')

@section('style')
    <style>
        .showLeft{
            background-color: #0d77b6 !important;
            border:1px solid #0d77b6 !important;
            text-shadow: none !important;
            color:#fff !important;
            padding:10px;
        }

        .icons li {
            background: none repeat scroll 0 0 #fff;
            height: 7px;
            width: 7px;
            line-height: 0;
            list-style: none outside none;
            margin-right: 15px;
            margin-top: 3px;
            vertical-align: top;
            border-radius:50%;
            pointer-events: none;
        }

        .btn-left {
            left: 0.4em;
        }

        .btn-right {
            right: 0.4em;
        }

        .btn-left, .btn-right {
            position: absolute;
            top: 0.24em;
        }

        .dropbtn {
            background-color: #4CAF50;
            position: fixed;
            color: white;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropbtn:hover, .dropbtn:focus {
            background-color: #3e8e41;
        }

        .dropdown {
            position: absolute;
            display: inline-block;
            right: 0.4em;
        }

        .dropdown-content {
            display: none;
            position: relative;
            margin-top: 60px;
            background-color: #f9f9f9;
            min-width: 160px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown a:hover {background-color: #f1f1f1}

        .show {display:block;}
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('section.index') }}">Root</a></li>
                        @foreach($breadCrumb as $bcrm)
                            @if(!isset($bcrm->id))
                                @php
                                continue;
                                @endphp
                            @endif
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('section.index', [$bcrm->id]) }}">{{ $bcrm->name }}</a></li>
                        @endforeach
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        {{ __('Folders') }}
                        <div class=" float-end" role="group" aria-label="Basic example">
                            @can(\App\Enums\ACL\Permission::CREATE_FOLDER->value)
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createFolderModal">Create Folder</button>
                            @endcan
                        </div>
                    </div>


                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(!empty($sections))
                            <div class="row">

                                @foreach($sections as $section)
                                    @if($section->type == \App\Enums\Section\Type::FOLDER->value)
                                    <div class="col-4">

                                            <div class="card border-primary m-2 p-2">
                                                <div class="dropdown ms-auto">
                                                    <i class="fas fa-ellipsis-vertical float-end" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <span class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updateFolderModal" data-folder-name="{{ $section->name }}" data-folder-id="{{ $section->id }}" id="update-folder-button">
                                                                <i class="fas fa-pen mx-2"></i> Update
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="dropdown-item">
                                                                <i class="fas fa-trash mx-2"></i> Delete
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <i class="fa-solid fa-folder"></i>
                                                <a href="{{ route('section.index', [$section->id]) }}" >
                                                    {{ $section->name }}
                                                </a>
                                            </div>

                                    </div>
                                    @endif
                                @endforeach
                            </div>

                            @endif
                    </div>
                    <div class="card-footer">
                        <div class="float-end" role="group" aria-label="Basic example">
                            @can(\App\Enums\ACL\Permission::CREATE_FOLDER->value)
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createFolderModal">Create Folder</button>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        {{ __('Files') }}
                        <div class=" float-end" role="group" aria-label="Basic example">
                            @can(\App\Enums\ACL\Permission::CREATE_FILE->value)
                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#createFileModal">Upload File</button>
                            @endcan
                        </div>
                    </div>


                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(!empty($sections))
                            <div class="row">
                                @foreach($sections as $section)
                                    @if($section->type == \App\Enums\Section\Type::FILE->value)
                                    <div class="col-4">
                                        <a href="{{ route('section.index', [$section->id]) }}" >
                                            <div class="card border-primary m-2 p-2">
                                                <i class="fa-solid fa-file"></i><img src="{{ asset('images/' . $section->path)  }}"  style="width: 80px"/>
                                            </div>
                                        </a>
                                    </div>
                                    @endif
                                @endforeach
                            </div>

                        @endif
                    </div>
                    <div class="card-footer">
                        <div class="float-end" role="group" aria-label="Basic example">
                            @can(\App\Enums\ACL\Permission::CREATE_FILE->value)
                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#createFileModal">Upload File</button>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createFolderModal" tabindex="-1" aria-labelledby="createFolderLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Folder</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Folder Name:</label>
                            <input type="text" class="form-control" id="folder-name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="{{ $parentId }}" id="parent-id" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="create-folder">Create</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateFolderModal" data-bs-backdrop="false" tabindex="-1" aria-labelledby="updateFolderLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Folder</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Folder Name:</label>
                            <input type="text" class="form-control" id="folder-name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="{{ $parentId }}" id="parent-id" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="update-folder">Update</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createFileModal" tabindex="-1" aria-labelledby="createFileLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Select File</label>
                            <input class="form-control" type="file" id="file-name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="{{ $parentId }}" id="parent-id" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="create-file">Upload</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="module">
        $(function() {

            var updateFolderModal = document.getElementById('updateFolderModal');
            updateFolderModal.addEventListener('show.bs.modal', function (event) {
                var folderVal = $("#update-folder-button").data('folder-name');
                var folderId = $("#update-folder-button").data('folder-id');
                $("#updateFolderModal input[type='text']").val(folderVal);
                $("#updateFolderModal input[type='hidden']").val(folderId);
            })


            $('#update-folder').on('click', function() {

                console.log('clicked');

                var folderName = $("#updateFolderModal input[type='text']").val();
                var folderId = $("#updateFolderModal input[type='hidden']").val();
                $.ajax({
                    url: "{{ route('section.update') }}",
                    dataType: "json",
                    type: "post",
                    async: true,
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}",
                    },
                    data: {
                        type: '{{ \App\Enums\Section\Type::FOLDER }}',
                        name: folderName,
                        id: folderId,
                    },
                    success: function (data) {
                        location.reload(true);
                    },
                    error: function (xhr, exception, thrownError) {

                    }
                });
            })

            $('#create-folder').on('click', function() {
                $.ajax({
                    url: "{{ route('section.store') }}",
                    dataType: "json",
                    type: "post",
                    async: true,
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}",
                    },
                    data: {
                        type: '{{ \App\Enums\Section\Type::FOLDER }}',
                        name: $('#folder-name').val(),
                        parent_id: $("#parent-id").val()
                    },
                    success: function (data) {
                        location.reload(true);
                    },
                    error: function (xhr, exception, thrownError) {

                    }
                });
            })

            $('#create-file').on('click', function(){

                var formData = new FormData();
                // formData.append('file', $('#file-name').files);
                formData.append('file', $('#file-name')[0].files[0]);
                formData.append('type', '{{ \App\Enums\Section\Type::FILE }}');
                formData.append('parent_id', $("#parent-id").val());
                formData.append('name', 'upload_file');
                $.ajax({
                    method: 'post',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: formData,
                    enctype: 'multipart/form-data',
                    url: "{{ route('section.store') }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}",
                    },
                    success: function (data) {
                        location.reload(true);
                    },
                    error: function (xhr, exception, thrownError) {

                    }
                });
            })
        })

    </script>
@endsection
