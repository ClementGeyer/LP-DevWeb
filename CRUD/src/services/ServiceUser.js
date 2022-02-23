import axios from 'axios'

const BASE_URL = 'http://localhost:8888/LP-DevWeb/TP-Final/public/index.php/api/users'

async function getUsers()
{
  return await axios.get(BASE_URL, {
    headers: {
      'Authorization': `Bearer ` + localStorage.getItem('usertoken')
    }
  });
}

async function getUser(id)
{
  return await axios.get(BASE_URL+'/'+id, {
    headers: {
      'Authorization': `Bearer ` + localStorage.getItem('usertoken')
    }
  });
}

async function postUser(data)
{
  return await axios.post(BASE_URL, data, {
    headers: {
      'Authorization': `Bearer ` + localStorage.getItem('usertoken')
    }
  })
}

async function putUser(id, data)
{
  return await axios.put(BASE_URL+'/'+id, data, {
    headers: {
      'Authorization': `Bearer ` + localStorage.getItem('usertoken')
    }
  })
}

async function deleteUser(id)
{
  return await axios.delete(BASE_URL+'/'+id, {
    headers: {
      'Authorization': `Bearer ` + localStorage.getItem('usertoken')
    }
  });
}

async function authenticate(username, password)
{
    return axios({url: 'http://localhost:8888/TP-Final/public/index.php/authentication_token', data: {username:username, password:password}, method: 'POST' }) //username et password proviennent du formulaire
          .then(resp => {
            const token = resp.data.token
            const userData = atob(resp.data.token.split('.')[1]) //on récupère les données de l'utilisateur, par défaut, login, rôles
            localStorage.setItem('user', userData) // store the user in localstorage
            localStorage.setItem('usertoken', token) // store the token in localstorage
          })
          .catch(() => {
            localStorage.removeItem('user-token') // if the request fails, remove any possible user token if possible
          })
}

export {getUsers, getUser, postUser, deleteUser, putUser, authenticate }