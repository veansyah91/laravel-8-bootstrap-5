const token = `Bearer ${localStorage.getItem('token')}`;

const getFixedAsset = async (url) => {
    let response = await axios.get(url, {
        headers:{
            Authorization : token
        }
    })

    return response.data.data;
}

const getAccounts = async (search, is_cash = '') => {
    let url = `/api/account?search=${search}&is_cash=${is_cash}`

    let result = await axios.get(url, {
        headers:{
            Authorization : token
        }
    }) 

    return result.data.data;
}

const getNewNoRef = async () => {
    let url = `/api/no-ref-fixed-asset-recomendation`
    let result = await axios.get(url, {
        headers:{
            Authorization : token
        }
    }) 

    return result.data.data;
}

const postFixedAsset = async (data) => {
    let url = `/api/fixed-asset`;
    
    let result = await axios.post(url, data, {
        headers:{
            Authorization : token
        }
    }) 

    return result.data.data;
}

const putFixedAsset = async (data, id) => {
    let url = `/api/fixed-asset/${id}`;

    let result = await axios.put(url, data, {
        headers:{
            Authorization : token
        }
    }) 

    return result.data.data;
}

const destroyFixedAsset = async (id) => {
    let url = `/api/fixed-asset/${id}`;
    
    let result = await axios.delete(url, {
        headers:{
            Authorization : token
        }
    }) 

    return result.data.data;
}

const fixedAssetDepreciation = async () => {
    let url = `/api/fixed-asset-depreciation`;
    
    let result = await axios.get(url, {
        headers:{
            Authorization : token
        }
    }) 

    return result.data.data;
}