<x-app-layout>
    <div class="flex">
        <div class="relative min-w-[300px]">
            <div class="grid fixed justify-between min-w-[300px]  h-[100vh] px-[30px] py-[20px]">
                <div>
                    <div class="flex max-h-[100px] gap-[15px] justify-start  items-start">
                        <img class='w-[40px] h-[40px]' src="{{asset('/storage/text-to-speech.png')}}" alt="">
                        <a class="text-[18px] pt-[8px] font-medium" href="/">Text To Speech</a>
                    </div>
                    <div class="grid items-start mt-[30px]">
                        @if (Request::path() !== 'audios')
                        <a class=" p-4 bg-slate-400" href="/">Home</a>
                        <a class=" p-4" href="/audios">Audios</a>
                        @else
                        <a class=" p-4" href="/">Home</a>
                        <a class=" p-4 bg-slate-400" href="/audios">Audios</a>
                        @endif
                    </div>
                </div>

                <div class="flex justify-center items-end gap-[55px] ">
                    <p
                        class="bg-[#000] rounded-full text-[#fff] w-fit p-[20px] h-[45px] text-center pt-[8px]"
                    >
                        {{ Auth::user()->name }}
                    </p>
                    <p class="mb-[10px]">
                        <livewire:logout />
                    </p>
                </div>
            </div>
        </div>
        <livewire:Home />
    </div>
</x-app-layout>
