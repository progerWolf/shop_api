<template>
    <div>
        <main class="relative">
            <div class="w-full pb-6 lg:pb-16">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="divide-y divide-gray-200 lg:grid lg:grid-cols-12 lg:divide-y-0 lg:divide-x">
                <ProfileNavbar />

                <div class="divide-y divide-gray-200 lg:col-span-9">
                    <!-- Profile section -->
                    <div class="py-6 px-4 sm:p-6 lg:pb-8">
                    <div class="flex items-center justify-between">
                        <h2 class="text-3xl leading-6 font-bold text-gray-900">Профиль</h2>
                    </div>
                        <!-- Tabs -->
                        <div class="mt-6 sm:mt-2 2xl:mt-5">
                            <div class="border-b border-gray-200">
                            <div class="max-w-5xl mx-auto">
                                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                <!-- Current: "border-pink-500 text-gray-900", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
                                <a href="#" class="border-brand text-gray-900 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" aria-current="page">
                                    Общая информация
                                </a>
                                <nuxt-link to="/profile/orders" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-brand whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                    Заказы
                                </nuxt-link>
                                </nav>
                            </div>
                            </div>
                        </div>

                        <!-- Description list -->
                        <div class="mt-6 max-w-5xl mx-auto">
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">
                                Имя
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $auth.user.name }}
                                </dd>
                            </div>

                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">
                                Номер телефон
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $auth.user.phone }}
                                </dd>
                            </div>

                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">
                                    Страна
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $auth.user.country_code_id }}
                                </dd>
                            </div>

                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">
                                    Статус
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    <span class="px-3 py-1 text-xs bg-brand-3 rounded-full">
                                        Клиент
                                    </span>
                                </dd>
                            </div>
                            </dl>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </main>
        </div>
</template>