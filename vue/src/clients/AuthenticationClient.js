import client from 'axios'

export default {
    getToken: function () {
        client
            .create({
                baseURL: 'http://symfony.malcherczyk.localhost'
            })
            .get('/authentication')
            .then((response) => {
                console.log(response);
            })

        return {};
    },
    createToken: function (email, password) {
        client
            .create({
                baseURL: 'http://symfony.malcherczyk.localhost'
            })
            .post(
                '/authentication',
                {
                    login: email,
                    password: password,
                },
                {
                    headers: {
                        'Content-Type': 'application/json',
                    }
                }
            )
            .then((response) => {
                console.log(response);
            });
    }
}
