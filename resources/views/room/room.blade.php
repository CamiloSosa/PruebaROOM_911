<x-app-layout>
	<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center; height: 2vw;">
            Room 911
        </h2>
    </x-slot>

    <a href="{{ url('/room-logout') }}" class="btn btn-info">Get out of room 911</a>
</x-app-layout>
