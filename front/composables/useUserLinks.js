export default function useUserLinks() {
  const client = useSanctumClient();
  const links = ref([]);

  const getLinks = async () => {
    const { data, status, error } = await useAsyncData("users", () =>
      client("/api/user/links")
    );
    if (status.value === "success") {
      links.value = data.value;
    } else if (status.value === "error") {
      console.error(error.value);
    }
  };

  onMounted(getLinks);

  return { links, getLinks };
}
