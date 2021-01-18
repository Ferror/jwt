import client from 'axios'

export default {
    getEvents: function () {
        client
            .get('https://5ff2038edb1158001748b736.mockapi.io/events')
            .then((response) => {
                console.log(response.data);
            })
    }
}
