import axios from 'axios'

const BASE_URL = 'http://localhost:8888/LP-DevWeb/TP-Final/public/index.php/api/works'

async function getWorks()
{
  return await axios.get(BASE_URL);
}

async function getWork(id)
{
  return await axios.get(BASE_URL+'/'+id);
}

async function postWork(data)
{
  return await axios.post(BASE_URL, data).catch(err => console.log(err));
}

async function putWork(id, data)
{
  return await axios.put(BASE_URL+'/'+id, data)
}

async function deleteWork(id)
{
  return await axios.delete(BASE_URL+'/'+id);
}

export {getWorks, getWork, postWork, deleteWork, putWork }