function fetcher(method) {

    return (url, data = {}, options = {}) => {

        return fetch(url,{
            method,
            headers: {
                'Content-Type': 'application/json',
                'Accept' : 'application/json',
            },
            body: Object.keys(data).length
                ? JSON.stringify(data)
                : undefined,
            ...options
        })
            .then(response => {
                if(response.status === 410){
                    window.location.href = '/logout';
                }
                return response.json();
            })
    }
}

export default {
    get : fetcher('get'),
    post : fetcher('post'),
    put : fetcher('put'),
    remove : fetcher('delete')
}
