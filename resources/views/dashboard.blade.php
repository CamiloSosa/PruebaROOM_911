<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center; height: 2vw;">
            {{ __('Administrative Menu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200" style="height: 35vw; text-align: center;">
                    <div class="information">
                        <div class="current">
                            Current time
                        </div>
                        <div class="name">
                            Welcome: Username
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-md-9 column_boxes">

                            <div class="row row_boxes">
                                <div class="col-sm-3 column_search">
                                    <input class="form-control" placeholder="Search by employee ID">
                                </div>
                                <div class="col-sm-3 column_filter">
                                    <select name="department_id" class=" form-control">
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}" {{ old('department_id') == $department->id ? 'selected' : '' }} >
                                                 {{$department->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3 column_initial_access">
                                    <label class="text_initial_access w-100 text-muted">
                                        Initial access date:
                                    </label>
                                    <input class="form-control" type="date" name="initial_access">
                                </div>
                                <div class="col-sm-3 column_final_access">
                                    <label class="text_final_access w-100 text-muted">
                                        Final access date:
                                    </label>
                                    <input class="form-control" type="date" name="final_access">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 column_button_filters">
                            <div class="row row_button_filters">
                                <div class="col-sm-6 column_button_filter">
                                    <button name="button_filter" class="btn btn-primary">
                                        Filter
                                    </button>
                                </div>
                                <div class="col-sm-6 column_buton_clear_filter">
                                    <button name="button_clear_filter" type="reset" class="btn btn-secondary">
                                        Clear filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="line my-4"></div>
                    <div class="row_new_deployee">
                        <div class="new_deployee mb-4">
                            <button name="new_deployee_" class="btn btn-primary">
                                    New deployee
                            </button>
                        </div>
                    </div>
                    <div class="container_table">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Employee ID</th>
                                    <th scope="col">Firstname ID</th>
                                    <th scope="col">Lastname</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Total access</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            {{$user->id}}
                                        </td>
                                        <td>
                                            {{$user->firstname}}
                                        </td>
                                        <td>
                                            {{$user->lastname}}
                                        </td>
                                        <td>
                                            {{$user->department->name}}
                                        </td>
                                        <td>
                                            Empty
                                        </td>
                                        <td>
                                            <a href="{{ url('/user/'.$user->id.'/edit') }}" name="button_update" class="btn btn-info">
                                                Update
                                            </a>
                                            <a name="button_disable" class="btn btn-{{ $user->hasPermission('room_acces') ? 'success' : 'danger' }}">
                                                {{ $user->hasPermission('room_acces') ? 'Disable' : 'Enable' }}
                                            </a>
                                            <a name="button_history" class="btn btn-warning">
                                                History
                                            </a>
                                            <a name="button_delete" class="btn btn-danger">
                                                Delete
                                            </a>
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



</x-app-layout>
