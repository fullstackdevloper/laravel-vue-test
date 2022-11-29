import http from '../axios/index.js';

export async function login(data) {

    const response = await http.post(`/api/login`, data);
    return await response;
}

export async function register(data) {
    const response = await http.post(`/api/register`, data);
    return await response;
}