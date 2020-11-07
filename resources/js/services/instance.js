import axios from 'axios';

const apiUrl = process.env.MIX_APP_URL + "/api";

const instance = axios.create({
	baseURL: apiUrl,
	timeout: 1000,
});

instance.interceptors.request.use(function (config) {
    // Do something before request is sent
    return config;
  }, function (error) {
    // Do something with request error
    return Promise.reject(error);
  });

// Add a response interceptor
instance.interceptors.response.use(function (response) {
    // Any status code that lie within the range of 2xx cause this function to trigger
    // Do something with response data
    return response;
  }, function (error) {
    // Any status codes that falls outside the range of 2xx cause this function to trigger
    // Do something with response error
    return Promise.reject(error);
  });

instance.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

export default instance;
