import axios from 'axios'
const API_BASE_URL = process.env.API_BASE_URL

export function login (username, password) {
  return request('/login', 'post', { 'username': username, 'password': password })
}

function request (endpoint, method = 'get', params = null, withCredentials = false) {
  return axios.request({
    baseURL: API_BASE_URL,
    url: endpoint,
    method: method,
    data: params,
    withCredentials: withCredentials
  })
    .catch(error => {
      console.error(error)
      throw (error)
    })
}
