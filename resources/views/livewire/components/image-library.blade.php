<div class="space-y-2">
    @if ($product_images)
        <div class="border border-dotted border-primary rounded-lg">
            @foreach ($product_images as $image)
                <div class="flex space-x-4 items-center relative border-b-primary border-b border-dotted last:border-none cursor-move hover:bg-base-200/50">
                    <div class="flex flex-col space-y-2">
                        <div class="tooltip" data-tip="remove">
                            <button type="button"
                                class="btn normal-case !inline-flex lg:tooltip lg:tooltip-top btn-sm btn-ghost btn-circle">
                                <svg class="inline w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                    data-slot="icon">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <div class="tooltip" data-tip="crop">
                            <button type="button"
                                class="btn normal-case !inline-flex lg:tooltip lg:tooltip-top btn-sm btn-ghost btn-circle">
                                <svg class="inline w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                    data-slot="icon">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="py-2 tooltip" data-tip="change">
                        <img src="{{ $image->temporaryUrl() }}"
                            class="h-24 cursor-pointer border-2 rounded-lg hover:scale-105 transition-all ease-in-out">
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    {{-- @if(is_array($product_images))
    <p>Variable ini adalah array.</p>
@else
    <p>Variable ini bukan array.</p>
@endif --}}
    <input type="file" name="" x-ref="image_library" wire:model="product_images" multiple accept="image/*" @change="progress = 1">
    {{-- <x-progress class="progress-primary h-1" indeterminate /> --}}
    <button type="button" class="btn btn-block" @click="$refs.image_library.click()" >
        <div class="flex justify-center items-center space-x-1 w-full">
            <svg class="dark:stroke-[#c7c6c6] stroke-[#171717]" width="20px" height="20px" viewBox="0 0 24 24"
                fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <circle cx="12" cy="12" r="10" class="dark:stroke-[#c7c6c6] stroke-[#171717]"
                        stroke-width="1.5"></circle>
                    <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15"
                        class="dark:stroke-[#c7c6c6] stroke-[#171717]" stroke-width="1.5" stroke-linecap="round"></path>
                </g>
            </svg>
            <h4>Add images</h4>
        </div>
    </button>
</div>
