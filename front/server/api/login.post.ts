// import { useRuntimeConfig} from "nuxt/app";

export default defineEventHandler(async (event) => {
    const body = await readBody(event)
    const {email, password} = body;
    // const config = useRuntimeConfig()
    // const apiBase = config.public.apiBase
    //Make login request to the backend server
    const response = await fetch(`http://localhost:8080/api/login`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({email, password, device_name: 'web'}),
    });
    if (!response.ok) {
        return createError({
            statusCode: 401,
            statusMessage: 'Invalid email or password',
        });
    }
    const data = await response.json();
    await setUserSession(event, {
        user: data.user,
        token: data.token,
        loggedInAt: new Date(),
    });
    return {
        statusCode: 200,
        user: data.user,
    };
});