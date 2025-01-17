const token = `Bearer ${localStorage.getItem('token')}`;

const getContact = async (url) => {
    let response = await axios.get(url, {
        headers:{
            Authorization : token
        }
    })

    return response.data.data;
}

const getAccounts = async (search, is_cash) => {
    let url = `/api/account?search=${search}&is_cash=${is_cash}`

    let result = await axios.get(url, {
        headers:{
            Authorization : token
        }
    }) 

    return result.data.data;
}

const getNewNoRef = async (type) => {
    let url = `/api/no-ref-contact-recomendation?type=${type}`
    let result = await axios.get(url, {
        headers:{
            Authorization : token
        }
    }) 

    return result.data.data;
}

const postContact = async (data) => {
    let url = `/api/contact`;
    
    let result = await axios.post(url, data, {
        headers:{
            Authorization : token
        }
    }) 

    return result.data.data;
}

const putContact = async (data, id) => {
    let url = `/api/contact/${id}`;

    let result = await axios.put(url, data, {
        headers:{
            Authorization : token
        }
    }) 

    return result.data.data;
}

const destroyContact = async (id) => {
    let url = `/api/contact/${id}`;
    
    let result = await axios.delete(url, {
        headers:{
            Authorization : token
        }
    }) 

    return result.data.data;
}