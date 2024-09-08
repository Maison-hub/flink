// composables/useAuth.js

import { ref } from "vue";

export function useAuth() {
  const user = ref(null);
  const loading = ref(false);
  const error = ref(null);

  const csrf = async () => {
    await $fetch("/sanctum/csrf-cookie"); // Fetch CSRF token
  };

  const login = async (credentials) => {
    loading.value = true;
    error.value = null;

    try {
      await csrf(); // Ensure CSRF token is set
      await $fetch("/login", {
        method: "POST",
        body: credentials,
      });
      await getUser(); // Fetch authenticated user
    } catch (err) {
      error.value = err;
    } finally {
      loading.value = false;
    }
  };

  const getUser = async () => {
    try {
      user.value = await $fetch("/api/user");
    } catch (err) {
      user.value = null;
    }
  };

  const logout = async () => {
    await $fetch("/logout", { method: "POST" });
    user.value = null;
  };

  return {
    user,
    loading,
    error,
    login,
    logout,
    getUser,
  };
}
