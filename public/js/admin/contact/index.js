const searchInput = document.querySelector('#search-input');

const countData = document.querySelector('#count-data');
const prevBtn = document.querySelector('#prev-page');
const nextBtn = document.querySelector('#next-page');

const listData = document.querySelector('#list-data');

const dateDetail = document.querySelector('#date-detail');
const noRefDetail = document.querySelector('#no-ref-detail');
const descriptionDetail = document.querySelector('#description-detail');
const detailDetail = document.querySelector('#detail-detail');
const authorDetail = document.querySelector('#author-detail');
const authorDetailLabel = document.querySelector('#author-detail-label');
const contentDetail = document.querySelector('#content-detail');
const totalDebitDetail = document.querySelector('#total-debit-detail');
const totalCreditDetail = document.querySelector('#total-credit-detail');

let formData = {
    no_ref : '',
    name: '',
    email: '',
    type: '',
    phone: '',
    address: '',
    village: '',
    district: '',
    regency: '',
    province: '',
    nkk:'',
    nik:''
}

//component modal input
const createModalLabel = document.querySelector('#createModalLabel');
const nameInput = document.querySelector('#name-input');
const typeInput = document.querySelector('#type-input');
const noRefInput = document.querySelector('#no-ref-input');
const emailInput = document.querySelector('#email-input');
const phoneInput = document.querySelector('#phone-input');
const addressInput = document.querySelector('#address-input');

const btnSubmit = document.querySelector('#btn-submit');
const btnSubmitLabel = document.querySelector('#btn-submit-label');


let search = '';
let page = 1;
let isUpdate = false;
let deleteId = null;
let updateId = null;

async function searchForm(event){
    event.preventDefault();

    search = searchInput.value;

    await showContact();
}

function setDefault(){
    search = '';
    page = 1;
    deleteId = null;
    updateId = null;
    isUpdate = false;

    formData = {
        no_ref : '',
        name: '',
        email: '',
        type: '',
        phone: '',
        address: '',
        village: '',
        district: '',
        regency: '',
        province: '',
        nkk:'',
        nik:''
    }
    
    validateInputData();
}

function validateInputData(){
    let is_validated = false;

    if (formData.no_ref && formData.name  && formData.type)    {
        is_validated = true
    }

    if (is_validated) {
        btnSubmit.classList.remove('d-none');
    } else {
        btnSubmit.classList.add('d-none');
    }
}

function setDefaultComponentValue(){
    nameInput.value = formData.name;
    typeInput.value = formData.type;
    noRefInput.value = formData.no_ref;
    emailInput.value = formData.email;
    phoneInput.value = formData.phone;
    addressInput.value = formData.address;

    document.querySelector('#village-input').value = formData.village;
    document.querySelector('#district-input').value = formData.district;
    document.querySelector('#regency-input').value = formData.regency;
    document.querySelector('#province-input').value = formData.province;

    btnSubmit.classList.add('d-none');

    btnSubmitLabel.innerHTML = `Simpan`;
    btnSubmit.removeAttribute('disabled');
}

async function typeInputChange(value){
    formData.type = value.value;

    let res = await getNewNoRef(formData.type);
    formData.no_ref = res;
    noRefInput.value = res;
    validateInputData();
}

function nameInputChange(value){
    formData.name = value.value;
    validateInputData();
}

function noRefInputChange(value){
    formData.no_ref = value.value;
    validateInputData();
}

function emailInputChange(value){
    formData.email = value.value;
    validateInputData();
}

function addressInputChange(value){
    formData.address = value.value;
    validateInputData();
}

function phoneInputChange(value){
    formData.phone = value.value;
    validateInputData();
}

const submitContact = async (event) => {
    event.preventDefault();

    btnSubmit.setAttribute('disabled','disabled');
    btnSubmitLabel.innerHTML = `<div class="spinner-border-sm spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>`;
    if (isUpdate) {
        let result = await putContact(formData, updateId);
    
        let message = `Kontak ${result.name} Berhasil Diubah`;
        myToast(message, 'success');
        await showContact();
        setDefaultComponentValue();
        validateInputData();
    } else {
        let result = await postContact(formData);
    
        let message = `Kontak ${result.name} Berhasil Ditambahkan`;
            
        myToast(message, 'success');

        setDefault();
        setDefaultComponentValue();
        await showContact();
    }                
}

async function prevButton(){
    page--;
    await showContact();
}

async function nextButton(){
    page++;
    await showContact();
}

