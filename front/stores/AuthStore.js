// import axios from "axios";
// import { defineStore } from "pinia";

// export const useAuthStore = defineStore("auth", () => {
//   const apiBase = "http://localhost:8080";

//   const user = ref(null);
//   const isLogged = ref(false);
//   const links = ref(null);
//   axios.defaults.withCredentials = true;
//   axios.defaults.withXSRFToken = true;
//   //check if user is logged in

//   async function authenticateUser(email, password) {
//     await axios.get("http://localhost:8080/sanctum/csrf-cookie");
//     try {
//       const response = await axios.post("http://localhost:8080/login", {
//         email: email,
//         password: password,
//       });
//       const userdata = await axios.get("http://localhost:8080/api/user");
//       user.value = userdata.data;
//       console.log(response.data);
//       return response.data;
//     } catch (error) {
//       // Handle login error here
//       console.error(error);
//       return error;
//     }
//   }

//   function fetchUser() {
//     axios
//       .get(`${apiBase}/api/user`)
//       .then((response) => {
//         user.value = response.data;
//         isLogged.value = true;
//       })
//       .catch(() => {
//         user.value = null;
//         isLogged.value = false;
//       });
//   }

//   function logout() {
//     axios.post(`${apiBase}/logout`).then(() => {
//       user.value = null;
//       isLogged.value = false;
//       //delete cookies XSRF-TOKEN and laravel_session
//       // Clear the authentication cookies
//       document.cookie =
//         "XSRF-TOKEN=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
//       document.cookie =
//         "laravel_session=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
//     });
//   }

//   async function userLinks() {
//     axios
//       .get(`${apiBase}/api/linkof/${user.value.id}`)
//       .then((response) => {
//         links.value = response.data.links;
//         console.log(links.value);
//       })
//       .catch(() => {
//         links.value = null;
//       });
//   }

//   return {
//     user,
//     isLogged,
//     links,
//     fetchUser,
//     authenticateUser,
//     logout,
//     userLinks,
//   };
// });
