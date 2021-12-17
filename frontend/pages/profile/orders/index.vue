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
                        <h2 class="text-3xl leading-6 font-bold text-gray-900">Заказы</h2>
                        <div>
                            <a href="#" class="text-indigo-700">
                                Сохранить в *.xls
                            </a>
                        </div>
                    </div>
                        <!-- Tabs -->
                        <div class="mt-6 sm:mt-2 2xl:mt-5">
                            <div class="border-b border-gray-200">
                            <div class="max-w-5xl mx-auto">
                                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                <!-- Current: "border-pink-500 text-gray-900", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
                                <a href="#" class="border-brand text-gray-900 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" aria-current="page">
                                    Все заказы
                                </a>

                                <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-brand whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                    Активные
                                </a>

                                <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-brand whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                    Завершенные
                                </a>

                                <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-brand whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                    Черновики
                                </a>
                                </nav>
                            </div>
                            </div>
                        </div>

                        <!-- Description list -->
                        <div class="mt-6 max-w-5xl mx-auto">
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">
                                Phone
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                (555) 123-4567
                                </dd>
                            </div>

                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">
                                Email
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                ricardocooper@example.com
                                </dd>
                            </div>

                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">
                                Title
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                Senior Front-End Developer
                                </dd>
                            </div>

                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">
                                Team
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                Product Development
                                </dd>
                            </div>

                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">
                                Location
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                San Francisco
                                </dd>
                            </div>

                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">
                                Sits
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                Oasis, 4th floor
                                </dd>
                            </div>

                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">
                                Salary
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                $145,000
                                </dd>
                            </div>

                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">
                                Birthday
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                June 8, 1990
                                </dd>
                            </div>

                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">
                                About
                                </dt>
                                <dd class="mt-1 max-w-prose text-sm text-gray-900 space-y-5">
                                <p>Tincidunt quam neque in cursus viverra orci, dapibus nec tristique. Nullam ut sit dolor consectetur urna, dui cras nec sed. Cursus risus congue arcu aenean posuere aliquam.</p>
                                <p>Et vivamus lorem pulvinar nascetur non. Pulvinar a sed platea rhoncus ac mauris amet. Urna, sem pretium sit pretium urna, senectus vitae. Scelerisque fermentum, cursus felis dui suspendisse velit pharetra. Augue et duis cursus maecenas eget quam lectus. Accumsan vitae nascetur pharetra rhoncus praesent dictum risus suspendisse.</p>
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