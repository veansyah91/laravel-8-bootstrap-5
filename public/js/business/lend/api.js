const token = `Bearer ${localStorage.getItem('token')}`;
const business = document.querySelector('#content').dataset.business;
const businessName = document.querySelector('#content').dataset.businessName;
const identity = document.querySelector('#content').dataset.identity;

const getData = async (url) => {
    let response = await axios.get(url, {
        headers:{
            Authorization : token
        }
    })

    return response.data.data;
}

const getAccounts = async (search, is_cash) => {
    let url = `/api/${business}/account?search=${search}&is_cash=${is_cash}`

    let result = await axios.get(url, {
        headers:{
            Authorization : token
        }
    }) 

    return result.data.data;
}

const getNewNoRef = async (url) => {
    let result = await axios.get(url, {
        headers:{
            Authorization : token
        }
    });
    return result.data.data;
}

const postData= async (data) => {
    let url = `/api/${business}/lend`;
    
    let result = await axios.post(url, data, {
        headers:{
            Authorization : token
        }
    }) 

    return result.data.data;
}

const putData= async (data, id) => {
    let url = `/api/${business}/lend/${id}`;

    let result = await axios.put(url, data, {
        headers:{
            Authorization : token
        }
    }) 

    return result.data.data;
}

const destroyData= async (id) => {
    let url = `/api/${business}/lend/${id}`;
    
    let result = await axios.delete(url, {
        headers:{
            Authorization : token
        }
    }) 

    return result.data.data;
}
