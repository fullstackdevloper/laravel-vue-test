import axios from 'axios'

const http = axios.create({
    baseURL: import.meta.env.VITE_APP_URL,
    timeout: 1000
  });

  http.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.getItem('token');

  export default http