import axios from 'axios';
import cookies from 'js-cookie';

const dev = process.env.NODE_ENV !=='production';

const httpClient = axios.create({
  baseURL: dev ? '/' : '/event2018/miyakawa/',
  headers: {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'Content-Type': 'application/json',
    'X-Requested-With': 'XMLHttpRequest'
  }
});

httpClient.interceptors.request.use(config => {
  const token = cookies.get('passport-token');
  if (token) {
    config.headers['Authorization'] = `Bearer ${token}`;
  }
  return config;
})

const get = async (path, params) => {
  return await httpClient.get(path, { params: params });
};

const post = async (path, params) => {
  return await httpClient.post(path, params);
};

const del = async (path, params) => {
  return await httpClient.delete(path, { data: params });
};

export default {
  get,
  post,
  delete: del
}
