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
                    <div class="row">
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
                                <div class="col-sm-3 column_initial_acces">
                                    <label class="text_initial_acces w-100 text-muted">
                                        Initial acces date:
                                    </label>
                                    <input class="form-control" type="date" name="initial_acces">
                                </div>
                                <div class="col-sm-3 column_final_acces">
                                    <label class="text_final_acces w-100 text-muted">
                                        Final acces date:
                                    </label>
                                    <input class="form-control" type="date" name="final_acces">
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
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
