import http from '../axios/index.js';

export async function questions(data) {

    const response = await http.get(`/api/questions`, data);
    return await response;
}

export async function survey(data) {

    const response = await http.post(`/api/questions/submit`, { questions: data });
    return await response;
}