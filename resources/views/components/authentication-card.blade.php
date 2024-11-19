<div class="min-h-screen  py-20" style="background-image: linear-gradient(115deg, #08345b, #3e98b9)">
    <div class="flex flex-col lg:flex-row w-10/12 lg:w-8/12 bg-white rounded-xl mx-auto shadow-lg overflow-hidden">
        <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-12 bg-no-repeat bg-cover bg-center" style="background-image: url('{{ asset('storage/Background.png') }}');">
            <h1 class="text-white text-3xl mb-3">Welcome</h1>
            <div>
                <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean suspendisse aliquam varius rutrum purus maecenas ac <a href="#" class="text-purple-500 font-semibold">Learn more</a></p>
            </div>
        </div>
    <div class="w-full lg:w-1/2 py-16 px-12">
        <div class="flex flex-col lg:flex-row w-full lg:w-1/2  bg-white rounded-xl mx-auto shadow-lg">
            {{ $logo }}
        </div>
        {{ $slot }}
    </div>
</div>
