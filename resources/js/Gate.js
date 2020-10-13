export default class Gate {
    constructor(user) {
        this.user = user;
    }

    isAdmin() {
        return this.user.type === 'administrator';
    }
    isUser() {
        return this.user.type === 'user'
    }
    isAuthor() {
        return this.user.type === 'author'
    }
    isAdminOrAuthor() {
        if(this.user.type === 'administrator' || this.user.type === 'author') {
            return true;
        }
    }
}
