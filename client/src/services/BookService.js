import axios from 'axios';
import config from '../util/config';

function getAllBooks(page, search, order){
    return axios.get(config.SERVER_PATH + config.BOOKS_API_PATH +
        '?page=' + page +
        '&query=' + search +
        '&order=' + order)
}

function getOneBook(id){
    return axios.get(config.SERVER_PATH + config.BOOKS_API_PATH + '/' + id)
}

function updateBook(id, data){
    return axios.put(config.SERVER_PATH + config.BOOKS_API_PATH + '/' + id, data)
}

function deleteBook(id){
    return axios.delete(config.SERVER_PATH + config.BOOKS_API_PATH + '/' + id)
}

function createBook(data) {
    return axios.post(config.SERVER_PATH + config.BOOKS_API_PATH, data)
}

export default {
    getAllBooks,
    getOneBook,
    updateBook,
    deleteBook,
    createBook,
}
