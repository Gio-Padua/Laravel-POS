@extends('layouts.app')


@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                @include('layouts.sidebar')
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex flex-row justify-content-between align-items-center border-bottom pb-1">
                                    <h3 class="text-secondary">
                                        <i class="fas fa-user-cog"></i> Employees
                                    </h3>
                                    <a href="{{ route("employees.create") }}" class="btn btn-primary">
                                        <i class="fas fa-plus fa-x2"></i>
                                    </a>
                                </div>
                                <table class="table table-hover table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employees as $employee)
                                            <tr>
                                                <td>
                                                    {{ $employee->id }}
                                                </td>
                                                <td>
                                                    {{ $employee->name }}
                                                </td>
                                                <td>
                                                    @if ($employee->address)
                                                        {{ $employee->address }}
                                                    @else
                                                        <span class="text-danger">
                                                            Non Disponible
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="d-flex flex-row justify-content-center align-items-center">
                                                    <a href="{{ route("employees.edit",$employee->id) }}" class="btn btn-warning mr-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form id="{{ $employee->id }}" action="{{ route("employees.destroy",$employee->id) }}" method="post">
                                                        @csrf
                                                        @method("DELETE")
                                                        <button
                                                            onclick="
                                                                event.preventDefault();
                                                                if(confirm('Are you sure you want to delete {{ $employee->name }} ?'))
                                                                document.getElementById({{ $employee->id }}).submit()
                                                            "
                                                            class="btn btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="my-3 d-flex justify-content-center align-items-center">
                                    {{ $employees->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
