import axios from 'axios'

const BASE_URL = 'http://localhost:8888/LP-DevWeb/TP-Final/public/index.php/api/categories'

async function getCategories()
{
  return await axios.get(BASE_URL);
}

async function getCategorie(id)
{
  return await axios.get(BASE_URL+'/'+id);
}

async function postCategorie(data)
{
  return await axios.post(BASE_URL, data);
}

async function putCategory(id, data)
{
  return await axios.put(BASE_URL+'/'+id, data)
}

async function deleteCategorie(id)
{
  return await axios.delete(BASE_URL+'/'+id);
}

export {getCategories, getCategorie, postCategorie, deleteCategorie, putCategory }