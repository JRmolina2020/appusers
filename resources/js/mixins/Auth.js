let user = document.querySelector('meta[name="user"]');
module.exports = {
    computed: {
        currentUser() {
            return JSON.parse(user.content);
        },
        isAuthenticated() {
            return !!user.content;
        }
    }
};
