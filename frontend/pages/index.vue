<template>
  <div class="container mx-auto">
    <div class="w-full flex items-start my-12">
      <div class="w-1/2">
        <h1 class="mb-8 text-z-orange font-bold text-[64px] leading-[100%]">Учи таджикский ультуру  таджикского народа </h1>
        <p class="mb-8 text-gray-500 text-lg">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
        <div>
         <nuxt-link class="border-2 rounded-md px-12 py-4 bg-z-orange border-transparent focus:outline-none text-white text-lg focus:border-red-300" to="">Стать студентом</nuxt-link>
        </div>
      </div>
      <div class="w-1/2 h-full">
        <img src="/header.svg" alt="">
      </div>
    </div>

    <div>
      <h1 class="text-[36px] leading-[25px] text-gray-800 font-medium">Все курсы</h1>
      <div class="w-full flex flex-wrap0">
        <div class="lg:w-1/4 my-8 mr-6">
          <CardVideo />
        </div>
        <div class="lg:w-1/4 my-8 mr-6">
          <CardVideo />
        </div>
        <div class="lg:w-1/4 my-8 mr-6">
          <CardVideo />
        </div>
        <div class="lg:w-1/4 my-8">
          <CardVideo />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
}
</script>
