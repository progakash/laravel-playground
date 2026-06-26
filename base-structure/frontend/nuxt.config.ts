export default defineNuxtConfig({
  devtools: { enabled: true },
  compatibilityDate: '2024-11-01',

  routeRules: {
    '/api/**': { proxy: 'http://local.base/api/**' },
  },
})
