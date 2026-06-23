@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col m-4">
        <div class="card">
            <div class="card-header"> Kelola User </div>
            <div class="card-body">
                <a href="{{ route('users.create') }}" class="btn btn-success btn-sm my-2"><i class="fas fa-plus-circle"></i> Add New User</a>

                <table class="table" style="table-layout:fixed">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" style="width:50px;">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Roles</th>
                            <th scope="col" style="width:150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr class="text-center">
                            <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center">
                                @forelse($user->getRoleNames() as $role)
                                <div class="badge bg-primary ">{{ $role }}</div>
                                @empty

                                @endforelse
                            </td>
                            <td>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('users.show',$user->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                    @can('edit')
                                    <a href="{{route('users.edit', $user->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    @endcan

                                    @can('delete-user')
                                    @if(Auth::user()->id != $user->id)
                                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Apa kamu yakin ingin menghapus ini?')"><i class="fas fa-trash"></i></button>
                                    @endif
                                    @endcan
                                </form>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="5">
                                <span class="text-muted">Tidak ada data</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection