<template>
  <!--
    This example requires updating your template:

    ```
    <html class="h-full bg-gray-50">
    <body class="h-full">
    ```
  -->
  <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <img class="mx-auto h-32 w-auto rounded-full" src="/logo.png" alt="Workflow" />
      <h2 class="my-4 text-center text-3xl font-extrabold text-gray-900">
          Регистрация
      </h2>
    </div>

    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form class="space-y-4" @submit.prevent="submit">
            <div v-if="errorMessage">
                <span class="text-xs text-red-500">{{ errorMessage }}</span>
            </div>
          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">
              Номер телефон
            </label>
            <div class="mt-1 flex">
              <div class="w-24">
                <v-select :options="country_codes" label="name" :searchable="false" :clearable="false" class="region-selector" v-model="register.countryCode">
                  <template slot="option" slot-scope="option">
                      {{ option.flag }}
                      {{ option.name }}
                  </template>
                    <template #selected-option="{ iso, flag }">
                        <div class="flex items-center absolute top-2">
                            <span>{{ flag }}</span>
                            <span class="pl-1">{{ iso }}</span>
                        </div>
                    </template>
                    <template #search="{attributes, events}">
                        <input
                        class="vs__search"
                        :required="!register.country_code"
                        v-bind="attributes"
                        v-on="events"
                        />
                    </template>
                </v-select>
              </div>
              <input oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" :disabled="!register.countryCode.id || showRegister" v-model="register.phone" :maxlength="register.countryCode.maxlength" :minlength="register.countryCode.minlength" id="phone" name="phone" type="phone" autocomplete="phone" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-tr-md rounded-br-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
            <div class="mt-4">
              <!-- {{ loadingConfirmCode || Object.keys(register.countryCode).length == 0  register.phone == '' }} -->
              <button v-if="!showRegister" :disabled="loadingConfirmCode || Object.keys(register.countryCode).length == 0 || register.phone == ''" @click="checkNumber" type="button" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <template v-if="loadingConfirmCode || (Object.keys(register.countryCode).length == 0 && register.phone == '')">
                  <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  Повторите через: {{ confirmTime }}
                </template>
                <template v-else>
                  Получить код
                </template>
              </button>
            </div>
          </div>

          <template v-if="showConfirm">
             <div class="flex justify-between items-end">
              <div>
                <label for="name" class="block text-sm font-medium text-gray-700">
                    Смс-код
                </label>
                <div class="mt-1">
                  <input oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" :disabled="!(register.countryCode.id && register.phone.length >= register.countryCode.minlength)" v-model="confirm_code" id="name" name="name" type="text" autocomplete="current-password" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                </div>
              </div>
              <button @click="confirmNumber" :disabled="!(register.countryCode.id && register.phone.length >= register.countryCode.minlength)" type="button" class="flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Подтвердить
              </button>
            </div>
          </template>

          <template v-if="showRegister">
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700">
                  Пароль
              </label>
              <div class="mt-1">
                <input v-model="register.password" minlength="8" id="password" name="password" type="password" autocomplete="current-password" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
              </div>
            </div>

            <div>
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                  Повторите пароль
              </label>
              <div class="mt-1">
                <input v-model="register.password_confirmation" minlength="8" id="password_confirmation" name="password_confirmation" type="password" autocomplete="current-password" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
              </div>
            </div>

            <div>
              <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <template v-if="loading">
                  <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  Загрузка
                </template>
                <template v-else>
                  Сбросить пароль
                </template>
              </button>
            </div>
          </template>

            <div class="text-sm">
                <nuxt-link to="login" class="font-medium text-indigo-600 hover:text-indigo-500">
                    Войти
                </nuxt-link>
            </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

export default({
    layout: 'auth',
    components: {
        vSelect
    },
    data() {
        return {
            country_codes: [],
            register: {
                name: '',
                phone: '',
                password: '',
                password_confirmation: '',
                country_code: 0,
                countryCode: {},
            },
            errorMessage: '',
            showRegister: false,
            showConfirm: false,
            loadingConfirmCode: false,
            confirm_code: '',
            confirmTime: "00:00",
            resent: true,
            loading: false
        }
    },
    mounted() {
        this.$axios.get('/countrycode')
        .then(res => {
            this.country_codes = res.data.data
            if (this.country_codes) {
                this.register.countryCode = this.country_codes[0]
            }            
        })
    },

    methods: {
        submit() {
            if (!this.register.countryCode) return 0
            this.errorMessage = ''
            this.loading = true
            this.register.country_code = this.register.countryCode.id
            this.$axios.post('/auth/change-password', this.register)
            .then(res => {
                this.loading = false
                this.$router.push('/login')
            })
            .catch(errors => {
                  if (errors.response.data.message) {
                      this.errorMessage = errors.response.data.message 
                  } else if (errors.response.data.error) {
                      this.errorMessage = errors.response.data.error 
                  } else {
                      this.errorMessage = errors.response.data[Object.keys(errors.response.data)[0]][0]
                  }
                  this.loading = false
            })
        },

        checkNumber() {
          this.$axios.post('/auth/check-number', {
            phone: this.register.phone,
            country_code: this.register.countryCode.id,
            reset: true
          })
          .then(res => {
            this.confirmTimer(5)
            this.showConfirm = true
          })
          .catch(errors => {
                if (errors.response.data.message) {
                    this.errorMessage = errors.response.data.message 
                } else if (errors.response.data.error) {
                    this.errorMessage = errors.response.data.error 
                } else {
                    this.errorMessage = errors.response.data[Object.keys(errors.response.data)[0]][0]
                }
          })
        },

        confirmNumber() {
          this.$axios.post('/auth/confirm-number', {
            phone: this.register.phone,
            country_code: this.register.countryCode.id,
            confirm_code: this.confirm_code
          })
          .then(res => {
            this.showConfirm = false
            this.showRegister = true
          })
          .catch(errors => {
                if (errors.response.data.message) {
                    this.errorMessage = errors.response.data.message 
                } else if (errors.response.data.error) {
                    this.errorMessage = errors.response.data.error 
                } else {
                    this.errorMessage = errors.response.data[Object.keys(errors.response.data)[0]][0]
                }
          })
        },
        confirmTimer(duration) {
            let _this = this
            this.resent = false
            this.loadingConfirmCode = true
            var timer = duration, minutes, seconds;
            let clearTimer = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;
                _this.confirmTime = minutes + ":" + seconds
                if (--timer < 0) {
                    _this.confirmTime = '00:00'
                    _this.resent = true
                    _this.loadingConfirmCode = false
                    clearInterval(clearTimer)
                }
            }, 1000);
        }
    }
})
</script>

<style>
    .region-selector .vs__dropdown-toggle {
        padding: 0 0 8px;
        border-right: none !important;
        border-top-left-radius: 0.375rem;
        border-top-left-radius: 0.375rem;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }
    .region-selector .vs__open-indicator{
            margin-top: 5px;
    }

    @media screen and (max-width: 640px) {
        .region-selector .vs__dropdown-toggle {
            padding: 0 0 12px !important;
        }
    }
</style>