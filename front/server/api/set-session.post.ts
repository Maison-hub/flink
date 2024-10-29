// import { useRuntimeConfig} from "nuxt/app";
import { defineEventHandler, readBody } from 'h3'

export default defineEventHandler(async (event) => {
    const body = await readBody(event)
    await setUserSession(event, {
        user: body.user,
        token: body.token,
        loggedInAt: new Date(),
    });
    return {
        statusCode: 200,
        user: body.user,
    };
});