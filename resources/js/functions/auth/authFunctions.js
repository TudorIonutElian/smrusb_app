export function checkIfLoggedIn(){
    return localStorage.getItem('isLoggedIn') || false;
}

export function checkIfIsAdmin(){
    return localStorage.getItem('isAdmin') || false;
}

export function getUser(){
    return  JSON.parse(localStorage.getItem('user')) || null;
}
