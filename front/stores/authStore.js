import { defineStore } from "pinia";

export const useAuthStore = defineStore("auth", () => {
  const { login, getUser, logout } = useAuth();
  const user = ref(null);
  const loading = ref(true);

  const isLoggedIn = computed(() => !!user.value);

  async function attemptLogin(data) {
    try {
      await login(data);
      user.value = await getUser();
    } catch (err) {
      console.error(err);
    }
  }

  async function fetchUser() {
    user = await getUser();
  }

  async function logoutStore() {
    try {
      await logout();
      user.value = null;

      return navigateTo("/login", { replace: true });
    } catch (err) {
      // handle errors
    }
  }

  return {
    attemptLogin,
    fetchUser,
    logoutStore,
    user,
    isLoggedIn,
  };
});
