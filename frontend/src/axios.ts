import axios from 'axios';

const axiosClient = axios.create({
    baseURL: import.meta.env.BACKEND_URL,
    withCredentials: true,
    withXSRFToken: false,
})

axiosClient.interceptors.request.use(config => {
    const token = localStorage.getItem('token')
    if (token) {
        config.headers.Authorization = `Bearer ${token}`
    }
    return config
})

axiosClient.interceptors.response.use(response => {
    return response;
}, error => {
    if (error.response && error.response.status === 401) {
        localStorage.removeItem('token')
        window.location.href = '/login'
    }
    throw error;
})

export default axiosClient;