async function showContact(){
    try {
        let url = `/api/contacts?search=${search}&page=${page}`;

        let response = await getContact(url);
        
        countData.innerHTML = `${response.data.length ? (page * response.per_page)-(response.per_page-1) : 0}-${response.data.length + (page * response.per_page)-response.per_page} dari ${response.total}`;

        if (page == 1) {
            prevBtn.classList.add('disabled');
            prevBtn.setAttribute('disabled','disabled');
        }else{
            prevBtn.classList.remove('disabled');
            prevBtn.removeAttribute('disabled');
        }

        if (page == response.last_page) {
            nextBtn.classList.add('disabled');
            nextBtn.setAttribute('disabled','disabled');
        }else{
            nextBtn.classList.remove('disabled');
            nextBtn.removeAttribute('disabled');
        }

        if (response.data.length < 1) {
            listData.innerHTML = `
                            <div class="row mt-2 text-gray">
                                <div class="col-12 text-center p-2 border border-white fst-italic">
                                    Tidak Ada Data
                                </div>
                            </div>`
        } else {
            let list = '';
            response.data.map((res, index) => {
            list += `
            <div class="d-flex d-md-none justify-content-between border-top border-bottom py-2">
                <div style="width:10%" class="my-auto">
                    <div class="btn-group dropstart">
                        <button class="btn btn-sm" type="button" id="dropdownMenuButton${index}" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton${index}">
                            <li>
                                <button class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#showDetailModal" onclick="showSingleContact(${res.id})" >
                                    <div class="row align-items-center justify-conter-start text-info">
                                        <div class="col-2"><i class="bi bi-search"></i></div>
                                        <div class="col-3">Detail</div>
                                    </div>
                                </button>
                            </li>
                            <li>
                                <button class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#createModal" onclick="editData(${res.id})" >
                                    <div class="row align-items-center justify-conter-start text-success">
                                        <div class="col-2"><i class="bi bi-pencil-square"></i></div>
                                        <div class="col-3">Ubah</div>
                                    </div>
                                </button>
                            </li>
                            <li>
                                <button class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal" onclick="deleteContact(${res.id})" >
                                    <div class="row align-items-center justify-conter-start text-danger">
                                        <div class="col-2"><i class="bi bi-trash"></i></div>
                                        <div class="col-3">Hapus</div>
                                    </div>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div style="width:50%">
                    <div class="font-bold">
                        ${res.name}
                    </div>
                    <div class="">
                        <small>Kode: ${res.no_ref}  </small>
                    </div>
                </div>
                <div style="width:40%" class="my-auto text-end">
                   
                </div>
                
            </div>

            <div class="d-md-flex d-none justify-content-between border-top border-bottom py-2 px-1 content-data">
                <div style="width:1%" class="px-2 my-auto">
                    <div class="dropdown">
                        <button class="btn btn-sm" type="button" id="dropdownMenuButton${index}" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <button class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#showDetailModal" onclick="showSingleContact(${res.id})" >
                                    <div class="row align-items-center justify-conter-start text-info">
                                        <div class="col-2"><i class="bi bi-search"></i></div>
                                        <div class="col-3">Detail</div>
                                    </div>
                                </button>
                            </li>
                            ${res.source ? '' : `<li>
                                <button class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#createModal" onclick="editData(${res.id})">
                                    <div class="row align-items-center justify-conter-start text-success">
                                        <div class="col-2"><i class="bi bi-pencil-square"></i></div>
                                        <div class="col-3">Ubah</div>
                                    </div>
                                </button>
                            </li>
                            <li>
                                <button class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal" onclick="deleteContact(${res.id})" >
                                    <div class="row align-items-center justify-conter-start text-danger">
                                        <div class="col-2"><i class="bi bi-trash"></i></div>
                                        <div class="col-3">Hapus</div>
                                    </div>
                                </button>
                            </li>`}
                        </ul>
                    </div>
                </div>
                
                <div style="width:20%" class="px-2 my-auto">${res.name}</div>
                <div style="width:10%" class="px-2 my-auto">${res.no_ref}</div>
                <div style="width:10%" class="px-2 my-auto">${res.type}</div>
                <div style="width:20%" class="px-2 my-auto">${res.phone ? res.phone : '-'}</div>
                
            </div>`
            });

            listData.innerHTML = list;
        }

    } catch (error) {
         console.log(error);
    }
    
}

const addData = () => {
    isUpdate = false;
    setDefault();
    setDefaultComponentValue();

    createModalLabel.innerHTML = "Tambah Data";
}

