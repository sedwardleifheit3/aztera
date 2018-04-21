/**
 *  API CORE
 * @note API_KEY is declared as global variable in layouts/app.blade.php
 * @type {{BASE_URL: string, token: null}}
 */
window.API = {
    BASE_URL: '/api/v1/',
    token: null,
    getAxiosInstance: function () {
        if (_.isUndefined(API_KEY)) return false;
        
        return axios.create({
            baseURL: window.location.origin + '/api/v1',
            headers: {
                common: {
                    'Authorization': 'Bearer ' + API_KEY,
                }
            }
        });
    }

};
