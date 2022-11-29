import http from '../axios/index.js';

export async function user(data) {

    const response = await http.get(`/api/user`);
    return await response;
}