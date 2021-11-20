<template>
  <div class="container mx-auto">
    <div class="w-full flex items-center my-12">
      <div class="w-1/2">
        <h1 class="mb-8 text-brand font-bold text-[48px] leading-[100%]">Срочная доставка по РТ</h1>
        <p class="mb-8 text-gray-500 text-lg">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
        <div>
         <nuxt-link class="border-2 rounded-md px-12 py-4 bg-brand border-transparent focus:outline-none text-white text-lg focus:border-red-300" to="">Заказать доставку</nuxt-link>
        </div>
      </div>
      <div class="w-1/2 h-full">
        <form class="rounded-lg bg-gray-100 p-6 w-full lg:w-10/12 xl:w-2/3">
          <div class="relative">
            <input type="text" class="form-control py-2 pl-8 pr-3 text-gray-700" placeholder="Адрес отправки">
            <svg class="text-gray-700 absolute top-2 left-2" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="20"><path fill-rule="evenodd" clip-rule="evenodd" d="M9 9.75a2.628 2.628 0 01-2.625-2.625A2.628 2.628 0 019 4.5a2.628 2.628 0 012.625 2.625A2.628 2.628 0 019 9.75zM9 1.5c-3.308 0-6 2.665-6 5.942 0 4.106 5.287 8.684 5.512 8.877a.748.748 0 00.976 0C9.713 16.127 15 11.548 15 7.442 15 4.165 12.308 1.5 9 1.5z"></path></svg>
          </div>
          <div class="relative mt-3">
            <input type="text" class="form-control py-2 pl-8 pr-3 text-gray-700" placeholder="Адрес доставки">
            <svg class="text-gray-700 absolute top-2 left-2" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="20"><path fill-rule="evenodd" clip-rule="evenodd" d="M9 9.75a2.628 2.628 0 01-2.625-2.625A2.628 2.628 0 019 4.5a2.628 2.628 0 012.625 2.625A2.628 2.628 0 019 9.75zM9 1.5c-3.308 0-6 2.665-6 5.942 0 4.106 5.287 8.684 5.512 8.877a.748.748 0 00.976 0C9.713 16.127 15 11.548 15 7.442 15 4.165 12.308 1.5 9 1.5z"></path></svg>
          </div>
          <div class="flex justify-between mt-3">
            <button type="button" class="tab active">
              Пешком
            </button>
            <button type="button" class="tab">
              Автомобилем
            </button>
            <button type="button" class="tab">
              Грузовиком
            </button>
          </div>
          <div class="mt-3">
            Рассчитать стоимость
          </div>
          <div class="mt-3">
            Заказ без регистрации, оплата по факту доставки
          </div>
        </form>
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
