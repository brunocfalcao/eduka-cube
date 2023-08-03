<!DOCTYPE html>
<html dir="ltr">
    <head>
        <title>Mastering Nova</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:regular,600,700%7CTitillium+Web:300,regular,600" media="all">
        @vite('resources/css/app.css')
        <!-- local webpage styles -->
        <style type="text/css">
            .bg-hero {
                background-image: url('{{  Vite::asset('resources/assets/images/background.svg') }}');
            }
        </style>
    </head>
    <body class="bg-black antialiased">

        <x-eduka::responsive-brackets />

        <div id="app">

            <!-- Green rounded spheres background -->
            <div class="absolute -z-1 w-full bg-hero h-screen inset-0 bg-cover"></div>

            <!-- ## nav desktop/mobile common styles (TODO: Make it sticky and transparent) -->
            <nav>
                <div class="px-6 pt-6">
                    <!-- nav visible in desktop devices -->
                    <nav class="hidden md:flex justify-between items-center">
                        <a href="#" class="flex gap-4">
                            <img class="h-8 w-auto" src="{{  Vite::asset('resources/assets/images/logo.png') }}" />
                            <p class="text-2xl font-bold text-white">Mastering Nova</p>
                        </a>
                        <div>
                            <ul class="flex gap-10 font-bold">
                                <li><a href="#" class="link-primary">About</a></li>
                                <li class="text-white link-primary">The Course</li>
                                <li class="text-white link-primary">Pricing</li>
                                <li class="text-white link-primary">Contact me</li>
                            </ul>
                        </div>
                    </nav>
                    <!-- nav visible in desktop devices -->
                    <nav class="flex md:hidden justify-between items-center">
                        <a href="#" class="flex gap-4">
                            <img class="h-8 w-auto" src="{{  Vite::asset('resources/assets/images/logo.png') }}" />
                            <p class="text-2xl font-bold text-white">Mastering Nova</p>
                        </a>
                        <!-- Hamburger menu group (thumbnail + content) -->
                        <div>
                            <!-- hamburger thumbnail -->
                            <a class="space-y-2" data-bs-toggle="offcanvas" role="button" aria-controls="offcanvasExample" href="#offcanvasExample">
                                <div class="w-8 h-0.5 bg-aquacyan"></div>
                                <div class="w-8 h-0.5 bg-aquacyan"></div>
                                <div class="w-8 h-0.5 bg-aquacyan"></div>
                            </a>
                            <div class="offcanvas offcanvas-start fixed bottom-0 flex flex-col max-w-full bg-white invisible bg-clip-padding shadow-sm outline-none transition duration-300 ease-in-out text-bombay-700 top-0 left-0 border-none w-96" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                                <div class="offcanvas-header flex items-center justify-between p-4">
                                    <h5 class="offcanvas-title mb-0 leading-normal font-semibold" id="offcanvasExampleLabel">Offcanvas</h5>
                                    <button type="button" class="btn-close box-content w-4 h-4 p-2 -my-5 -mr-2 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body flex-grow p-4 overflow-y-auto">
                                    <div>
                                        Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
                                    </div>
                                    <div class="dropdown relative mt-4">
                                        <button class="dropdown-toggle inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg active:text-white transition duration-150 ease-in-out flex items-center whitespace-nowrap dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                            Dropdown button
                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-down" class="w-2 ml-2" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                                <path fill="currentColor" d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
                                            </svg>
                                        </button>
                                        <ul class="dropdown-menu min-w-max absolute hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded-lg shadow-lg mt-1 hidden m-0 bg-clip-padding border-none" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-bombay-700 hover:bg-bombay-100" href="#">Action</a></li>
                                            <li><a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-bombay-700 hover:bg-bombay-100" href="#">Another action</a></li>
                                            <li><a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-bombay-700 hover:bg-bombay-100" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </nav>

            <!-- ## Hero section -->
            <section class="section-default">
                <div class="flex-stop-wrap-at-xl items-center justify-center gap-12">
                    <!-- Hero left section -->
                    <div class="{{ TW::default('space-y-6 w-full')->xl('w-1/2')->css() }}">
                        <button class="badge-vermilion">
                            <x-fab-laravel />
                            <span>Official Laravel course</span>
                        </button>
                        <!-- Hero left baseline after the official badge -->
                        <div class="space-y-9">
                            <p class="{{ TW::default('text-5xl text-white')->lg('text-6xl')->xl('text-7xl')->css() }}">
                                Learn Laravel Nova better than Astronauts learn at NASA
                            </p>
                            <p class="text-xl text-bombay-300">Tons of fun learning the best admin panel for Laravel, made by the creators of the
                                best PHP framework in the world
                            </p>
                            <!-- Purchase / watch video buttons (hidden in responsive context) -->
                            <div class="hidden flex-stop-wrap-at-lg xl:block xl:space-x-5">
                                <x-eduka::button-primary
                                    color="aquacyan"
                                    width="w-auto"
                                    target="_blank"
                                    href="https://www.publico.pt">
                                    <x-slot:svg>
                                        <svg aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </x-slot>
                                    Purchase Course - 80 USD
                                </x-eduka::button-primary>

                                <x-eduka::button-secondary
                                    color="bombay"
                                    width="w-auto"
                                    target="_blank"
                                    href="https://www.publico.pt">
                                    <x-slot:svg>
                                        <svg aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" stroke-linecap="round"></path>
                                        </svg>
                                    </x-slot>
                                    Watch free videos
                                </x-eduka::button-primary>
                            </div>
                        </div>
                    </div>
                    <!-- Hero right section (image) -->
                    <div class="w-full xl:w-1/2">
                        <img class="rounded-xl" src="{{  Vite::asset('resources/assets/images/hero.png') }}" />
                    </div>
                </div>
            </section>

            <!-- Testimonials section -->
            <section>
                <div class="relative isolate overflow-hidden py-24">
                    <div class="section-title">
                        <p>Trusted by the creators of Nova</p>
                        <p>The official Nova course supported by the creators of Nova</p>
                    </div>

                    <!-- Testimonial content for each text -->
                    <div class="relative">
                        <div class="w-2/5 bg-bombay-100 relative h-64 overflow-hidden rounded-xl mx-auto">
                            <!-- Testimonial container -->
                            <div id="testimonial-item-1"  class="hidden duration-700 ease-in-out">
                                <div class="py-9 px-6">
                                    <div class="flex px-8 gap-4">
                                        <div class="border-l-[6px] border-bombay-900"></div>
                                        <p class="text-2xl font-italic py-4 leading-relaxed">
                                        Bruno made a great course that shows the best of the Laravel Nova, A to Z and we decided to make this course an official Laravel course!</p>
                                    </div>
                                    <div class="flex flex-col px-8 gap-y-1 pt-6 text-md font-bold">
                                        <p>Mohamed Said</p>
                                        <p class="text-sm text-bombay-500">Laravel Nova Team member</p></div>
                                </div>
                            </div>
                            <div id="testimonial-item-2" class="hidden duration-700 ease-in-out">
                                <div class="py-9 px-6">
                                    <div class="flex px-8 gap-4">
                                        <div class="border-l-[6px] border-bombay-900"></div>
                                        <p class="text-2xl font-italic py-4 leading-relaxed">Tons of hours that Bruno got to squeeze the best of Laravel Nova into this great course, and you get the Orion version for free!</p>
                                    </div>
                                    <div class="flex flex-col px-8 gap-y-1 pt-6 text-md font-bold">
                                        <p>Taylor Otwell</p>
                                        <p class="text-sm text-bombay-500">Creator of Laravel</p></div>
                                </div>
                            </div>
                            <div id="testimonial-item-3" class="hidden duration-700 ease-in-out">
                                <div class="py-9 px-6">
                                    <div class="flex px-8 gap-4">
                                        <div class="border-l-[6px] border-bombay-900"></div>
                                        <p class="text-2xl font-italic py-4 leading-relaxed">This course have stuff that I didn't know it was possible to create on Nova. If you want to get the best out of it, this course is a must-have!</p>
                                    </div>
                                    <div class="flex flex-col px-8 gap-y-1 pt-6 text-md font-bold">
                                        <p>David Hemphill</p>
                                        <p class="text-sm text-bombay-500">Co-Creator of Laravel</p></div>
                                </div>
                            </div>
                            <div id="testimonial-item-4" class="hidden duration-700 ease-in-out">
                                <div class="py-9 px-6">
                                    <div class="flex px-8 gap-4">
                                        <div class="border-l-[6px] border-bombay-900"></div>
                                        <p class="text-2xl font-italic py-4 leading-relaxed">I know Bruno since my first days in Laravel, and he placed all of his energy building the best course for Nova. I saw it, and I am super stocked with its quality!</p>
                                    </div>
                                    <div class="flex flex-col px-8 gap-y-1 pt-6 text-md font-bold">
                                        <p>Nuno Maduro</p>
                                        <p class="text-sm text-bombay-500">Laravel Core Team member</p></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Links for each slide -->
                    <div class="pt-10 flex items-center justify-center gap-16">
                        <a href="#!" class="testimonial-link selected" id="testimonial-indicator-1" aria-current="true" aria-label="Slide 1">
                            <img class="h-16 rounded-full w-auto mx-auto" src="{{  Vite::asset('resources/assets/images/crynobone.jpg') }}" />
                            <p class="text-bombay-100">Mohamed Said</p>
                        </a>
                        <a href="#!" class="testimonial-link" id="testimonial-indicator-2" aria-current="false" aria-label="Slide 2">
                            <img class="h-16 rounded-full w-auto mx-auto" src="{{  Vite::asset('resources/assets/images/taylor-otwell.jpg') }}" />
                            <p class="text-bombay-100">Taylor Otwell</p>
                        </a>
                        <a href="#!" class="testimonial-link" id="testimonial-indicator-3" aria-current="false" aria-label="Slide 3">
                            <img class="h-16 rounded-full w-auto mx-auto" src="{{  Vite::asset('resources/assets/images/david-hemphill.jpg') }}" />
                            <p class="text-bombay-100">David Hemphill</p>
                        </a>
                        <a href="#!" class="testimonial-link" id="testimonial-indicator-4" aria-current="false" aria-label="Slide 4">
                            <img class="h-16 rounded-full w-auto mx-auto" src="{{  Vite::asset('resources/assets/images/nuno-maduro.jpg') }}">
                            <p class="text-bombay-100">Nuno Maduro</p>
                        </a>
                    </div>
                </div>
            </section>

            <section class="section-default">
                <div class="section-title">
                    <p>Tons of videos to answer your needs</p>
                    <p>For both Orion and Silver Surfer versions</p>
                </div>
                <div class="flex items-center justify-center mb-6 gap-12 text-lg">
                    <a id="silversurfer_link" href="#!" onclick="switchToPanel('orion')" class="link-primary selected">Silver Surfer (4.x) videos</a>
                    <a id="orion_link" href="#!" onclick="switchToPanel('silversurfer')" class="link-primary">Orion (3.x) videos</a>
                </div>
                <div class="flex items-center justify-center p-y-8">

                    <div class="flex gap-12" id="silversurfer_container">
                        <img class="w-1/2" src="https://picsum.photos/200/200?random=1" />
                        <img class="w-1/2" src="https://picsum.photos/200/200?random=2" />
                        <img class="w-1/2" src="https://picsum.photos/200/200?random=3" />
                        <img class="w-1/2" src="https://picsum.photos/200/200?random=4" />
                    </div>

                    <div class="flex gap-12 hidden" id="orion_container">
                        <img class="w-1/2" src="https://picsum.photos/200/200?random=5" />
                        <img class="w-1/2" src="https://picsum.photos/200/200?random=6" />
                        <img class="w-1/2" src="https://picsum.photos/200/200?random=7" />
                        <img class="w-1/2" src="https://picsum.photos/200/200?random=8" />
                    </div>

                </div>
            </section>

        </div>
        @vite(['resources/js/app.js', 'resources/js/views/prelaunched.js'])

        <script>
            document.addEventListener("DOMContentLoaded", function(){

            });

            function switchToPanel(targetVersion) {

                var sourceVersion = targetVersion == 'orion' ? 'silversurfer' : 'orion';

                var targetLink = document.getElementById(targetVersion + '_link');
                var sourceLink = document.getElementById(sourceVersion + '_link');

                console.log(targetLink);

                return;


                var panelsContainer = link.parentElement.parentElement.children[2];

                console.log(panelsContainer.innerHTML);

                return;

                document.getElementById(toHide).classList.add('hidden');
                //slide1.classList.remove('selected');
                document.getElementById(toShow).classList.remove('hidden');
            }

        </script>

    </body>
</html>
