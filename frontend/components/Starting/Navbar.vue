<template>
    <div class="border-b-2">
        <div class="container mx-auto">
            <div class="w-full flex items-center justify-between py-3">
                <div class="flex items-center">
                    <img src="/logo.png" class="rounded-full" width="48px" alt="">
                    <!-- <button @click="showNavbar = !showNavbar" class="lg:hidden inline-block float-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                    </button> -->
                    <ul class="hidden lg:flex items-center">
                        <li class="ml-2">
                            <a href="#" class="ml-6 flex">
                                <svg class="text-brand" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="16"><path fill-rule="evenodd" clip-rule="evenodd" d="M9 9.75a2.628 2.628 0 01-2.625-2.625A2.628 2.628 0 019 4.5a2.628 2.628 0 012.625 2.625A2.628 2.628 0 019 9.75zM9 1.5c-3.308 0-6 2.665-6 5.942 0 4.106 5.287 8.684 5.512 8.877a.748.748 0 00.976 0C9.713 16.127 15 11.548 15 7.442 15 4.165 12.308 1.5 9 1.5z"></path></svg>
                                <span class="text-sm">Душанбе</span>
                            </a>
                        </li>
                        <li class="ml-2">
                            <nuxt-link class="rounded-md px-3 py-2 hover:bg-brand hover:text-white text-sm" to="">Магазин</nuxt-link>
                        </li>
                    </ul>
                </div>
                <div class="flex items-center lg:mx-3">
                    <nuxt-link class="mx-2 border-2 rounded-md px-6 py-2 border-brand text-brand bg-brand text-white text-sm" to="">Заказать доставку</nuxt-link>
                    <button class="lg:hidden" @click="showNavbar = !showNavbar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                    </button>     
                    <template class="lg:inline-block hidden" v-if="!$auth.loggedIn">
                        <nuxt-link class="mx-1 border-2 rounded-md px-3 py-2 bg-brand border-brand text-white text-sm" to="/login">Вход</nuxt-link>
                    </template>
                    <template v-else>
                        <div class="relative text-left lg:inline-block hidden">
                            <div class="">
                                <button @click="dd_profile = !dd_profile" type="button" class="inline-flex items-center justify-center w-full rounded-md border-2 border-brand shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:border-brand" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                <span class="">{{ $auth.user.name }}</span>
                                <img class="pl-1" :src="$auth.user.avatar ? $auth.user.avatar : '/user.svg'" alt="">
                                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                            <div v-show="dd_profile" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none z-50" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                <div class="py-1" role="none">
                                    <a href="#" class="text-gray-700 group flex items-center px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">
                                        <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>
                                        Учётная запись
                                    </a>
                                    <a href="#" class="text-gray-700 group flex items-center px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                                        Настройки
                                    </a>
                                    <button type="button" @click="logout" class="text-gray-700 group flex items-center px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                        Выйти
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
            <div class="lg:hidden inline-block w-full mb-3">
                <ul class="flex items-center flex-wrap">
                    <li class="w-full py-2 border-b">
                        <a href="#" class="flex">
                            <svg class="text-brand" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="16"><path fill-rule="evenodd" clip-rule="evenodd" d="M9 9.75a2.628 2.628 0 01-2.625-2.625A2.628 2.628 0 019 4.5a2.628 2.628 0 012.625 2.625A2.628 2.628 0 019 9.75zM9 1.5c-3.308 0-6 2.665-6 5.942 0 4.106 5.287 8.684 5.512 8.877a.748.748 0 00.976 0C9.713 16.127 15 11.548 15 7.442 15 4.165 12.308 1.5 9 1.5z"></path></svg>
                            <span class="">Душанбе</span>
                        </a>
                    </li>
                    <li class="w-full py-2 border-b">
                        <nuxt-link class="rounded-md py-2" to="">Магазин</nuxt-link>
                    </li>
                </ul>
                <div class="mt-3">
                    <template class="lg:inline-block hidden" v-if="!$auth.loggedIn">
                        <nuxt-link class="mx-1 border-2 rounded-md px-3 py-2 bg-brand border-brand text-white text-sm" to="/login">Вход</nuxt-link>
                    </template>
                    <template v-else>
                        <div class="relative text-left mt-3">
                            <div class="">
                                <button @click="dd_profile = !dd_profile" type="button" class="inline-flex items-center justify-center rounded-md border-2 border-brand shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:border-brand" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                <span class="">{{ $auth.user.name }}</span>
                                <img class="pl-1" :src="$auth.user.avatar ? $auth.user.avatar : '/user.svg'" alt="">
                                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                            <div v-show="dd_profile" class="origin-top-right right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none z-50" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                <div class="py-1" role="none">
                                    <a href="#" class="text-gray-700 group flex items-center px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">
                                        <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>
                                        Учётная запись
                                    </a>
                                    <a href="#" class="text-gray-700 group flex items-center px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                                        Настройки
                                    </a>
                                    <button type="button" @click="logout" class="text-gray-700 group flex items-center px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                        Выйти
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default({
    data() {
        return {
            dd_profile: false,
            showNavbar: false
        }
    },

    methods: {
        disableOurSide (e) {
            if (!this.$el.contains(e.target)) {
                this.dd_profile = false
            }
        },
        logout() {
            this.$axios.post('/auth/logout')
            .then(res => {
                window.location.href = '/'
            })
        }
    },
    mounted () {
        document.addEventListener('click', this.disableOurSide)
    },
    beforeDestroy () {
        document.removeEventListener('click',this.disableOurSide)
    },
})
</script>
