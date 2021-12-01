<template>
    <aside class="lg:col-span-3 h-screen">
        <div class="lg:hidden py-3 px-4 border-b-2 flex items-center justify-between">
            <span>Профиль</span> 
            <button class="lg:hidden" @click="showNavbar = !showNavbar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
            </button>           
        </div>
        <nav :class="`lg:pt-2 space-y-1 lg:block transition-all duration-150 ${showNavbar ? '' : 'hidden'}`">
            <div v-for="(item, index) in items" :key="index" @click="showMenu(index, item.childs.length > 0)">
                <nuxt-link :to="item.childs.length > 0 ? '#' : item.link" :class="`navbar-item group ${$nuxt.$route.path.startsWith(item.link) ? 'active' : ''}`" aria-current="page">
                    <div class="flex items-center ">
                        <span v-html="item.icon"></span>
                        <span class="truncate">
                            {{ item.label }}
                        </span>
                    </div>
                    <svg v-if="item.childs.length > 0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"/></svg>
                </nuxt-link>
                <div :class="`pl-8 w-full ${index == activeSubItem && item.childs.length > 0 ? 'inline-block' : 'hidden'}`">
                    <nuxt-link v-for="(subitem, index) in item.childs" :key="index" :to="subitem.link" class="navbar-item group" aria-current="page">
                        <div class="">
                            <span class="truncate">
                                {{ subitem.label }}
                            </span>
                        </div>
                    </nuxt-link>
                </div>
            </div>
        </nav>
    </aside>
</template>

<script>
export default({
    data() {
        return {
            activeSubItem: null,
            showNavbar: false,
            items: [
                {
                    label: 'Заказы',
                    icon: `
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" class="svg-active text-gray-900 flex-shrink-0 -ml-1 mr-3 h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                    `,
                    link: '/profile/orders',
                    childs: [
                        {
                            label: 'Заказы',
                            link: '/profile/orders',
                        },
                        {
                            label: 'Маршрутизация',
                            link: '/profile//orders/deliveries',
                        },
                    ],
                },
                {
                    label: 'Статистика',
                    icon: `
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" class="svg-active text-gray-900 flex-shrink-0 -ml-1 mr-3 h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                    `,
                    link: '/profile/statistics',
                    childs: []
                },
                {
                    label: 'Профиль',
                    icon: `
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" class="svg-active text-gray-900 flex-shrink-0 -ml-1 mr-3 h-6 w-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    `,
                    link: '#',
                    childs: [
                        {
                            label: 'Учётная запись',
                            link: '/profile/change',
                        },
                        {
                            label: 'Настройки',
                            link: '/profile/settings',
                        },
                        {
                            label: 'Контактные лица',
                            link: '/profile/contacts',
                        },
                        {
                            label: 'Промокоды',
                            link: '/profile/referral',
                        },
                        {
                            label: 'Адресная книга',
                            link: '/profile/address-book',
                        },
                    ],
                },
                {
                    label: 'Интеграция',
                    icon: `
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" class="svg-active text-gray-900 flex-shrink-0 -ml-1 mr-3 h-6 w-6"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                    `,
                    link: '/profile/integration',
                    childs: []
                },
            ]
        }
    },

    methods: {
        showMenu(index, hasChilds) {
            if (hasChilds) {
                this.activeSubItem = this.activeSubItem == index ? null : index
            }
        }
    }
})
</script>
