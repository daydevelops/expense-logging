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
    console.log(data);
    axios.post('/logs/',data)
    .then(response => {
        location.reload()
    })
    .catch(errors => {
        console.log(errors);
    })
}