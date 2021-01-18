import client from 'axios'

export default {
    getToken: function () {
        client
            .get('http://localhost:8001/authentication')
            .then((response) => {
                console.log(response);
            })

        return {};
    },
    createToken: function (email, password) {
        client
            .post('http://localhost:8001/authentication', {
                login: email,
                password: password,
            }, {
                headers: {
                    'Content-Type': 'application/json',
                }
            })
            .then((response) => {
                console.log(response);
            });
    }
}
