export default function (url, options = {}) {
  options.headers = {};
  const runtimeConfig = useRuntimeConfig();

  const token = useCookie("XSRF-TOKEN");

  if (token.value) {
    options.headers["X-XSRF-TOKEN"] = token.value;
  }

  return useFetch(runtimeConfig.public.apiBase + url, {
    ...options,
    credentials: "include",
    headers: {
      ...options.headers,
      Accept: "application/json",
      "Content-Type": "application/json",
      ...useRequestHeaders(["cookie"]),
      referer: "http://localhost:3000",
    },
  });
}
