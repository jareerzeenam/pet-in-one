export default class Gate {
    constructor(user) {
        this.user = user;
    }

    isAdmin() {
        return this.user.type === "admin";
    }
    isUser() {
        return this.user.type === "user";
    }
    // ! Allow permission to admin and Author
    isAdminOrAuthor() {
        if (this.user.type === "admin" || this.user.type === "author") {
            return true;
        }
    }
    // ! Allow permission to user and Author
    isUserOrAuthor() {
        if (this.user.type === "user" || this.user.type === "author") {
            return true;
        }
    }
}
