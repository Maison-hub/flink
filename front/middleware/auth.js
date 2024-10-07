import { useAuthStore } from "~/stores/authStore";

export default defineNuxtRouteMiddleware(async (to, from) => {
  // const { isAuthenticated, getUser } = useAuth();

  const auth = useAuthStore();

  if (auth.isLoggedIn) {
    navigateTo(to.path);
    return;
  } else {
    await fetchUser();
    if (auth.isLoggedIn) {
      navigateTo(to.path);
      return;
    }
  }
  return navigateTo("/login?redirect=" + to.path);
});
