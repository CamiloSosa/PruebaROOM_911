<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center;">
            {{ __('Administrative Menu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200" style="text-align: center;">
                    <div class="information">
                        <div class="current mb-2">
                            Current time <br>
                            @if(Session::has('access-room'))
                                @php 
                                    $finishTime = new \Carbon\Carbon();
                                @endphp
                                {{$finishTime->diffForHumans(Session::get('access-room'))}} logged in room 911
                            @else
                                You are out of room 911
                            @endif
                        </div>
                        <div class="name">
                            Welcome: {{ \Auth::user()->firstname }}
                        </div>
                    </div>
                    <form method="GET" class="mt-2" action="{{ url('/dashboard') }}">
                        <div class="row" >
                            <div class="col-md-9 column_boxes">

                                <div class="row row_boxes">
                                    <div class="col-sm-3 column_search">
                                        <input class="form-control" id="user_id" name="user_id" type="number" placeholder="Search by employee ID" value="{{$request->user_id}}">
                                    </div>
                                    <div class="col-sm-3 column_filter">
                                        <select name="department_id" id="department_id" class=" form-control">
                                            <option value="">Select One</option>
                                            @foreach($departments as $department)
                                                <option value="{{$department->id}}" {{ $request->department_id == $department->id ? 'selected' : '' }} >
                                                     {{$department->name}}
                                                </option>
                                            @endforeach
                                        </select>
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
                                        <button name="button_clear_filter" id="clear_filter" class="btn btn-secondary">
                                            Clear filter
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="line my-4"></div>
                    <div class="row_new_deployee">
                        <div class="new_deployee mb-4">
                            <a href="{{ url('/user') }}" name="new_employee_" class="btn btn-primary">
                                    New Employee
                            </a>
                        </div>
                    </div>
                    <div class="container_table table-responsive">
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
                                            {{ $user->roomAccess->count() }}
                                        </td>
                                        <td>
                                            <a href="{{ url('/user/'.$user->id.'/edit') }}" name="button_update" class="btn btn-info">
                                                Update
                                            </a>
                                            <a  data-url="{{ url('/user/'. $user->id . '/allow-access') }}" class=" button_disable btn btn-{{ $user->hasPermission('room_access') ? 'success' : 'danger' }}">
                                                {{ $user->hasPermission('room_access') ? 'Disable' : 'Enable' }}
                                            </a>
                                            <a href="{{ url('/export/' . $user->id) }}" class="btn btn-warning">
                                                History
                                            </a>
                                            @if($user->id != auth::id())
                                            <a data-url="{{ url('/user/' . $user->id) }}"  class="btn btn-danger deleteUser">
                                                Delete
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
