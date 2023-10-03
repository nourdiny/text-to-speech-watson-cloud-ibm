<div>

    @if (Request::path() === 'audios')
    <div class="m-auto py-4">
        <h1 class="text-[25px] mb-[30px]">All Audios</h1>
    </div>
    <div class="mb-[50px]">
        @if (count($allaudios) > 0)
            @foreach ($allaudios as $audio)
                <div class="mt-6 sm:mt-10 relative z-10 rounded-xl shadow-xl">
                    <div
                        class="bg-white border-slate-100 transition-all duration-500 dark:bg-slate-800 transition-all duration-500 dark:border-slate-500 border-b rounded-t-xl p-4 pb-6 sm:p-10 sm:pb-8 lg:p-6 xl:p-10 xl:pb-8 space-y-6 sm:space-y-8 lg:space-y-6 xl:space-y-8"
                    >
                        <div class="space-y-2">
                            <div class="relative p-[20px]">
                                <div class="w-full p-[10px]">
                                    <p class="">{{$audio->content}}</p>
                                    <img
                                        wire:click="delete({{$audio->id}})"
                                        class="cursor-pointer w-[30px] absolute top-0 right-0"
                                        src="{{ asset('storage/delete.png') }}"
                                        alt=""
                                    />
                                </div>
                                <audio controls class="w-full mt-[15px]">
                                    <source
                                        src="{{ asset('storage/'. $audio->path_audio) }}"
                                        type="audio/mpeg"
                                    />
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        @else
        <div class="mt-6 sm:mt-10 relative z-10 rounded-xl shadow-xl">
            <div
                class="bg-white border-slate-100 transition-all duration-500 dark:bg-slate-800 transition-all duration-500 dark:border-slate-500 border-b rounded-t-xl p-4 pb-6 sm:p-10 sm:pb-8 lg:p-6 xl:p-10 xl:pb-8 space-y-6 sm:space-y-8 lg:space-y-6 xl:space-y-8"
            >
                <div class="space-y-2">
                    <div class="relative p-[20px]">
                        <p>nuull</p>
                    </div>
                </div>
            </div>
        </div>

        @endif
    </div>
    @else
    <div class="m-auto py-4">
        <h1 class="text-[25px] mb-[30px]">Home</h1>
        <form wire:submit="save" class="bg-white p-4 rounded shadow-lg">
            <div class="w-full">
                <textarea
                    wire:model="textPost"
                    placeholder="text to speech"
                    name="tweetContent"
                    class="pl-2 outline-none w-full p-2 border rounded-lg bg-gray-200 resize-none"
                ></textarea>
            </div>
            @if ($class)
            <div class="flex justify-between items-center">
            @else
            <div class=" hidden justify-between items-center">
            @endif
                <select
                    wire:model="voice"
                    class=" min-w-fitt block px-4 py-2 bg-white border rounded focus:outline-none focus:ring focus:border-blue-500"
                >
                    @foreach ($voices as $language => $genders)
                    <optgroup label="{{ $language }}">
                        @foreach ($genders as $gender => $voices) 
                            @foreach ($voices as $voiceName => $ga)
                            <option value="{{ $voiceName }}">
                                {{ $voiceName }}
                            </option>
                            @endforeach 
                        @endforeach
                    </optgroup>
                    @endforeach
                </select>
                <button
                    type="submit"
                    class="flex justify-between items-center gap-[12px] cursor-pointer"
                >
                    <img
                        class="w-[40px]"
                        src="{{ asset('storage/send.png') }}"
                        alt=""
                        srcset=""
                    />
                </button>
            </div>
        </form>
    </div>

    <div class="mb-[50px]">
        @if (count($audios) > 0)
            @foreach ($audios as $audio)
                <div class="mt-6 sm:mt-10 relative z-10 rounded-xl shadow-xl">
                    <div
                        class="bg-white border-slate-100 transition-all duration-500 dark:bg-slate-800 transition-all duration-500 dark:border-slate-500 border-b rounded-t-xl p-4 pb-6 sm:p-10 sm:pb-8 lg:p-6 xl:p-10 xl:pb-8 space-y-6 sm:space-y-8 lg:space-y-6 xl:space-y-8"
                    >
                        <div class="space-y-2">
                            <div class="relative p-[20px]">
                                <div class="w-full p-[10px]">
                                    <p class="">{{$audio->content}}</p>
                                    <img
                                        wire:click="delete({{$audio->id}})"
                                        class="cursor-pointer w-[30px] absolute top-0 right-0"
                                        src="{{ asset('storage/delete.png') }}"
                                        alt=""
                                    />
                                </div>
                                <audio controls class="w-full mt-[15px]">
                                    <source
                                        src="{{ asset('storage/'. $audio->path_audio) }}"
                                        type="audio/mpeg"
                                    />
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        @else
        <div class="mt-6 sm:mt-10 relative z-10 rounded-xl shadow-xl">
            <div
                class="bg-white border-slate-100 transition-all duration-500 dark:bg-slate-800 transition-all duration-500 dark:border-slate-500 border-b rounded-t-xl p-4 pb-6 sm:p-10 sm:pb-8 lg:p-6 xl:p-10 xl:pb-8 space-y-6 sm:space-y-8 lg:space-y-6 xl:space-y-8"
            >
                <div class="space-y-2">
                    <div class="relative p-[20px]">
                        <p>nuull</p>
                    </div>
                </div>
            </div>
        </div>

        @endif
    </div>
    @endif
</div>
