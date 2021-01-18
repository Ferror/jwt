import client from 'axios'

export default {
    getToken: function () {
        client
            .get('localhost:8000/authentication')
            .then((response) => {
                console.log(response);
            })

        return {};
    }
}
