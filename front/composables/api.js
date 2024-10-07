export const $api = (url, options = {}, headers = {}) => {
  // axios.defaults.baseURL = runtimeConfig.public.apiBase;

  axios.defaults.withCredentials = true;
  axios.defaults.withXSRFToken = true;
  axios.defaults.headers = {
    ...headers,
    Accept: "application/json",
    "Content-Type": "application/json",
    referer: "http://localhost:3000",
  };
  return axios(runtimeConfig.public.apiBase + url, options);
};
