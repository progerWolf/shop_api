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
          Войти
      </h2>
    </div>

    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form class="space-y-6" @submit.prevent="submit">
          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">
              Номер телефон
            </label>
            <div class="mt-1 flex">
              <div class="w-24">
                <v-select :options="country_codes" label="name" :searchable="false" :clearable="false" class="region-selector" v-model="login.countryCode">
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
                        :required="!login.country_code"
                        v-bind="attributes"
                        v-on="events"
                        />
                    </template>
                </v-select>
              </div>
              <input :disabled="!login.countryCode.id" v-model="login.phone" :maxlength="login.countryCode.maxlength" :minlength="login.countryCode.minlength" id="phone" name="phone" type="phone" autocomplete="phone" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-tr-md rounded-br-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">
                Пароль
            </label>
            <div class="mt-1">
              <input v-model="login.password" minlength="8" id="password" name="password" type="password" autocomplete="current-password" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>
          <div v-if="errorMessage">
              <span class="text-xs text-red-500">{{ errorMessage }}</span>
          </div>

          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <input v-model="login.remember_me" id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" />
              <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                Запомнить меня
              </label>
            </div>

            <div class="text-sm">
              <nuxt-link to="/forgot-password" class="font-medium text-indigo-600 hover:text-indigo-500">
                Забыли свой пароль?
              </nuxt-link>
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
                Войти
              </template>
            </button>
          </div>

            <div class="text-sm">
                <nuxt-link to="register" class="font-medium text-indigo-600 hover:text-indigo-500">
                    Регистрация
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
            login: {
                phone: '',
                password: '',
                country_code: 0,
                countryCode: {},
                remember_me: false
            },
            errorMessage: '',
            loading: false
        }
    },
    mounted() {
        this.$axios.get('/countrycode')
        .then(res => {
            this.country_codes = res.data.data
            if (this.country_codes) {
                this.login.countryCode = this.country_codes[0]
            }            
        })
    },

    methods: {
        submit() {
            if (!this.login.countryCode) return 0
            this.errorMessage = ''
            this.loading = true
            this.login.country_code = this.login.countryCode.id
            this.$auth.loginWith('laravelJWT', {data: this.login}).then(res=> {
                this.loading = false
                this.$router.push('/profile')
            }).catch(errors=> {
                if (errors.response.data.message) {
                    this.errorMessage = errors.response.data.message 
                } else if (errors.response.data.error) {
                    this.errorMessage = errors.response.data.error 
                } else {
                    this.errorMessage = errors.response.data[Object.keys(errors.response.data)[0]][0]
                }
                this.loading = false
            })
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