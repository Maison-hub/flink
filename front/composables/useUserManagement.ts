export default function useUserManagement() {
  const client = useSanctumClient();

  const updateProfilePicture = async (inputFile: File) => {
    if (!(inputFile instanceof File)) {
      console.error("Le fichier fourni n'est pas un objet File.");
      return;
    }
    //transfor file in blob
    const formData = new FormData();
    formData.append("picture", inputFile);
    console.log(formData.entries());
    const { data, status, error } = await useAsyncData("updateProfilePic", () =>
      client.native("http://localhost:8000/user/picture", {
        method: "PATCH",
        body: formData,
      })
    );
    if (status.value === "success") {
      console.log(data.value);
    }
  };

  return { updateProfilePicture };
}
