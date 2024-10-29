// composables/useCsrfToken.ts
import { useRuntimeConfig } from '#imports'

export const useCsrfToken = async () => {
  const config = useRuntimeConfig()
  const apiBase = config.public.apiBase
  const response = await fetch(`${apiBase}/sanctum/csrf-cookie`, {
    method: 'GET',
    credentials: 'include',
  })
  if (!response.ok) {
    throw new Error('Failed to fetch CSRF token')
  }
}