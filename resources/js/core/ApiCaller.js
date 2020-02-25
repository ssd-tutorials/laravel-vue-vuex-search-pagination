import axios from 'axios';

let headers = {
    'X-Requested-With': 'XMLHttpRequest',
    Accept: 'application/json',
    'Content-Type': 'application/json'
};

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    headers['X-CSRF-TOKEN'] = token.content;
}

const client = axios.create({ headers });

export default {
    request(url, method = 'get', payload = {}, config = {}) {
        let data = {
            url: url,
            method: method.toLowerCase(),
            params: {},
            data: {}
        };

        if (['post', 'put', 'patch'].includes(data.method)) {
            data.data = payload;
        } else {
            data.params = payload;
        }

        return client.request({ ...data, ...config });
    }
};
