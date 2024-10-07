import { ref, onMounted } from "vue";
import axios from "axios";

export default function useAuth() {
  const user = ref(null);
  const errors = ref(null);
  const isAuthenticated = ref(false);

  const runtimeConfig = useRuntimeConfig();
  const router = useRouter();

  axios.defaults.baseURL = runtimeConfig.public.apiBase;
  axios.defaults.withCredentials = true;
  axios.defaults.withXSRFToken = true;

  const csrf = async () => {
    await axios.get("/sanctum/csrf-cookie");
  };

  const login = async (credentials) => {
    errors.value = null;
    try {
      await csrf();
      await axios.post("/login", credentials);
    } catch (error) {
      if (error.response.status === 422) {
        errors.value = error.response.data.errors;
      }
    }
  };

  const logout = async () => {
    await axios.post("/logout");
    user.value = null;
    isAuthenticated.value = false;
    router.push("/login");
  };

  const getUser = async () => {
    try {
      const response = await axios.get("/api/user", {
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          withXSRFToken: true,
        },
      });
      user.value = response.data;
      isAuthenticated.value = true;
    } catch (error) {
      user.value = null;
    }
  };

  onMounted(() => {
    getUser();
  });

  return {
    user,
    errors,
    isAuthenticated,
    login,
    logout,
    getUser,
  };
}
