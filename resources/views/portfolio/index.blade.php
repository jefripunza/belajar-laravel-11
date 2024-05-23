@php
    use Carbon\Carbon;
@endphp

<x-layout.portfolio>
    <x-slot:title>
        Portfolio |
        @if ($is_public)
            {{ $user['first_name'] ??= '' }} {{ $user['last_name'] ??= '' }}
        @else
            {{ Auth::user()->first_name ??= '' }} {{ Auth::user()->last_name ??= '' }}
        @endif
    </x-slot:title>
    <x-slot:is_public>{{ $is_public ? 'true' : 'false' }}</x-slot:is_public>

    <div class="bg-gray-100">
        <div class="container mx-auto my-5 p-5">
            <div class="md:flex no-wrap md:-mx-2">
                <!-- Left Side -->
                <div class="w-full md:w-3/12 md:mx-2">
                    <!-- Profile Card -->
                    <div class="bg-white p-3 border-t-4 border-green-400">
                        <div class="image overflow-hidden">
                            <img class="h-auto w-full mx-auto" src="/images/profile/{{ $user['image_url'] }}"
                                alt="" />
                        </div>
                        <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">
                            @if ($is_public)
                                {{ $user['first_name'] ??= '' }} {{ $user['last_name'] ??= '' }}
                            @else
                                {{ Auth::user()->first_name ??= '' }} {{ Auth::user()->last_name ??= '' }}
                            @endif
                        </h1>
                        <h3 class="text-gray-600 font-lg text-semibold leading-6">
                            Owner at Her Company Inc.
                        </h3>
                        <p class="text-sm text-gray-500 hover:text-gray-600 leading-6 mt-3">
                            @if ($is_public)
                                {{ $user['description'] ??= '' }}
                            @else
                                {{ Auth::user()->description ??= '' }}
                            @endif
                        </p>
                        <ul
                            class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">

                            @if (in_array($user['status'], ['find-job', 'im-working', 'hiring']))
                                <li class="flex items-center py-3">
                                    <span>Status</span>
                                    <span class="ml-auto">
                                        <span
                                            class="{{ $user['status'] == 'im-working' ? 'bg-green-500' : '' }}{{ $user['status'] == 'find-job' ? 'bg-yellow-600' : '' }}{{ $user['status'] == 'hiring' ? 'bg-purple-500' : '' }} py-1 px-2 rounded text-white text-sm">
                                            @if ($user['status'] == 'find-job')
                                                Find Job
                                            @elseif ($user['status'] == 'im-working')
                                                I'm Working
                                            @elseif ($user['status'] == 'hiring')
                                                Hiring
                                            @endif
                                        </span>
                                    </span>
                                </li>
                            @endif

                            <li class="flex items-center py-3">
                                <span>Member since</span>
                                <span class="ml-auto">
                                    @if ($is_public)
                                        {{ $user['created_at']->diffForHumans() }}
                                    @else
                                        {{ Auth::user()->created_at->diffForHumans() }}
                                    @endif
                                </span>
                            </li>
                        </ul>
                        @if (!Auth::guest() && ($is_public ? Auth::user()->email == $user['email'] : true))
                            <a href="/edit/portfolio/profile"
                                class="block w-full text-blue-800 text-sm font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4 text-center">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        @endif
                    </div>
                    <!-- End of profile card -->
                    <div class="my-4"></div>
                    <!-- Friends card -->
                    <div class="bg-white p-3 hover:shadow">
                        <div class="flex items-center space-x-3 font-semibold text-gray-900 text-xl leading-8">
                            {{-- <span class="text-green-500">
                                icon
                            </span> --}}
                            <span>Technologies</span>
                        </div>
                        <div class="grid grid-cols-3">
                            <div class="text-center my-2">
                                <img class="h-16 w-16 rounded-full mx-auto"
                                    src="https://cdn.australianageingagenda.com.au/wp-content/uploads/2015/06/28085920/Phil-Beckett-2-e1435107243361.jpg"
                                    alt="" />
                                <a href="#" class="text-main-color">Kojstantin</a>
                            </div>
                            <div class="text-center my-2">
                                <img class="h-16 w-16 rounded-full mx-auto"
                                    src="https://avatars2.githubusercontent.com/u/24622175?s=60&amp;v=4"
                                    alt="" />
                                <a href="#" class="text-main-color">James</a>
                            </div>
                            <div class="text-center my-2">
                                <img class="h-16 w-16 rounded-full mx-auto"
                                    src="https://lavinephotography.com.au/wp-content/uploads/2017/01/PROFILE-Photography-112.jpg"
                                    alt="" />
                                <a href="#" class="text-main-color">Natie</a>
                            </div>
                            <div class="text-center my-2">
                                <img class="h-16 w-16 rounded-full mx-auto"
                                    src="https://bucketeer-e05bbc84-baa3-437e-9518-adb32be77984.s3.amazonaws.com/public/images/f04b52da-12f2-449f-b90c-5e4d5e2b1469_361x361.png"
                                    alt="" />
                                <a href="#" class="text-main-color">Casey</a>
                            </div>
                        </div>
                    </div>
                    <!-- End of friends card -->
                </div>
                <!-- Right Side -->
                <div class="w-full md:w-9/12 mx-2 h-64">
                    <!-- Profile tab -->
                    <!-- About Section -->
                    <div class="bg-white p-3 shadow-sm rounded-sm">
                        <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                            <span clas="text-green-500">
                                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                            <span class="tracking-wide">About</span>
                        </div>
                        <div class="text-gray-700">
                            <div class="grid md:grid-cols-2 text-sm">
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">First Name</div>
                                    <div class="px-4 py-2">
                                        @if ($is_public)
                                            {{ $user['first_name'] ??= '-' }}
                                        @else
                                            {{ Auth::user()->first_name ??= '-' }}
                                        @endif
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Last Name</div>
                                    <div class="px-4 py-2">
                                        @if ($is_public)
                                            {{ $user['last_name'] ??= '-' }}
                                        @else
                                            {{ Auth::user()->last_name ??= '-' }}
                                        @endif
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Gender</div>
                                    <div class="px-4 py-2">
                                        @if ($is_public)
                                            {{ $user['gender'] ??= '-' }}
                                        @else
                                            {{ Auth::user()->gender ??= '-' }}
                                        @endif
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Phone No.</div>
                                    <div class="px-4 py-2">
                                        @if ($is_public)
                                            @if ($user['is_whatsapp_number'])
                                                <a href="https://wa.me/{{ $user['phone_number'] }}" target="_blank"
                                                    class="hover:underline">{{ $user['phone_number'] }}</a>
                                            @else
                                                {{ $user['phone_number'] ??= '-' }}
                                            @endif
                                        @else
                                            {{ Auth::user()->phone_number ??= '-' }}
                                        @endif
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold"> Address</div>
                                    <div class="px-4 py-2">
                                        @if ($is_public)
                                            {{ $user['address'] ??= '-' }}
                                        @else
                                            {{ Auth::user()->address ??= '-' }}
                                        @endif
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Birthday</div>
                                    <div class="px-4 py-2">
                                        @if ($is_public)
                                            {{ $user['birthday_date'] ? Carbon::parse($user['birthday_date'])->format('d F Y') : '-' }}
                                        @else
                                            {{ Auth::user()->birthday_date ? Carbon::parse(Auth::user()->birthday_date)->format('d F Y') : '-' }}
                                        @endif
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Email.</div>
                                    <div class="px-4 py-2">
                                        <a class="text-blue-800"
                                            href="mailto:{{ $is_public ? $user['email'] : Auth::user()->email }}">
                                            @if ($is_public)
                                                {{ $user['email'] ??= '-' }}
                                            @else
                                                {{ Auth::user()->email }}
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (!Auth::guest())
                            <a href="/edit/portfolio/about"
                                class="block w-full text-blue-800 text-sm font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4 text-center">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        @endif
                    </div>
                    <!-- End of about section -->

                    <div class="my-4"></div>

                    <!-- Experience and education -->
                    <div class="bg-white p-3 shadow-sm rounded-sm">
                        <div class="grid grid-cols-2">
                            <div>
                                <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                                    <span clas="text-green-500">
                                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </span>
                                    <span class="tracking-wide">Experience</span>
                                </div>
                                <ul class="list-inside space-y-2">
                                    <li>
                                        <div class="text-teal-600">Owner at Her Company Inc.</div>
                                        <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                    </li>
                                    <li>
                                        <div class="text-teal-600">Owner at Her Company Inc.</div>
                                        <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                    </li>
                                    <li>
                                        <div class="text-teal-600">Owner at Her Company Inc.</div>
                                        <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                    </li>
                                    <li>
                                        <div class="text-teal-600">Owner at Her Company Inc.</div>
                                        <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                                    <span clas="text-green-500">
                                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
                                            <path fill="#fff"
                                                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                        </svg>
                                    </span>
                                    <span class="tracking-wide">Education</span>
                                </div>
                                <ul class="list-inside space-y-2">
                                    <li>
                                        <div class="text-teal-600">Masters Degree in Oxford</div>
                                        <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                    </li>
                                    <li>
                                        <div class="text-teal-600">Bachelors Degreen in LPU</div>
                                        <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- End of Experience and education grid -->
                        @if (!Auth::guest())
                            <a href="/edit/portfolio/content"
                                class="block w-full text-blue-800 text-sm font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4 text-center">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        @endif
                    </div>
                    <!-- End of profile tab -->
                </div>
            </div>
        </div>
    </div>

</x-layout.portfolio>
