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
  modules: ['@pinia/nuxt', 'nuxt-auth-sanctum'],
  pinia: {
    storesDirs: ['~/stores']
  },
  sanctum: {
    // use the public backendUrl runtime config
    baseUrl: process.env.NUXT_BACKEND_URL,
    redirect: {
      onLogin: '/board',
      onLogout: '/login',
      keepRequestedRoute: true,
    },
  },
})