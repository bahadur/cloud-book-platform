@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Users') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->getRoleNames() }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" type="button" id="revoke-role" data-bs-toggle="dropdown" aria-expanded="false">
                                                Revoke Role
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="revoke-role">
                                                @foreach($user->getRoleNames() as $role)
                                                <li><a class="dropdown-item" href="{{ route('user.revoke.role', ['id' => $user->id, 'role' => $role]) }}">{{ $role }}</a></li>
                                                @endforeach

                                            </ul>

{{--                                            <button class="btn btn-sm btn-primary" id="revoke-role" data-user-id="{{ $user->id }}">Revoke Role</button>--}}

                                            <button class="btn btn-sm btn-primary" type="button" id="revoke-role" data-bs-toggle="dropdown" aria-expanded="false">
                                                Assign Role
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="revoke-role">
                                                @foreach(\App\Enums\ACL\Role::cases() as $role)
                                                    <li><a class="dropdown-item" href="{{ route('user.assign.role', ['id' => $user->id, 'role' => $role]) }}">{{ $role }}</a></li>
                                                @endforeach

                                            </ul>

{{--                                            <button class="btn btn-sm btn-primary" id="assign-role" data-user-id="{{ $user->id }}">Assign Role</button>--}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="module">
        $(function(){
            $('#revoke-role').on('click', function(){
                $.ajax({
                    url: "{{ route('user.revoke.role') }}",
                    dataType: "json",
                    type: "post",
                    async: true,
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}",
                    },
                    data: {
                        user_id: $(this).data('user-id')
                    },
                    success: function (data) {
                        location.reload(true);
                    },
                    error: function (xhr, exception, thrownError) {

                    }
                });
            });

            $('#assign-role').on('click', function(){
                $.ajax({
                    url: "{{ route('user.assign.role') }}",
                    dataType: "json",
                    type: "post",
                    async: true,
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}",
                    },
                    data: {
                        user_id: $(this).data('user-id')
                    },
                    success: function (data) {
                        location.reload(true);
                    },
                    error: function (xhr, exception, thrownError) {

                    }
                });
            });
        });
    </script>

@endsection
