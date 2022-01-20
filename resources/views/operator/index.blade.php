<x-app-layout>
	<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center; height: 2vw;">
            Welcome {{ \Auth::user()->firstname }} {{ \Auth::user()->lastname }} 
        </h2>
    </x-slot>

    <div class="container h-100">
        <div class="d-flex justify-content-center align-items-center">
            <a href="{{ url('/access-room') }}" class="btn btn-info">Access Room</a>
        </div>
    </div>
</x-app-layout>
