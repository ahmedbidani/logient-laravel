<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Laravel</title>

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

	<!-- Scripts -->
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
	<div
		class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
		@if (Route::has('login'))
		<div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
			@auth
			<a href="{{ url('/home') }}"
				class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
			@else
			<a href="{{ route('login') }}"
				class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
				in</a>

			@if (Route::has('register'))
			<a href="{{ route('register') }}"
				class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
			@endif
			@endauth
		</div>
		@endif
		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
					<div class="p-6 text-gray-900 dark:text-gray-100">
						<h1 class="font-bold">{{ __('List of short links') }}</h2>
						<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
							<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
								<thead
									class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
									<tr>
										<th scope="col" class="px-6 py-3">
											Url
										</th>
										<th scope="col" class="px-6 py-3">
											Short Url
										</th>
										<th scope="col" class="px-6 py-3">
											Creation Date
										</th>
									</tr>
								</thead>
								<tbody>
									@foreach($links as $link)
									<tr>
										<td class="px-6 py-4">
											<a href="{{ url($link->url) }}" target="_blank"
												class="text-blue-600 underline">
												{{ $link->url }}
											</a>
										</td>
										<td class="px-6 py-4">
											<a href="{{ url($link->url) }}" target="_blank"
												class="text-blue-600 underline">
												{{ 'http://localhost/' . $link->short_url }}</a>
										</td>
										<td class="px-6 py-4">
											{{ $link->created_at }}
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
	</div>
</body>

</html>