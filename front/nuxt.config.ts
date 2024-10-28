// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2024-04-03',
  devtools: { enabled: true },
  postcss: {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
    },
  },
  css: ['~/assets/css/main.css'],
  runtimeConfig: {
    public: {
      apiBase: process.env.NUXT_BACKEND_URL,
    }
  },
  modules: ['@pinia/nuxt', 'nuxt-auth-utils'],
  pinia: {
    storesDirs: ['~/stores']
  },
})