const editData = async (id) => {
    createModalLabel.innerHTML = "Ubah Data";
    let url = `/api/contact/${id}`;
    let res = await getContact(url);
    isUpdate = true;
    updateId = id;

    formData = {
        no_ref : res.no_ref,
        name: res.name,
        email: res.email,
        type: res.type,
        phone: res.phone,
        address: res.address,
        village: res.detail?.village ?? '',
        district: res.detail?.district ?? '',
        regency: res.detail?.regency ?? '',
        province: res.detail?.province ?? '',
        nkk:res.detail?.nkk ?? '',
        nik:res.detail?.nik ?? ''
    }

    nameInput.value = formData.name;
    typeInput.value = formData.type;
    noRefInput.value = formData.no_ref;
    emailInput.value = formData.email;
    phoneInput.value = formData.phone;
    addressInput.value = formData.address;

    document.querySelector('#nkk-input').value = formData.nkk;
    document.querySelector('#nik-input').value = formData.nik;
    document.querySelector('#village-input').value = formData.village;
    document.querySelector('#district-input').value = formData.district;
    document.querySelector('#regency-input').value = formData.regency;
    document.querySelector('#province-input').value = formData.province;
    validateInputData();

}

function deleteContact(id){
    deleteId = id;
}

async function submitDeleteContact(){  
    try {
        let response = await destroyContact(deleteId);

        let message = `Kontak ${response.name} Berhasil Dihapus`;
        
        myToast(message, 'success');

        setDefault();
        await showContact();

    } catch (error) {
        myToast(error.response.data.errors.message, 'danger');
    }
}

async function showSingleContact(id){
    try {
        let url = `/api/contact/${id}`;
        let res = await getContact(url);

        document.querySelector('#name-detail').innerHTML = res.name;
        document.querySelector('#type-detail').innerHTML = res.type;
        document.querySelector('#email-detail').innerHTML = res.email?? '-';
        document.querySelector('#phone-detail').innerHTML = res.phone?? '-';
        document.querySelector('#address-detail').innerHTML = res.address ?? '-';
        document.querySelector('#nkk-detail').innerHTML = res.detail?.nkk ?? '-';
        document.querySelector('#nik-detail').innerHTML = res.detail?.nik ?? '-';
        document.querySelector('#village-detail').innerHTML = res.detail?.village ?? '-';
        document.querySelector('#district-detail').innerHTML = res.detail?.district ?? '-';
        document.querySelector('#regency-detail').innerHTML = res.detail?.regency ?? '-';
        document.querySelector('#province-detail').innerHTML = res.detail?.province ?? '-';

    } catch (error) {
        console.log(error);
    }
}

function selectAddress(value)
{
    formData.village = value.dataset.village;
    formData.district = value.dataset.district;
    formData.regency = value.dataset.regency;
    formData.province = value.dataset.province;

    setDefaultComponentValue();
    validateInputData();
}

const getAddress = async (search) => await axios.get(`/api/villages?village=${search}`);

async function showAddressList(value){
    const addressList = document.querySelector('#address-list');

    let { data: result } = await getAddress(value);

    let list = '';

    result.data.map(village => {
        list += `
        <button type="button" class="list-group-item list-group-item-action" onclick="selectAddress(this)" data-village="${village.desa}" data-district="${village.kecamatan}" data-regency="${village.kabupaten}" data-province="${village.provinsi}">
            <div>
                <div class="fw-bold">${village.desa}</div>
                <small>Kecamatan ${village.kecamatan}, Kabupaten ${village.kabupaten}, ${village.provinsi}</small>
            </div>
        </button>
        `
    })

    addressList.innerHTML = list ? list : `
        <button type="button" class="list-group-item list-group-item-action" data-name="General Customer" data-id="1" disabled>
            No Data
        </button>
    `
}

async function showAddressDropdown(value){
    const addressList = document.querySelector('#address-list');

    addressList.classList.remove('d-none');
    
    showAddressList(value.value);
}

async function changeAddressDropdown(value){
    setTimeout(() => {
        showAddressList(value.value);        
    }, 200);
}

function changeAddress(value){
    value.value = formData.village;
    validateInputData();
}

function nkkInputChange(value){
    formData.nkk = value.value;
    document.querySelector('#nkk-input').value = value.value;
    validateInputData();
}

function nikInputChange(value){
    formData.nik = value.value;
    document.querySelector('#nik-input').value = value.value;
    validateInputData();
}

window.addEventListener('load', async function(){
    setDefault();
    setDefaultComponentValue();
    await showContact();
})