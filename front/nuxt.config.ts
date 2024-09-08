// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2024-04-03',
  devtools: { enabled: true },

  runtimeConfig: {
    public: {
      backendUrl: 'http://localhost:8080'
    }
  },
  modules: ['@pinia/nuxt'],
  pinia: {
    storesDirs: ['~/stores']
  },
})