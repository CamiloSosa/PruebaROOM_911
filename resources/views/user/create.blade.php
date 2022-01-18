<x-app-layout>
	<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center; height: 2vw;">
            Create Form
        </h2>
    </x-slot>

	@include('user.form', ['action' => url("/user"),  'text' => 'Create'])

</x-app-layout>
