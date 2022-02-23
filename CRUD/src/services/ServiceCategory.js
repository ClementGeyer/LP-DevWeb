import axios from 'axios'

const BASE_URL = 'http://localhost:8888/LP-DevWeb/TP-Final/public/index.php/api/categories'

async function getCategories()
{
  return await axios.get(BASE_URL, {
    headers: {
      'Authorization': `Bearer ` + localStorage.getItem('usertoken')
    }
  });
}

async function getCategorie(id)
{
  return await axios.get(BASE_URL+'/'+id, {
    headers: {
      'Authorization': `Bearer ` + localStorage.getItem('usertoken')
    }
  });
}

async function postCategorie(data)
{
  return await axios.post(BASE_URL, data, {
    headers: {
      'Authorization': `Bearer ` + localStorage.getItem('usertoken')
    }
  });
}

async function putCategory(id, data)
{
  return await axios.put(BASE_URL+'/'+id, data, {
    headers: {
      'Authorization': `Bearer ` + localStorage.getItem('usertoken')
    }
  })
}

async function deleteCategorie(id)
{
  return await axios.delete(BASE_URL+'/'+id, {
    headers: {
      'Authorization': `Bearer ` + localStorage.getItem('usertoken')
    }
  });
}

export {getCategories, getCategorie, postCategorie, deleteCategorie, putCategory }