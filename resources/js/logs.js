window.delete = (id) => {

    axios.delete('/logs/' + id)
        .then(response => {
            location.reload()
        })
        .catch(errors => {
            console.log(errors);
        })
}

window.newLog = () => {
    data = new FormData();


    data.append('category_id',$('#category').val());
    data.append('payer_id',$('#payer').val());
    data.append('cost',$('#cost').val());
    data.append('date',$('#date').val());
    console.log(data);
    axios.post('/logs/',data)
    .then(response => {
        location.reload()
    })
    .catch(errors => {
        console.log(errors);
    })
}

window.archive = () => {
    axios.post('/archive/')
        .then(response => {
            location.reload()
        })
        .catch(errors => {
            console.log(errors);
        })
}
window.addEventListener('load',function () {
    document.getElementById('date').valueAsDate = new Date();
});
