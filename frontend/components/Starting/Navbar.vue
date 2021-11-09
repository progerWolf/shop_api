<template>
    <div class="border-b-2">
        <div class="container mx-auto">
            <div class="w-full flex items-center justify-between">
                <div >
                    <img src="/logo.svg" width="160" alt="">
                </div>
                <div>
                    <a href="#" class="mx-2">Категории</a>
                </div>
                <form class="relative w-full mx-3">
                    <input type="text" class="w-full rounded-md border-2 border-gray-700 px-4 py-2" placeholder="Найдите свой курс">
                    <button class="absolute top-3 right-3">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 19L13 13M15 8C15 8.91925 14.8189 9.82951 14.4672 10.6788C14.1154 11.5281 13.5998 12.2997 12.9497 12.9497C12.2997 13.5998 11.5281 14.1154 10.6788 14.4672C9.82951 14.8189 8.91925 15 8 15C7.08075 15 6.1705 14.8189 5.32122 14.4672C4.47194 14.1154 3.70026 13.5998 3.05025 12.9497C2.40024 12.2997 1.88463 11.5281 1.53284 10.6788C1.18106 9.82951 1 8.91925 1 8C1 6.14348 1.7375 4.36301 3.05025 3.05025C4.36301 1.7375 6.14348 1 8 1C9.85652 1 11.637 1.7375 12.9497 3.05025C14.2625 4.36301 15 6.14348 15 8Z" stroke="#1E1718" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </form>
                <div class="flex mx-3">
                    <nuxt-link class="mx-1 border-2 rounded-md px-6 py-2 border-z-orange text-z-orange hover:bg-z-orange hover:text-white" to="">Войти</nuxt-link>
                    <nuxt-link class="mx-1 border-2 rounded-md px-3 py-2 bg-z-orange border-z-orange text-white" to="">Регистрация</nuxt-link>
                    <div class="flex items-center mx-1 border-2 border-gray-700 rounded-md px-3 py-2">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 10C19 12.3869 18.0518 14.6761 16.364 16.364C14.6761 18.0518 12.3869 19 10 19M19 10C19 7.61305 18.0518 5.32387 16.364 3.63604C14.6761 1.94821 12.3869 1 10 1M19 10H1M10 19C7.61305 19 5.32387 18.0518 3.63604 16.364C1.94821 14.6761 1 12.3869 1 10M10 19C11.657 19 13 14.97 13 10C13 5.03 11.657 1 10 1M10 19C8.343 19 7 14.97 7 10C7 5.03 8.343 1 10 1M10 1C7.61305 1 5.32387 1.94821 3.63604 3.63604C1.94821 5.32387 1 7.61305 1 10" stroke="#1E1718" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="ml-2">Языки</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>