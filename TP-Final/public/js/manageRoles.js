function changeRole(userId, role) {    
    fetch(URLChangeUserRole.replace('id', userId), {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({role: role}),
    });
}