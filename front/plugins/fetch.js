export default defineNuxtPlugin((nuxtApp) => {
  const runtimeConfig = useRuntimeConfig();

  nuxtApp.$fetch = $fetch.create({
    baseURL: runtimeConfig.public.backendUrl,
    credentials: "include", // Include cookies in requests
  });
});
