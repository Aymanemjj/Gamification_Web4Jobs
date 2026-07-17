import axios from 'axios';

const axiosClient = axios.create({
    baseURL: import.meta.env.VITE_BACKEND_URL,
    withCredentials: true,
    withXSRFToken: false,
})

axiosClient.interceptors.request.use(config => {
    const token = localStorage.getItem('credentials')
    if (token) {
        config.headers.Authorization = `Bearer ${token}`
    }
    return config
})

axiosClient.interceptors.response.use(
  response => response,
  error => {
    if (
      error.response?.status === 401 &&
      error.config?.url !== "/login"
    ) {
      localStorage.removeItem("credentials");
      window.location.href = "/login";
    }

    return Promise.reject(error);
  }
);

export default axiosClient;