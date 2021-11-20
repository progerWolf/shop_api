<template>
    <div class="border-b-2">
        <div class="container mx-auto">
            <div class="w-full flex items-center justify-between py-3">
                <div class="flex items-center">
                    <img src="/logo.png" class="rounded-full" width="64px" alt="">
                    <ul class="flex">
                        <li class="ml-2">
                            <a href="#" class="ml-6 flex">
                                <svg class="text-brand" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="24"><path fill-rule="evenodd" clip-rule="evenodd" d="M9 9.75a2.628 2.628 0 01-2.625-2.625A2.628 2.628 0 019 4.5a2.628 2.628 0 012.625 2.625A2.628 2.628 0 019 9.75zM9 1.5c-3.308 0-6 2.665-6 5.942 0 4.106 5.287 8.684 5.512 8.877a.748.748 0 00.976 0C9.713 16.127 15 11.548 15 7.442 15 4.165 12.308 1.5 9 1.5z"></path></svg>
                                <span>Душанбе</span>
                            </a>
                        </li>
                        <li class="ml-2">
                            <nuxt-link class="rounded-md px-3 py-2 hover:bg-brand hover:text-white" to="">Магазин</nuxt-link>
                        </li>
                    </ul>
                </div>
                <div class="flex mx-3">
                    <nuxt-link class="mx-1 border-2 rounded-md px-6 py-2 border-brand text-brand hover:bg-brand hover:text-white" to="">Заказать доставку</nuxt-link>
                    <nuxt-link class="mx-1 border-2 rounded-md px-3 py-2 bg-brand border-brand text-white" to="">Вход / Регистрация</nuxt-link>
                </div>
            </div>
        </div>
    </div>
</template>