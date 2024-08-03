<template>
    <div class="size-full pt-20 grid md:grid-cols-6 items-center justify-around max-w-6xl">
        <div class="lg:col-span-2 md:col-span-3 md:text-left text-center sm:pl-2">
            <div>
                <h5 class="font-medium text-gray-600 dark:text-gray-200">
                    Hello Welcome
                </h5>
                <h1 class="sm:text-5xl text-4xl !leading-normal dark:text-white relative">
                    I'm <span class="text-primary">Water_Chick</span> <br />
                    Java developer
                </h1>
                <a href="#portfolio">
                    <button class="btn btn-outline mt-5">
                        <i class="fa-solid fa-up-right-from-square"></i>
                        {{ $t('portfolioBtn') }}
                    </button>
                </a>
            </div>
            <div class="md:w-96 md:ml-auto flex mt-9 gap-2 dark:text-gray-300">
                <p class="text-xs text-balance leading-5 max-w-md px-2 mx-auto">
                    {{ $t('aboutText') }}
                </p>
            </div>
            <div class="flex items-center justify-center mt-9 gap-6 dark:text-gray-200 text-gray-600">
                <p class="text-xs">{{ $t('follow') }}</p>
                <div class="flex gap-3">
                    <a href="https://github.com/WaterChick" target="_blank">
                        <i class="fa-brands fa-github"></i>
                    </a>
                    <a href="https://www.instagram.com/waterchickmc/" target="_blank">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="lg:col-span-2 md:col-span-3">
            <SmallLogo />
        </div>
        <div
            class="lg:col-span-2 md:col-span-6 lg:bg-gradient-to-l md:bg-none mt-2 bg-gradient-to-l dark:from-slate-800 from-gray-100 lg:h-96 md:h-auto h-96 w-full"
        >
            <ul
                class="text-2xl data-[slot=count]:*:text-3xl data-[slot=count]:*:font-bold leading-[3.14rem] text-center pt-5 lg:block md:flex items-center justify-between"
            >
                <li data-slot="count">3+</li>
                <div class="flex flex-row justify-center items-center gap-1.5">
                    <li>{{ $t('experiences') }}</li>
                    <span class="text-primary">{{ $t('experiencesSpan') }}</span>
                </div>
                <br />
                <li data-slot="count">20+</li>
                <div class="flex flex-row justify-center items-center gap-1.5">
                    <li>{{ $t('completed') }}</li>
                    <span class="text-primary">{{ $t('completedSpan') }}</span>
                </div>
            </ul>
        </div>
    </div>
</template>
<script setup lang="ts">
import SmallLogo from "@/Components/SmallLogo.vue";
</script>

