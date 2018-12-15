import axios from 'axios';

const httpClient = axios.create({
  baseURL: '/api/',
  headers: {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'Content-Type': 'application/json',
    'X-Requested-With': 'XMLHttpRequest'
  }
});

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
