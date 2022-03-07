import axios from 'axios'

const BASE_URL = 'http://localhost:8888/LP-DevWeb/TP-Final/public/index.php/api/users'

async function getUsers()
{
  return await axios.get(BASE_URL);
}

async function getUser(id)
{
  return await axios.get(BASE_URL+'/'+id);
}

async function postUser(data)
{
  return await axios.post(BASE_URL, data)
}

async function putUser(id, data)
{
  return await axios.put(BASE_URL+'/'+id, data)
}

async function deleteUser(id)
{
  return await axios.delete(BASE_URL+'/'+id);
}

export {getUsers, getUser, postUser, deleteUser, putUser }